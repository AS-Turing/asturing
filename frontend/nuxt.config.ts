 
// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  colorMode: {
    dataValue: 'theme',
    classSuffix: '',
    preference: process.env.NUXT_COLOR_MODE || 'light',
    fallback: 'light',
  },
  compatibilityDate: '2025-04-13',
  css: ['~/assets/css/app.css'],
  devtools: {
    enabled: process.env.NODE_ENV !== 'production',
    timeline: {
      enabled: process.env.NODE_ENV !== 'production',
    },
  },
  vite: {
    server: {
      allowedHosts: ['www.as-turing.fr', 'as-turing.fr'],
    },
  },
  head: {
    htmlAttrs: {
      lang: 'fr'
    }
  },
  nitro: {
    preset: 'node-server',
  },
  mail: {
    message: {
      to: 'alexandre@as-turing.fr',
    },
    smtp: {
      host: 'ssl0.ovh.net',
      port: 587,
      auth: {
        user: process.env.SMTP_USER,
        pass: process.env.SMTP_PASS,
      }
    }
  },
  modules: [
    '@nuxt/devtools',
    '@nuxtjs/tailwindcss',
    'nuxt-icon',
    '@vee-validate/nuxt',
    '@hebilicious/vue-query-nuxt',
    'nuxt-svgo',
    '@nuxtjs/color-mode',
    '@pinia/nuxt',
    '@nuxtjs/sitemap'
  ],
  runtimeConfig: {
    apiBaseUrl: process.env.API_BASE_URL ? `${process.env.API_BASE_URL}/api` : 'http://symfony/api',
    mail: {
      smtp: {
        host: 'ssl0.ovh.net',
        port: 587,
        auth: {
          user: process.env.SMTP_USER,
          pass: process.env.SMTP_PASS,
        }
      },
      message: {
        to: 'alexandre@as-turing.fr'
      }
    },
    public: {
      apiBaseUrl: process.env.NUXT_PUBLIC_API_BASE || '/api'
    }
  },
  site: {
    url: 'https://www.as-turing.fr'
  },
  sitemap: {
    siteUrl: 'https://www.as-turing.fr',
    trailingSlash: false,
    gzip: true,
    autoLastmod: true,
    xls: false,
    defaults: {
      changefreq: 'monthly',
      priority: 0.8,
    },
    exclude: [
      '/admin/**',
    ],
    urls: [
      { url: '/', changefreq: 'monthly', priority: 0.9 },
      { url: '/services', changefreq: 'monthly', priority: 0.8 },
      { url: '/services/creation-site-internet', changefreq: 'monthly', priority: 0.7 },
      { url: '/services/conseil-accompagnement-digital', changefreq: 'monthly', priority: 0.7 },
      { url: '/services/developpement-sur-mesure', changefreq: 'monthly', priority: 0.7 },
      { url: '/services/maintenance-support-technique', changefreq: 'monthly', priority: 0.7 },
      { url: '/services/integration-solutions-externes', changefreq: 'monthly', priority: 0.7 },
      { url: '/services/formation-vulgarisation', changefreq: 'monthly', priority: 0.7 },
      { url: '/about', changefreq: 'monthly', priority: 0.8 },
      { url: '/contact', changefreq: 'monthly', priority: 0.8 },
      { url: '/conditions-generales-de-ventes', changefreq: 'monthly', priority: 0.8 },
      { url: '/engagements', changefreq: 'monthly', priority: 0.8 },
      { url: '/localisation/libourne', changefreq: 'monthly', priority: 0.7 },
      { url: '/localisation/bordeaux', changefreq: 'monthly', priority: 0.7 },
      { url: '/localisation/saint-emilion', changefreq: 'monthly', priority: 0.7 },
      { url: '/localisation/creon', changefreq: 'monthly', priority: 0.7 },
      { url: '/localisation/sauveterre-de-guyenne', changefreq: 'monthly', priority: 0.7 },
    ]
  },
  ssr: true,
  tailwindcss: {
    configPath: './tailwind.config.ts',
    editorSupport: { autocompleteUtil: { as: 'tailwindClasses' }, generateConfig: true },
  },
  typescript: {
    typeCheck: false,
  },
})