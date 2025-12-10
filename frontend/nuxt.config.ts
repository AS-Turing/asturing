// https://nuxt.com/docs/api/configuration/nuxt-config
import tailwindcss from "@tailwindcss/vite";

export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  future: {
    compatibilityVersion: 4
  },
  devtools: { enabled: false },
  modules: ['@nuxt/eslint', '@nuxt/image', '@nuxt/icon', '@nuxtjs/sitemap'],
  
  // Configuration du sitemap
  site: {
    url: 'https://www.as-turing.fr',
  },
  
  sitemap: {
    hostname: 'https://www.as-turing.fr',
    gzip: true,
    xsl: false,
    exclude: [
      '/index-old'
    ],
    sources: [
      '/api/__sitemap__/urls'
    ]
  },
  
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
      apiBase: process.env.NUXT_PUBLIC_API_BASE || 'http://symfony'
    }
  },
  
  // ✨ Configuration du cache pour optimiser les performances
  routeRules: {
    // Page d'accueil : SSR pur (pas d'ISR pour éviter problèmes cache blog)
    '/': { ssr: true },
    
    // Pages dynamiques : ISR (régénération périodique pour perfs + SEO)
    '/services/**': { isr: 3600 },
    '/processus': { isr: 3600 },
    '/blog': { ssr: true }, // SSR pur
    '/blog/**': { ssr: true }, // SSR pur
    '/projets': { isr: 3600 },
    '/projets/**': { isr: 3600 },
    '/contact': { ssr: true }, // Pas de cache pour le formulaire
    
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
      crawlLinks: false, // Désactivé pour éviter prerendering auto
      routes: [] // Aucune route prérendue
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
      allowedHosts: ['v2.as-turing.local', 'dev.asturing.as-turing.fr']
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
