// https://nuxt.com/docs/api/configuration/nuxt-config
import tailwindcss from "@tailwindcss/vite";

export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  future: {
    compatibilityVersion: 4
  },
  devtools: { enabled: false },
  modules: ['@nuxt/eslint', '@nuxt/image', '@nuxt/icon'],
  
  imports: {
    autoImport: true
  },
  
  components: {
    dirs: [
      {
        path: '~/components',
        pathPrefix: false,
      }
    ]
  },
  
  css: ['~/assets/css/main.css'],
  
  runtimeConfig: {
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE || 'http://localhost:8000'
    }
  },
  
  // ✨ Configuration du cache pour optimiser les performances
  routeRules: {
    // Page d'accueil : prérendu au build (statique)
    '/': { prerender: true },
    
    // Pages statiques : cache infini
    '/about': { static: true },
    '/services/**': { static: true },
    '/processus': { static: true },
    
    // Blog : SWR (cache 1h, revalidation en background)
    '/blog': { swr: 3600 },
    '/blog/**': { swr: 3600 },
    
    // Projets : ISR (régénération toutes les heures)
    '/projets': { isr: 3600 },
    '/projets/**': { isr: 3600 },
    
    // Contact : pas de cache (formulaire)
    '/contact': { ssr: true },
    
    // API : cache court (5 min)
    '/api/services': { cache: { maxAge: 300 } },
    '/api/projects': { cache: { maxAge: 300 } },
    '/api/clients': { cache: { maxAge: 300 } },
    '/api/blog': { cache: { maxAge: 300 } },
  },
  
  // Optimisation Nitro
  nitro: {
    compressPublicAssets: true, // Compression Gzip/Brotli
    prerender: {
      crawlLinks: true, // Crawl automatique des liens
      routes: ['/'] // Routes à prérendrer
    },
    // Headers de cache pour le navigateur
    routeRules: {
      '/_nuxt/**': {
        headers: {
          'Cache-Control': 'public, max-age=31536000, immutable' // 1 an pour les assets versionnés
        }
      },
      '/images/**': {
        headers: {
          'Cache-Control': 'public, max-age=2592000' // 30 jours pour les images
        }
      },
      '/fonts/**': {
        headers: {
          'Cache-Control': 'public, max-age=31536000, immutable' // 1 an pour les fonts
        }
      }
    }
  },
  
  // Optimisation Vite
  vite: {
    plugins: [
      tailwindcss(),
    ],
    server: {
      allowedHosts: ['v2.as-turing.local']
    },
    build: {
      rollupOptions: {
        output: {
          manualChunks: {
            // Séparer les vendors pour un meilleur cache
            'vue-vendor': ['vue', 'vue-router'],
          }
        }
      }
    }
  },
  
  // Payload extraction pour meilleures perfs
  experimental: {
    payloadExtraction: true,
    renderJsonPayloads: true
  }
})