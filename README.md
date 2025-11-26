# AS-Turing - Site Web Officiel

Site web institutionnel de AS-Turing avec architecture moderne.

## 🏗️ Architecture

- **Frontend**: Nuxt 3 (SSR) + Vue 3 + TypeScript + Tailwind CSS
- **Backend**: Symfony 6 + PHP 8.3
- **Database**: MySQL 8.0
- **Infrastructure**: Docker + Traefik

## 🚀 Démarrage Rapide

### Développement Local

```bash
# Démarrer tous les services
docker compose up -d

# Voir les logs
docker compose logs -f
```

**URLs locales** :
- Frontend: http://as-turing.localhost
- Backend: http://backend.localhost:8000

### Production

Le déploiement en production est automatisé via GitHub Actions.

Push sur `main` → Build → Deploy → Production

## 📦 Structure du Projet

```
.
├── frontend/          # Application Nuxt 3
├── backend/           # API Symfony 6
├── .github/           # CI/CD GitHub Actions
└── docker-compose.yml # Configuration Docker
```

## 🔧 Scripts Disponibles

```bash
# Configuration CI/CD
./setup-cicd.sh       # Configuration interactive

# Déploiement manuel
./deploy.sh           # Déployer en production

# Rollback
./rollback.sh         # Retour version précédente
```

## 📚 Documentation

La documentation technique est disponible localement :
- Frontend : `frontend/README.md`
- Backend : `backend/README.md` (si disponible)
- CI/CD : Documentation disponible après configuration

## 🛠️ Développement

### Frontend
```bash
cd frontend
pnpm install
pnpm dev
```

### Backend
```bash
cd backend
composer install
php bin/console server:run
```

## 📞 Contact

AS-Turing Consulting  
alexandre@as-turing.fr

---

**License**: Propriétaire  
**Copyright**: © 2024 AS-Turing
