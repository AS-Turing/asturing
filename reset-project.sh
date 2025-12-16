#!/bin/bash

################################################################################
# Script de reset complet du projet AS Turing
# 
# Ce script repart de zéro :
# - Arrêt et suppression de tous les containers
# - Rebuild sans cache de tous les containers
# - Recréation complète de la base de données
# - Chargement des fixtures
# - Nettoyage de tous les caches
#
# Usage: bash reset-project.sh
################################################################################

set -e  # Arrêt immédiat en cas d'erreur

# Couleurs pour l'affichage
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}╔════════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║                                                            ║${NC}"
echo -e "${BLUE}║        🔄 RESET COMPLET DU PROJET AS TURING 🔄            ║${NC}"
echo -e "${BLUE}║                                                            ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════════╝${NC}"
echo ""

# Demande de confirmation
echo -e "${YELLOW}⚠️  ATTENTION : Cette opération va :${NC}"
echo "   - Supprimer tous les containers"
echo "   - Rebuilder tous les containers sans cache (long !)"
echo "   - Recréer la base de données (perte de données)"
echo "   - Recharger les fixtures"
echo ""
read -p "Voulez-vous continuer ? (oui/non) : " -r
echo
if [[ ! $REPLY =~ ^[Oo][Uu][Ii]$ ]]
then
    echo -e "${RED}❌ Opération annulée${NC}"
    exit 0
fi

echo ""
echo -e "${GREEN}✅ C'est parti !${NC}"
echo ""

# Aller dans le répertoire du projet
cd /srv/www/asturing/prod

# Étape 1 : Arrêt et suppression des containers
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${BLUE}📦 Étape 1/9 : Arrêt et suppression des containers${NC}"
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
docker compose down --remove-orphans
echo -e "${GREEN}✓ Containers supprimés${NC}"
echo ""

# Étape 2 : Pull des dernières images depuis GHCR
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${BLUE}📥 Étape 2/9 : Pull des dernières images depuis GHCR${NC}"
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${YELLOW}⏳ Téléchargement des images...${NC}"
docker compose pull
echo -e "${GREEN}✓ Images téléchargées${NC}"
echo ""

# Étape 3 : Démarrage des containers (force recreate pour éviter problèmes de cache)
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${BLUE}🚀 Étape 3/9 : Démarrage des containers${NC}"
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
docker compose up -d --force-recreate --pull always
echo -e "${GREEN}✓ Containers démarrés (recréés à partir des dernières images)${NC}"
echo ""

# Étape 4 : Attente que MySQL soit prêt
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${BLUE}⏰ Étape 4/9 : Attente du démarrage de MySQL${NC}"
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${YELLOW}⏳ Attente 20 secondes pour que MySQL soit prêt...${NC}"
sleep 20
echo -e "${GREEN}✓ MySQL devrait être prêt${NC}"
echo ""

# Étape 5 : Recréation de la base de données
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${BLUE}🗄️  Étape 5/9 : Recréation de la base de données${NC}"
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
docker compose exec mysql mysql -uroot -prootpass -e "DROP DATABASE IF EXISTS asturingdb; CREATE DATABASE asturingdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>&1 | grep -v "Warning" || true
echo -e "${GREEN}✓ Base de données recréée${NC}"
echo ""

# Étape 6 : Création du schéma Doctrine
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${BLUE}📐 Étape 6/9 : Création du schéma Doctrine${NC}"
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
docker compose exec symfony php bin/console doctrine:schema:create
echo -e "${GREEN}✓ Schéma créé${NC}"
echo ""

# Étape 7 : Chargement des fixtures
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${BLUE}📊 Étape 7/9 : Chargement des fixtures${NC}"
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
docker compose exec symfony php bin/console app:load-fixtures
echo -e "${GREEN}✓ Fixtures chargées${NC}"
echo ""

# Étape 8 : Nettoyage de tous les caches
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${BLUE}🧹 Étape 8/9 : Nettoyage de tous les caches${NC}"
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"

echo "  → Doctrine metadata cache..."
docker compose exec symfony php bin/console doctrine:cache:clear-metadata

echo "  → Doctrine query cache..."
docker compose exec symfony php bin/console doctrine:cache:clear-query

echo "  → Doctrine result cache..."
docker compose exec symfony php bin/console doctrine:cache:clear-result --flush

echo "  → Symfony cache..."
docker compose exec symfony php bin/console cache:clear

echo "  → Suppression des fichiers de cache..."
docker compose exec symfony rm -rf /app/var/cache/prod/pools/* 2>/dev/null || true

echo -e "${GREEN}✓ Tous les caches nettoyés${NC}"
echo ""

# Étape 9 : Redémarrage des containers
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${BLUE}🔄 Étape 9/9 : Redémarrage des containers${NC}"
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
docker compose restart symfony nuxt
echo -e "${YELLOW}⏳ Attente 10 secondes pour que les containers redémarrent...${NC}"
sleep 10
echo -e "${GREEN}✓ Containers redémarrés${NC}"
echo ""

# Vérifications finales
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"
echo -e "${BLUE}🔍 Vérifications finales${NC}"
echo -e "${BLUE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"

echo -e "${YELLOW}📊 Données en base de données :${NC}"
echo ""
docker compose exec mysql mysql -uroot -prootpass asturingdb -se "
SELECT 
  (SELECT COUNT(*) FROM project) as projects,
  (SELECT COUNT(*) FROM service) as services,
  (SELECT COUNT(*) FROM blog_post) as blog_posts,
  (SELECT COUNT(*) FROM client) as clients
" 2>&1 | grep -v "Warning"
echo ""

echo -e "${YELLOW}🖼️  Projets avec images :${NC}"
docker compose exec mysql mysql -uroot -prootpass asturingdb -se "SELECT title, IF(image_url IS NOT NULL, '✓', '✗') as image FROM project ORDER BY position;" 2>&1 | grep -v "Warning"
echo ""

# Résumé final
echo -e "${GREEN}╔════════════════════════════════════════════════════════════╗${NC}"
echo -e "${GREEN}║                                                            ║${NC}"
echo -e "${GREEN}║                  ✅ RESET TERMINÉ ! ✅                     ║${NC}"
echo -e "${GREEN}║                                                            ║${NC}"
echo -e "${GREEN}╚════════════════════════════════════════════════════════════╝${NC}"
echo ""
echo -e "${GREEN}🎉 Le projet a été réinitialisé avec succès !${NC}"
echo ""
echo -e "${BLUE}📋 Prochaines étapes :${NC}"
echo "   → Frontend : http://localhost:3002"
echo "   → Backend API : http://localhost:8083/api"
echo "   → Admin : http://localhost:8083/admin"
echo ""
echo -e "${YELLOW}💡 Astuce : Pour tester l'API des projets :${NC}"
echo "   curl http://localhost:8083/api/projects | jq"
echo ""
