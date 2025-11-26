# ================================
# Production Dockerfile - Nuxt SSR
# Multi-stage build optimisé
# ================================

# ─────────────────────────────────
# Stage 1: Build
# ─────────────────────────────────
FROM node:18 AS builder

WORKDIR /app

# Copy dependency files
COPY package.json pnpm-lock.yaml ./

# Install pnpm and dependencies
RUN npm install -g pnpm && \
    pnpm install --frozen-lockfile

# Copy source code
COPY . .

# Build for production
RUN pnpm build

# ─────────────────────────────────
# Stage 2: Production
# ─────────────────────────────────
FROM node:18-alpine

WORKDIR /app

# Copy built output from builder
COPY --from=builder /app/.output ./.output

# Expose port
EXPOSE 3000

# Environment variables
ENV NITRO_HOST=0.0.0.0
ENV NITRO_PORT=3000
ENV NODE_ENV=production

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=40s --retries=3 \
  CMD node -e "require('http').get('http://localhost:3000', (r) => {process.exit(r.statusCode === 200 ? 0 : 1)})"

# Run the server
CMD ["node", ".output/server/index.mjs"]
