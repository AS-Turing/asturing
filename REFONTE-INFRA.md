# 🎯 Refonte Infrastructure AS-Turing - Résumé

## ✅ Changements effectués

### 1. Configuration Nuxt (SSR activé)

**Avant** : `ssr: false`, `preset: 'static'` (incohérent local ↔ prod)  
**Après** : `ssr: true`, `preset: 'node-server'` (unifié)

📄 Fichier : `frontend/nuxt.config.ts`

---

### 2. Dockerfiles optimisés

#### Frontend

- **`Dockerfile`** (PROD) : Multi-stage build, image alpine ~100MB
- **`Dockerfile.dev`** (DEV) : Hot reload, volumes

#### Backend

- **`Dockerfile`** (PROD) : Composer --no-dev, optimisé
- **`Dockerfile.dev`** (DEV) : Tous les outils de dev

---

### 3. Docker Compose simplifié

**Structure** :
```
docker-compose.yml              ← Base commune (services)
docker-compose.override.yml     ← Local DEV (auto-chargé, gitignored)
docker-compose.override.prod.yml ← Production (copié sur serveur)
```

**Avantages** :
- ✅ Un seul fichier de base
- ✅ Overrides par environnement
- ✅ Pas de confusion dev/prod

---

### 4. CI/CD vers serveur perso

**Nouveau workflow** : `.github/workflows/deploy-prod.yml`

**Déclencheur** : Push sur `main`/`master`

**Actions** :
1. Rsync code vers serveur
2. Copie `docker-compose.override.prod.yml`
3. Rebuild images Docker
4. Redémarrage containers
5. Nettoyage

**Secret requis** : `SSH_PRIVATE_KEY` (à configurer dans GitHub)

---

### 5. Script de déploiement manuel

**Nouveau** : `deploy.sh`

```bash
./deploy.sh
```

Fait la même chose que la CI/CD mais en manuel.

---

### 6. Documentation

**Nouveau** : `INFRASTRUCTURE.md`

Guide complet :
- Architecture
- Commandes Docker
- Configuration
- Troubleshooting

---

### 7. Gitignore mis à jour

Ajout : `docker-compose.override.yml` (local uniquement)

---

## 🚀 Prochaines étapes

### Étape 1 : Tester en local

```bash
cd /Users/chado/dev/clients/as-turing/site
docker compose down -v
docker compose up -d --build
```

Vérifier : http://as-turing.localhost

---

### Étape 2 : Configurer GitHub Secret

1. Aller sur https://github.com/[ton-user]/[ton-repo]/settings/secrets/actions
2. Ajouter `SSH_PRIVATE_KEY`
3. Coller ta clé privée SSH (celle qui connecte au serveur)

---

### Étape 3 : Premier déploiement

**Option A - Via CI/CD** :
```bash
git add .
git commit -m "🚀 Refonte infrastructure SSR + CI/CD"
git push origin main
```

GitHub Actions va automatiquement déployer.

**Option B - Manuel** :
```bash
./deploy.sh
```

---

### Étape 4 : Vérifier sur serveur

SSH vers serveur :
```bash
ssh -p 2222 chado@2a01:e0a:ba9:ecc0:329c:23ff:fe66:7881
cd /srv/www/asturing/prod
docker compose ps
```

Tu devrais voir :
```
asturing-prod-nuxt     Up
asturing-prod-symfony  Up
asturing-prod-mysql    Up (healthy)
```

---

## 🐛 Si ça ne marche pas

### Erreur : "Cannot connect to Docker daemon"

Sur le serveur :
```bash
sudo usermod -aG docker $USER
# Puis déconnecte/reconnecte
```

### Erreur : Healthcheck failed

```bash
docker compose logs nuxt
docker compose logs symfony
```

### Erreur : Traefik ne route pas

Vérifier labels Traefik :
```bash
docker compose config
```

---

## 📝 Checklist finale

- [ ] Nuxt SSR fonctionne en local
- [ ] Docker build sans erreur
- [ ] GitHub Secret configuré
- [ ] Premier déploiement OK
- [ ] Site accessible sur www.as-turing.fr
- [ ] Logs propres (pas d'erreurs)

---

## 🎉 Une fois en place

Tu pourras :
- ✅ Push sur `main` → Déploiement auto
- ✅ Rollback facile (git revert + push)
- ✅ Monitoring avec `docker compose logs -f`
- ✅ Backup MySQL simple

---

**Prêt à tester ?** 🚀

Commence par :
```bash
cd /Users/chado/dev/clients/as-turing/site
docker compose down
docker compose up -d --build
```
