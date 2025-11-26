# AS-Turing - Infrastructure & Deployment

Site web AS-Turing avec architecture Nuxt SSR + Symfony + MySQL.

## 📋 Stack Technique

- **Frontend**: Nuxt 3 (SSR) + Vue 3 + TypeScript + Tailwind CSS
- **Backend**: Symfony 6 + PHP 8.3
- **Database**: MySQL 8.0
- **Infrastructure**: Docker + Traefik (reverse proxy)
- **CI/CD**: GitHub Actions

---

## 🏗️ Architecture

### Développement Local
```
Docker Compose
├── Nuxt (dev mode - hot reload)
├── Symfony (dev mode)
└── MySQL
```

### Production
```
Serveur (2a01:e0a:ba9:ecc0:329c:23ff:fe66:7881)
├── Traefik (reverse proxy + HTTPS)
├── Nuxt (SSR optimisé)
├── Symfony (prod optimisé)
└── MySQL (volumes persistants)
```

---

## 🚀 Démarrage Rapide

### Local (développement)

```bash
# Démarrer les services
docker compose up -d

# Voir les logs
docker compose logs -f nuxt

# Arrêter
docker compose down
```

**URLs locales** :
- Frontend: http://as-turing.localhost
- Backend: http://backend.localhost:8000

### Production (serveur)

SSH vers le serveur et utiliser le même `docker compose` :

```bash
ssh -p 2222 chado@2a01:e0a:ba9:ecc0:329c:23ff:fe66:7881
cd /srv/www/asturing/prod
docker compose up -d --build
```

---

## 📦 Dockerfiles

### Frontend

- **`Dockerfile`** : Production (multi-stage, optimisé, ~100MB final)
- **`Dockerfile.dev`** : Développement (hot reload, volumes)

### Backend

- **`Dockerfile`** : Production (composer --no-dev, optimisé)
- **`Dockerfile.dev`** : Développement (tous les outils de dev)

---

## ⚙️ Configuration

### Docker Compose

- **`docker-compose.yml`** : Base commune (structure des services)
- **`docker-compose.override.yml`** : Override local (DEV, auto-chargé)
- **`docker-compose.override.prod.yml`** : Override production (copié sur serveur)

### Variables d'environnement

**Local** : `.env` (git ignoré)
```env
MYSQL_DATABASE=asturingdb
MYSQL_USER=asturingudb
MYSQL_PASSWORD=userpass
```

**Production** : Définies dans `docker-compose.override.yml` sur le serveur

---

## 🔄 CI/CD

### Workflow GitHub Actions

Fichier : `.github/workflows/deploy-prod.yml`

**Déclenchement** : Push sur `main` ou `master`

**Étapes** :
1. Checkout du code
2. Setup SSH vers serveur
3. Rsync des fichiers (exclut node_modules, .git, etc.)
4. Copie du `docker-compose.override.prod.yml`
5. Rebuild des images Docker
6. Redémarrage des containers
7. Nettoyage des images obsolètes

### Secrets GitHub requis

À configurer dans **Settings → Secrets and variables → Actions** :

- `SSH_PRIVATE_KEY` : Clé privée SSH pour se connecter au serveur

---

## 🛠️ Commandes Utiles

### Développement

```bash
# Rebuild un service spécifique
docker compose up -d --build nuxt

# Accéder au shell d'un container
docker compose exec nuxt sh

# Voir les logs
docker compose logs -f nuxt

# Nettoyer tout
docker compose down -v
docker system prune -a
```

### Production (sur le serveur)

```bash
# Voir les containers actifs
docker compose ps

# Redémarrer un service
docker compose restart nuxt

# Voir les logs
docker compose logs -f nuxt

# Rebuild après changements
docker compose up -d --build --force-recreate

# Backup base de données
docker compose exec mysql mysqldump -u root -p asturingdb > backup.sql
```

---

## 📝 Nuxt Config

### SSR activé

```typescript
// nuxt.config.ts
export default defineNuxtConfig({
  ssr: true,
  nitro: {
    preset: 'node-server',
  }
})
```

### Différences Local vs Prod

| Paramètre | Local | Prod |
|-----------|-------|------|
| `NODE_ENV` | development | production |
| Hot reload | ✅ | ❌ |
| Source maps | ✅ | ❌ |
| Build | À la volée | Pre-built |

---

## 🐛 Troubleshooting

### Le site ne répond pas en local

```bash
# Vérifier que Traefik tourne
docker ps | grep traefik

# Vérifier les logs
docker compose logs nuxt

# Vérifier l'IP du container
docker compose exec nuxt hostname -i
```

### Rebuild complet

```bash
docker compose down -v
docker compose build --no-cache
docker compose up -d
```

### Problèmes de permissions (prod)

```bash
# Sur le serveur
cd /srv/www/asturing/prod
sudo chown -R chado:asturing .
chmod -R 755 .
```

---

## 📚 Documentation

- [Nuxt 3](https://nuxt.com/)
- [Symfony](https://symfony.com/doc/current/index.html)
- [Docker Compose](https://docs.docker.com/compose/)
- [Traefik](https://doc.traefik.io/traefik/)

---

## 🔐 Sécurité

- ✅ Pas de credentials en dur dans le code
- ✅ `.env` git ignoré
- ✅ Secrets GitHub pour CI/CD
- ✅ Healthchecks sur tous les containers
- ✅ Volumes MySQL persistants
- ✅ User www-data pour containers (non-root)

---

## 📞 Contact

Alexandre SALÉ - alexandre@as-turing.fr
