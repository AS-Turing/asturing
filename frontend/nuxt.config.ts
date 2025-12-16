// https://nuxt.com/docs/api/configuration/nuxt-config
import tailwindcss from "@tailwindcss/vite";

export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  future: {
    compatibilityVersion: 4
  },
  devtools: { enabled: false },
  modules: ['@nuxt/eslint', '@nuxt/image', '@nuxt/icon', '@nuxtjs/sitemap'],

  // Configuration de Nuxt Icon
  icon: {
    serverBundle: {
      collections: ['skill-icons', 'simple-icons', 'logos', 'mdi']
    }
  },

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

  app: {
    head: {
      htmlAttrs: {
        lang: 'fr'
      },
      script: [
        {
          children: `(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N49FF724');`,
          type: 'text/javascript'
        }
      ],
      noscript: [
        {
          children: `<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N49FF724" height="0" width="0" style="display:none;visibility:hidden"></iframe>`
        }
      ],
      link: [
        // Preconnect to API for faster data fetching
        { rel: 'preconnect', href: process.env.NUXT_PUBLIC_API_BASE || 'http://symfony' },
        { rel: 'dns-prefetch', href: process.env.NUXT_PUBLIC_API_BASE || 'http://symfony' }
      ]
    }
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

    // Pages dynamiques : SSR pur TEMPORAIREMENT (ISR désactivé pour debug cache)
    '/services/**': { ssr: true },
    '/processus': { ssr: true },
    '/blog': { ssr: true },
    '/blog/**': { ssr: true },
    '/projets': { ssr: true },
    '/projets/**': { ssr: true },
    '/contact': { ssr: true },
    '/localisation': { ssr: true },
    '/localisation/**': { ssr: true },

    // API : PAS de cache pour le moment (debug)
    '/api/**': { cache: false },

    // Nuxt Icon : servir localement
    '/_nuxt_icon/**': { cache: true, headers: { 'Cache-Control': 'public, max-age=31536000' } },
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
      // PAGES HTML : pas de cache navigateur pour voir les modifs immédiatement
      '/projets/**': {
        headers: {
          'Cache-Control': 'no-store, no-cache, must-revalidate, proxy-revalidate',
          'Pragma': 'no-cache',
          'Expires': '0'
        }
      },
      '/localisation/**': {
        headers: {
          'Cache-Control': 'no-store, no-cache, must-revalidate, proxy-revalidate',
          'Pragma': 'no-cache',
          'Expires': '0'
        }
      },
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
