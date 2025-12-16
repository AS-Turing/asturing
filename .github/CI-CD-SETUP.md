# 🚀 CI/CD Setup - AS-Turing

## 📋 Vue d'ensemble

La CI/CD utilise **GitHub Actions** avec **GHCR** (GitHub Container Registry) pour construire et déployer automatiquement les applications.

### Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                         GitHub Actions                           │
├─────────────────────────────────────────────────────────────────┤
│                                                                   │
│  Push main         →  Build Images (tag: production)             │
│                    →  Deploy to /srv/www/asturing/prod           │
│                                                                   │
│  Push development  →  Build Images (tag: dev)                    │
│                    →  Deploy to /srv/www/asturing/dev            │
│                                                                   │
└─────────────────────────────────────────────────────────────────┘
```

## 🔄 Workflows

### 1. **build-images.yml** - Construction des images Docker

- **Trigger**: Push sur `main` ou `development`
- **Actions**:
  - Build l'image Nuxt frontend
  - Build l'image Symfony backend
  - Push vers GHCR avec les tags appropriés:
    - `main` → tag `production`
    - `development` → tag `dev`

### 2. **deploy-production.yml** - Déploiement Production

- **Trigger**: Après succès de `build-images.yml` sur `main`
- **Destination**: `/srv/www/asturing/prod`
- **Actions**:
  - Pull des images `production` depuis GHCR
  - Redémarrage des containers
  - Health check

### 3. **dev-deploy.yml** - Déploiement Development

- **Trigger**: Après succès de `build-images.yml` sur `development`
- **Destination**: `/srv/www/asturing/dev`
- **Actions**:
  - Pull des images `dev` depuis GHCR
  - Redémarrage des containers
  - Health check

### 4. **health-check.yml** - Surveillance

- **Trigger**: Quotidien à 9h00 UTC
- **Actions**: Vérification de l'état des services

### 5. **maintenance.yml** - Nettoyage

- **Trigger**: Hebdomadaire (dimanche 3h00 UTC)
- **Actions**: Nettoyage des images et logs

## 🔐 Secrets GitHub requis

Configurez ces secrets dans: `Settings → Secrets and variables → Actions`

| Secret | Description | Valeur |
|--------|-------------|---------|
| `SSH_HOST` | IP du serveur | `88.174.167.179` |
| `SSH_PORT` | Port SSH | `2222` |
| `SSH_USER` | Utilisateur SSH | `chado` |
| `SSH_PRIVATE_KEY` | Clé privée SSH | Contenu de `~/.ssh/asturing_deploy` |
| `GHCR_TOKEN` | Token GitHub pour GHCR | Personal Access Token avec `write:packages` |

## 🐳 Configuration des images GHCR

### Production (`/srv/www/asturing/prod/.env`)

```env
REGISTRY=ghcr.io
IMAGE_PREFIX=AS-Turing/asturing
IMAGE_TAG=production
```

### Development (`/srv/www/asturing/dev/.env`)

```env
REGISTRY=ghcr.io
IMAGE_PREFIX=AS-Turing/asturing
IMAGE_TAG=dev
```

## 📦 Images Docker

Les images sont publiées sur GHCR :

- `ghcr.io/as-turing/asturing-nuxt:production`
- `ghcr.io/as-turing/asturing-nuxt:dev`
- `ghcr.io/as-turing/asturing-symfony:production`
- `ghcr.io/as-turing/asturing-symfony:dev`

## 🔧 Utilisation manuelle

### Déployer manuellement

Via l'interface GitHub:
1. Aller dans `Actions`
2. Sélectionner le workflow souhaité
3. Cliquer `Run workflow`

### Pull manuel des images

**Production**:
```bash
cd /srv/www/asturing/prod
docker login ghcr.io -u AS-Turing
docker pull ghcr.io/as-turing/asturing-nuxt:production
docker pull ghcr.io/as-turing/asturing-symfony:production
docker compose up -d --force-recreate
```

**Development**:
```bash
cd /srv/www/asturing/dev
docker login ghcr.io -u AS-Turing
docker pull ghcr.io/as-turing/asturing-nuxt:dev
docker pull ghcr.io/as-turing/asturing-symfony:dev
docker compose up -d --force-recreate
```

## ⚠️ Points importants

1. **Séparation des environnements**:
   - Production et Dev partagent le même serveur
   - Noms de containers différents pour éviter les conflits
   - Tags d'images différents (`production` vs `dev`)

2. **Build vs Pull**:
   - Les `docker-compose.override.yml` sont configurés pour **pull** les images GHCR
   - Les lignes `build:` sont commentées
   - Pour revenir au build local, décommentez les lignes `build:` et commentez `image:`

3. **Permissions GitHub**:
   - Activez `Read and write permissions` dans: `Settings → Actions → General → Workflow permissions`

## 🐛 Troubleshooting

### Les images ne se mettent pas à jour

```bash
# Forcer le pull des images
docker compose pull --ignore-buildable
docker compose up -d --force-recreate
```

### Problème d'authentification GHCR

```bash
# Vérifier le token
echo $GHCR_TOKEN | docker login ghcr.io -u AS-Turing --password-stdin
```

### Containers qui ne démarrent pas

```bash
# Voir les logs
docker compose logs -f

# Vérifier l'état
docker compose ps -a
```

## 📚 Ressources

- [GitHub Actions Documentation](https://docs.github.com/en/actions)
- [GHCR Documentation](https://docs.github.com/en/packages/working-with-a-github-packages-registry/working-with-the-container-registry)
- [Docker Compose Documentation](https://docs.docker.com/compose/)
