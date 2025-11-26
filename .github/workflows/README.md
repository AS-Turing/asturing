# Configuration CI/CD - AS Turing

## Secrets GitHub à configurer

Allez dans **Settings** → **Secrets and variables** → **Actions** de votre repo GitHub.

### Secrets communs

- `SSH_PRIVATE_KEY` : Clé SSH privée pour se connecter au serveur
- `SSH_PORT` : Port SSH du serveur

### Secrets pour l'environnement Development

- `DEV_HOST` : Adresse IP ou hostname du serveur de développement
- `DEV_USER` : Nom d'utilisateur SSH pour le serveur de développement
- `DEV_PATH` : Chemin absolu du projet sur le serveur de développement

### Secrets pour l'environnement Production

- `PROD_HOST` : Adresse IP ou hostname du serveur de production
- `PROD_USER` : Nom d'utilisateur SSH pour le serveur de production
- `PROD_PATH` : Chemin absolu du projet sur le serveur de production
- `BACKUP_PATH` : Chemin pour stocker les backups de base de données
- `DB_USER` : Nom d'utilisateur de la base de données
- `DB_PASSWORD` : Mot de passe de la base de données
- `DB_NAME` : Nom de la base de données

## Workflows créés

### 1. `dev-deploy.yml`
- **Déclenchement** : Push sur la branche `develop` ou manuel
- **Action** : Déploie vers `/srv/www/asturing/dev`
- **Steps** :
  1. Rsync des fichiers (exclut node_modules, .nuxt, vendor, etc.)
  2. Copie du `docker-compose.dev.remote.yml` en tant qu'override
  3. Rebuild et restart des containers
  4. Nettoyage des images Docker

### 2. `prod-deploy.yml`
- **Déclenchement** : Push sur `main`/`master` ou manuel
- **Action** : Déploie vers `/srv/www/asturing/prod`
- **Steps** :
  1. **Backup** de la base de données
  2. Rsync des fichiers
  3. Copie du `docker-compose.override.prod.yml` en tant qu'override
  4. Rebuild et restart des containers
  5. Nettoyage des images Docker

## Configuration initiale sur le serveur

Assurez-vous que sur votre serveur :

1. Les répertoires de déploiement et de backup existent

2. Docker et Docker Compose sont installés

3. La clé SSH publique pour GitHub Actions est autorisée dans `~/.ssh/authorized_keys`

4. Les fichiers `.env` sont présents dans chaque environnement (dev et prod)

## Comment configurer la clé SSH

1. Sur votre serveur, récupérez la clé privée dédiée à GitHub Actions
2. Copiez TOUT le contenu (incluant `-----BEGIN` et `-----END`)
3. Collez-le dans le secret GitHub `SSH_PRIVATE_KEY`

## Déploiement manuel

Vous pouvez déclencher un déploiement manuel via l'interface GitHub :
1. Allez dans **Actions**
2. Sélectionnez le workflow (Dev ou Prod)
3. Cliquez sur **Run workflow**

## Notes

- Les workflows utilisent `concurrency` pour éviter les déploiements simultanés
- Le workflow dev peut être annulé si un nouveau déploiement démarre
- Le workflow prod ne peut PAS être annulé (sécurité)
- Les anciens workflows ont été désactivés (`.yml.disabled`)
