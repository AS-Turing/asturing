# Dockerfile pour Nuxt 4 - Mode développement
FROM node:20-alpine

WORKDIR /app

# Installer pnpm
RUN npm install -g pnpm

# Copier package.json
COPY package.json pnpm-lock.yaml ./

# Installer les dépendances
RUN pnpm install

# Copier le code
COPY . .

# Exposer le port de dev
EXPOSE 3000

# Lancer en mode dev avec hot reload
CMD ["pnpm", "dev", "--host", "0.0.0.0"]
