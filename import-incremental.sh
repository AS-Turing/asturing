#!/bin/bash

#####################################################################
# Script d'import incrémental des fixtures depuis JSON
# 
# Ce script permet d'importer de nouvelles données depuis les fichiers
# JSON sans écraser les données existantes dans la base de données.
#
# Fonctionnalités :
# - Export automatique de la BDD avant import (sauvegarde)
# - Import incrémental des données JSON (pas d'écrasement)
# - Gestion des caches Doctrine et Symfony
#
# Usage : ./import-incremental.sh
#####################################################################

set -e  # Arrêter le script en cas d'erreur

# Couleurs pour le terminal
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration
BACKUP_DIR="./backups/database"
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
BACKUP_FILE="asturingdb_backup_${TIMESTAMP}.sql"

echo -e "${BLUE}═══════════════════════════════════════════════════${NC}"
echo -e "${BLUE}   Import Incrémental des Données depuis JSON${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════${NC}"
echo ""

#####################################################################
# ÉTAPE 1 : Vérification de l'environnement
#####################################################################
echo -e "${YELLOW}[1/5] Vérification de l'environnement...${NC}"

# Vérifier que les containers sont en cours d'exécution
if ! docker compose ps symfony | grep -q "Up"; then
    echo -e "${RED}❌ Le container Symfony n'est pas en cours d'exécution${NC}"
    echo -e "${YELLOW}Démarrage des containers...${NC}"
    docker compose up -d symfony
    sleep 10
fi

if ! docker compose ps mysql | grep -q "Up"; then
    echo -e "${RED}❌ Le container MySQL n'est pas en cours d'exécution${NC}"
    echo -e "${YELLOW}Démarrage des containers...${NC}"
    docker compose up -d mysql
    sleep 10
fi

echo -e "${GREEN}✅ Environnement vérifié${NC}"
echo ""

#####################################################################
# ÉTAPE 2 : Sauvegarde de la base de données
#####################################################################
echo -e "${YELLOW}[2/5] Sauvegarde de la base de données actuelle...${NC}"

# Créer le répertoire de sauvegarde s'il n'existe pas
mkdir -p "$BACKUP_DIR"

# Nettoyer les anciennes sauvegardes (garder uniquement les 5 dernières)
BACKUP_COUNT=$(ls -1 "$BACKUP_DIR"/asturingdb_backup_*.sql 2>/dev/null | wc -l)
if [ "$BACKUP_COUNT" -ge 5 ]; then
    echo -e "${YELLOW}🧹 Nettoyage des anciennes sauvegardes (conservation des 5 dernières)...${NC}"
    ls -1t "$BACKUP_DIR"/asturingdb_backup_*.sql | tail -n +5 | xargs rm -f
    DELETED=$((BACKUP_COUNT - 4))
    echo -e "${GREEN}✅ $DELETED ancienne(s) sauvegarde(s) supprimée(s)${NC}"
fi

# Export de la base de données (hors container)
docker compose exec -T mysql mysqldump \
    -uroot \
    -prootpass \
    --single-transaction \
    --routines \
    --triggers \
    --events \
    asturingdb 2>/dev/null > "$BACKUP_DIR/$BACKUP_FILE"

# Vérifier que la sauvegarde a réussi
if [ -f "$BACKUP_DIR/$BACKUP_FILE" ] && [ -s "$BACKUP_DIR/$BACKUP_FILE" ]; then
    BACKUP_SIZE=$(du -h "$BACKUP_DIR/$BACKUP_FILE" | cut -f1)
    echo -e "${GREEN}✅ Sauvegarde créée : $BACKUP_DIR/$BACKUP_FILE ($BACKUP_SIZE)${NC}"
else
    echo -e "${RED}❌ Échec de la sauvegarde${NC}"
    exit 1
fi
echo ""

#####################################################################
# ÉTAPE 3 : Import incrémental des données JSON
#####################################################################
echo -e "${YELLOW}[3/5] Import incrémental des données depuis les fichiers JSON...${NC}"

# Exécuter la commande d'import incrémental
docker compose exec symfony php bin/console app:import-incremental

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Import incrémental terminé avec succès${NC}"
else
    echo -e "${RED}❌ Échec de l'import${NC}"
    echo -e "${YELLOW}💡 La sauvegarde est disponible dans : $BACKUP_DIR/$BACKUP_FILE${NC}"
    echo -e "${YELLOW}💡 Pour restaurer : docker compose exec -T mysql mysql -uroot -prootpass asturingdb < $BACKUP_DIR/$BACKUP_FILE${NC}"
    exit 1
fi
echo ""

#####################################################################
# ÉTAPE 4 : Nettoyage des caches
#####################################################################
echo -e "${YELLOW}[4/5] Nettoyage des caches...${NC}"

# Vider les caches Doctrine
docker compose exec symfony php bin/console doctrine:cache:clear-metadata --quiet
docker compose exec symfony php bin/console doctrine:cache:clear-query --quiet
docker compose exec symfony php bin/console doctrine:cache:clear-result --flush --quiet

# Vider le cache Symfony
docker compose exec symfony php bin/console cache:clear --quiet

# Supprimer les fichiers de cache physiques
docker compose exec symfony rm -rf /app/var/cache/prod/pools/* 2>/dev/null || true

echo -e "${GREEN}✅ Caches nettoyés${NC}"
echo ""

#####################################################################
# ÉTAPE 5 : Redémarrage des services
#####################################################################
echo -e "${YELLOW}[5/5] Redémarrage des services...${NC}"

docker compose restart symfony nuxt > /dev/null 2>&1

# Attendre que les services soient prêts
sleep 5

echo -e "${GREEN}✅ Services redémarrés${NC}"
echo ""

#####################################################################
# Résumé
#####################################################################
echo -e "${GREEN}═══════════════════════════════════════════════════${NC}"
echo -e "${GREEN}   ✅ Import incrémental terminé avec succès !${NC}"
echo -e "${GREEN}═══════════════════════════════════════════════════${NC}"
echo ""
echo -e "${BLUE}📊 Résumé :${NC}"
echo -e "   • Sauvegarde : ${GREEN}$BACKUP_DIR/$BACKUP_FILE${NC}"
echo -e "   • Import : ${GREEN}Réussi${NC}"
echo -e "   • Caches : ${GREEN}Nettoyés${NC}"
echo -e "   • Services : ${GREEN}Redémarrés${NC}"
echo ""
echo -e "${YELLOW}💡 Conseil :${NC}"
echo -e "   Les anciennes sauvegardes sont dans ${BLUE}$BACKUP_DIR${NC}"
echo -e "   Pensez à les nettoyer régulièrement pour économiser l'espace disque."
echo ""
