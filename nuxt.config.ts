/* eslint-disable @typescript-eslint/naming-convention */
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
  site: {
    url: 'https://www.as-turing.fr'
  },
  sitemap: {
    siteUrl: 'https://www.as-turing.fr',
    trailingSlash: true,
    gzip: true,
    autoLastmod: true,
    defaults: {
      changefreq: 'monthly',
      priority: 0.8,
    },
    routes: async () => [
      '/',
      '/services',
      '/services/creation-site-internet',
      '/services/conseil-accompagnement-digital',
      '/services/developpement-sur-mesure',
      '/services/maintenance-support-technique',
      '/services/integration-solutions-externes',
      '/services/formation-vulgarisation',
      '/about',
      '/contact',
      '/conditions-generales-de-ventes',
      '/engagements'
    ]
  },
  nitro: {
    preset: process.env.NUXT_ENV_PRESET || 'static',
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
    public: {} // tu peux ajouter ici d'autres configs accessibles en client
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