# 📚 Documentation des Commandes Symfony - AS-Turing

Ce document recense toutes les commandes Symfony personnalisées disponibles dans le projet, ainsi que les scripts Bash associés pour faciliter leur utilisation.

---

## 📋 Table des matières

- [Commandes App](#commandes-app)
  - [app:create-admin](#appcreate-admin)
  - [app:load-fixtures](#appload-fixtures)
  - [app:update-fixtures](#appupdate-fixtures)
- [Scripts Bash](#scripts-bash)
  - [import-incremental.sh](#import-incrementalsh)
  - [update-fixtures.sh](#update-fixturessh)
- [Commandes Doctrine utiles](#commandes-doctrine-utiles)
- [Gestion du cache](#gestion-du-cache)

---

## 🛠️ Commandes App

### `app:create-admin`

**Description** : Crée un utilisateur administrateur pour accéder au backoffice EasyAdmin.

**Usage** :
```bash
docker compose exec symfony php bin/console app:create-admin
```

**Exemple** :
```bash
$ docker compose exec symfony php bin/console app:create-admin

Email: admin@as-turing.fr
Password: ********
Admin user created successfully!
```

**Cas d'usage** :
- Création du premier compte admin après installation
- Ajout d'un nouvel administrateur
- Réinitialisation d'un compte admin perdu

---

### `app:load-fixtures`

**Description** : Charge toutes les fixtures depuis les fichiers JSON dans la base de données.

⚠️ **ATTENTION** : Cette commande peut créer des **doublons** si les données existent déjà. Privilégier `app:update-fixtures` pour mettre à jour des données existantes.

**Usage** :
```bash
docker compose exec symfony php bin/console app:load-fixtures [--purge]
```

**Options** :
- `--purge` : Vide toutes les tables avant d'importer les données (⚠️ destructif)

**Exemples** :
```bash
# Charger les fixtures sans purge (risque de doublons)
docker compose exec symfony php bin/console app:load-fixtures

# Charger les fixtures après avoir vidé les tables (⚠️ DESTRUCTIF)
docker compose exec symfony php bin/console app:load-fixtures --purge
```

**Données chargées** :
- Services (`backend/src/DataFixtures/data/services.json`)
- Projects (`backend/src/DataFixtures/data/projects.json`)
- Blog Posts (`backend/src/DataFixtures/data/blogs.json`)
- Locations (`backend/src/DataFixtures/data/locations/*.json`)
- Specifications (`backend/src/DataFixtures/SpecificationFixtures.php`)

**Cas d'usage** :
- Installation initiale du projet
- Réinitialisation complète de la base de données
- Import de données après une migration

---

### `app:update-fixtures`

**Description** : Met à jour les données existantes dans la base de données depuis les fichiers JSON **sans créer de doublons**.

✅ **RECOMMANDÉ** : Utiliser cette commande pour mettre à jour des données déjà en base.

**Usage** :
```bash
docker compose exec symfony php bin/console app:update-fixtures [--entity=TYPE]
```

**Options** :
- `--entity=TYPE` : Cible une seule entité à mettre à jour (`location`, `service`, `project`, `blog`)
- Aucune option : Met à jour toutes les entités

**Exemples** :
```bash
# Mettre à jour uniquement les locations
docker compose exec symfony php bin/console app:update-fixtures --entity=location

# Mettre à jour uniquement les services
docker compose exec symfony php bin/console app:update-fixtures --entity=service

# Mettre à jour toutes les entités
docker compose exec symfony php bin/console app:update-fixtures
```

**Fonctionnement** :
1. Lit les fichiers JSON
2. Recherche les entités existantes par leur `slug`
3. Met à jour **uniquement les données trouvées** (pas de création)
4. Affiche des statistiques : `Mises à jour` vs `Non trouvées`

**Exemple de sortie** :
```
Mise à jour des données depuis JSON
===================================

Mise à jour des Locations
-------------------------

 11/11 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

 [OK] Mise à jour terminée !

Statistiques
------------

 Entité      Mises à jour   Non trouvées
 Locations   11             0
 Services    5              1
 Projects    3              0
 Blogs       8              2
```

**Cas d'usage** :
- Modification des H1, meta titles, descriptions SEO
- Mise à jour du contenu des pages locations
- Correction de données erronées
- Ajout de nouveaux champs à des entités existantes

---

## 🚀 Scripts Bash

### `import-incremental.sh`

**Description** : Script complet d'import incrémental avec sauvegarde automatique de la base de données.

⚠️ **ATTENTION** : Ce script utilise une commande custom `app:import-incremental` qui **ajoute de nouvelles données** sans toucher aux existantes. Il peut créer des doublons si les données existent déjà.

**Usage** :
```bash
./import-incremental.sh
```

**Étapes automatiques** :
1. ✅ Vérification de l'environnement (containers Docker)
2. 💾 Sauvegarde automatique de la BDD dans `backups/database/`
3. 📥 Import incrémental des données JSON
4. 🧹 Nettoyage des caches Doctrine et Symfony
5. 🔄 Redémarrage des services

**Exemple de sortie** :
```
═══════════════════════════════════════════════════
   Import Incrémental des Données depuis JSON
═══════════════════════════════════════════════════

[1/5] Vérification de l'environnement...
✅ Environnement vérifié

[2/5] Sauvegarde de la base de données actuelle...
✅ Sauvegarde créée : ./backups/database/asturingdb_backup_20260116_144249.sql (344K)

[3/5] Import incrémental des données depuis les fichiers JSON...
✅ Import incrémental terminé avec succès

[4/5] Nettoyage des caches...
✅ Caches nettoyés

[5/5] Redémarrage des services...
✅ Services redémarrés

═══════════════════════════════════════════════════
   ✅ Import incrémental terminé avec succès !
═══════════════════════════════════════════════════
```

**Cas d'usage** :
- Ajout de nouvelles locations, services, projets ou blog posts
- Import de données depuis des sources externes

---

### `update-fixtures.sh`

**Description** : Script complet de mise à jour des fixtures avec sauvegarde automatique de la base de données.

✅ **RECOMMANDÉ** : Utiliser ce script pour mettre à jour les données existantes.

**Usage** :
```bash
./update-fixtures.sh [entity]
```

**Arguments** :
- `entity` (optionnel) : Cible une seule entité (`location`, `service`, `project`, `blog`)
- Aucun argument : Met à jour toutes les entités

**Exemples** :
```bash
# Mettre à jour uniquement les locations
./update-fixtures.sh location

# Mettre à jour uniquement les services
./update-fixtures.sh service

# Mettre à jour toutes les entités
./update-fixtures.sh
```

**Étapes automatiques** :
1. ✅ Vérification de l'environnement (containers Docker)
2. 💾 Sauvegarde automatique de la BDD dans `backups/database/`
3. 🔄 Mise à jour des données existantes depuis JSON
4. 🧹 Nettoyage des caches Doctrine et Symfony
5. 🔄 Redémarrage des services

**Exemple de sortie** :
```
═══════════════════════════════════════════════════
   Mise à Jour des Données depuis JSON
═══════════════════════════════════════════════════

Entité ciblée : location

[1/5] Vérification de l'environnement...
✅ Environnement vérifié

[2/5] Sauvegarde de la base de données actuelle...
✅ Sauvegarde créée : ./backups/database/asturingdb_backup_20260116_151234.sql (344K)

[3/5] Mise à jour des données depuis les fichiers JSON...
✅ Mise à jour terminée avec succès

[4/5] Nettoyage des caches...
✅ Caches nettoyés

[5/5] Redémarrage des services...
✅ Services redémarrés

═══════════════════════════════════════════════════
   ✅ Mise à jour terminée avec succès !
═══════════════════════════════════════════════════

📊 Résumé :
   • Sauvegarde : backups/database/asturingdb_backup_20260116_151234.sql
   • Mise à jour : Réussie
   • Caches : Nettoyés
   • Services : Redémarrés

💡 Conseil :
   Les anciennes sauvegardes sont dans backups/database
   Pensez à les nettoyer régulièrement pour économiser l'espace disque.
```

**Cas d'usage** :
- Modification des H1 des pages locations
- Mise à jour des meta descriptions et keywords
- Correction de contenu existant
- Ajout de nouveaux champs dans les JSON

---

## 🗄️ Commandes Doctrine utiles

### Vérifier le schéma de la base de données

```bash
# Vérifier si la BDD est synchronisée avec les entités
docker compose exec symfony php bin/console doctrine:schema:validate

# Voir les différences entre entités et BDD
docker compose exec symfony php bin/console doctrine:schema:update --dump-sql

# Appliquer les modifications
docker compose exec symfony php bin/console doctrine:schema:update --force
```

### Gérer les migrations

```bash
# Créer une migration automatique
docker compose exec symfony php bin/console make:migration

# Appliquer les migrations en attente
docker compose exec symfony php bin/console doctrine:migrations:migrate

# Voir le statut des migrations
docker compose exec symfony php bin/console doctrine:migrations:status
```

---

## 🧹 Gestion du cache

### Vider les caches Doctrine

```bash
# Vider le cache des métadonnées
docker compose exec symfony php bin/console doctrine:cache:clear-metadata

# Vider le cache des requêtes
docker compose exec symfony php bin/console doctrine:cache:clear-query

# Vider le cache des résultats
docker compose exec symfony php bin/console doctrine:cache:clear-result --flush
```

### Vider le cache Symfony

```bash
# Vider le cache de l'environnement actuel (prod par défaut)
docker compose exec symfony php bin/console cache:clear

# Vider le cache dev
docker compose exec symfony php bin/console cache:clear --env=dev

# Supprimer les fichiers de cache physiques
docker compose exec symfony rm -rf /app/var/cache/prod/pools/*
```

### Script complet de nettoyage des caches

```bash
#!/bin/bash
# Fichier : clear-cache.sh

echo "🧹 Nettoyage des caches..."

# Caches Doctrine
docker compose exec symfony php bin/console doctrine:cache:clear-metadata --quiet
docker compose exec symfony php bin/console doctrine:cache:clear-query --quiet
docker compose exec symfony php bin/console doctrine:cache:clear-result --flush --quiet

# Cache Symfony
docker compose exec symfony php bin/console cache:clear --quiet

# Fichiers de cache physiques
docker compose exec symfony rm -rf /app/var/cache/prod/pools/* 2>/dev/null || true

echo "✅ Caches nettoyés avec succès !"
```

---

## 📊 Workflows recommandés

### 1. Modifier le contenu d'une page location

```bash
# 1. Modifier le JSON
vim backend/src/DataFixtures/data/locations/libourne.json

# 2. Mettre à jour la BDD (avec sauvegarde auto)
./update-fixtures.sh location

# 3. Vérifier sur le front
# Ouvrir https://www.as-turing.fr/creation-site-internet-libourne
```

### 2. Ajouter un nouveau service

```bash
# 1. Ajouter le service dans le JSON
vim backend/src/DataFixtures/data/services.json

# 2. Importer en incrémental (ne touche pas aux existants)
./import-incremental.sh

# 3. Vérifier sur le front
# Ouvrir https://www.as-turing.fr/services/nouveau-service
```

### 3. Restaurer une sauvegarde après erreur

```bash
# Lister les sauvegardes disponibles
ls -lh backups/database/

# Restaurer une sauvegarde
docker compose exec -T mysql mysql -uroot -prootpass asturingdb < backups/database/asturingdb_backup_20260116_151234.sql

# Vider les caches
docker compose exec symfony php bin/console cache:clear
docker compose exec symfony php bin/console doctrine:cache:clear-result --flush

# Redémarrer les services
docker compose restart symfony nuxt
```

---

## 🆘 Résolution de problèmes

### Erreur : "Command not found"

Si une commande `app:*` n'est pas reconnue :

```bash
# Vérifier que le fichier existe
ls -la backend/src/Command/

# Vider le cache Symfony
docker compose exec symfony php bin/console cache:clear

# Si en développement local (pas en container)
# Copier le fichier dans le container
docker compose cp backend/src/Command/UpdateFixturesCommand.php symfony:/app/src/Command/UpdateFixturesCommand.php
docker compose exec symfony php bin/console cache:clear
```

### Erreur : "Call to undefined method"

Si une méthode n'existe pas sur une entité :

```bash
# Vérifier la structure de l'entité
grep "public function set" backend/src/Entity/Location.php

# Vérifier que les données JSON correspondent à la structure de l'entité
cat backend/src/DataFixtures/data/locations/libourne.json
```

### Erreur : "Duplicate entry"

Si `app:load-fixtures` crée des doublons :

```bash
# Utiliser app:update-fixtures à la place
docker compose exec symfony php bin/console app:update-fixtures

# Ou purger avant de charger
docker compose exec symfony php bin/console app:load-fixtures --purge
```

---

## 📝 Notes importantes

### Sauvegardes automatiques

Les scripts `import-incremental.sh` et `update-fixtures.sh` créent **automatiquement** une sauvegarde de la base de données avant toute modification dans `backups/database/`.

**Format** : `asturingdb_backup_YYYYMMDD_HHMMSS.sql`

**Conseil** : Nettoyer régulièrement les anciennes sauvegardes pour économiser l'espace disque :

```bash
# Garder uniquement les 10 dernières sauvegardes
cd backups/database
ls -t | tail -n +11 | xargs rm -f
```

### Différence import vs update

| Caractéristique | `app:load-fixtures` | `app:update-fixtures` |
|-----------------|---------------------|----------------------|
| Crée de nouvelles données | ✅ Oui | ❌ Non |
| Met à jour données existantes | ❌ Non | ✅ Oui |
| Risque de doublons | ⚠️ Oui (sans `--purge`) | ✅ Non |
| Option de purge | ✅ Oui (`--purge`) | ❌ Non |
| Usage recommandé | Installation initiale | Modifications quotidiennes |

---

## 📚 Ressources

- [Documentation Symfony Console](https://symfony.com/doc/current/console.html)
- [Documentation Doctrine Fixtures](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html)
- [Documentation Docker Compose](https://docs.docker.com/compose/)

---

**Dernière mise à jour** : 16 janvier 2026
