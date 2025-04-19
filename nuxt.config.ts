/* eslint-disable @typescript-eslint/naming-convention */
// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  css: ['~/assets/css/app.css'],
  colorMode: {
    dataValue: 'theme',
    classSuffix: '',
    preference: process.env.NUXT_COLOR_MODE || 'light',
    fallback: 'light',
  },
  devtools: {
    enabled: process.env.NODE_ENV !== 'production',
    timeline: {
      enabled: process.env.NODE_ENV !== 'production',
    },
  },

  // i18n: {
  //   defaultLocale: 'fr',
  //   detectBrowserLanguage: false,
  //   langDir: 'lang',
  //   lazy: true,
  //   locales: [
  //     {
  //       code: 'en',
  //       dir: 'ltr',
  //       file: 'en-EN.json',
  //       name: 'English',
  //     },
  //     {
  //       code: 'fr',
  //       dir: 'ltr',
  //       file: 'fr-FR.json',
  //       name: 'Français',
  //     },
  //   ],
  //   vueI18n: './i18n.config.ts',
  // },
  modules: [
    '@nuxt/devtools',
    '@nuxtjs/tailwindcss',
    'nuxt-icon',
    '@vee-validate/nuxt',
    '@hebilicious/vue-query-nuxt',
    'nuxt-svgo',
    '@nuxtjs/color-mode',
    '@pinia/nuxt',
  ],
  tailwindcss: {
    configPath: './tailwind.config.ts',
    editorSupport: { autocompleteUtil: { as: 'tailwindClasses' }, generateConfig: true },
  },
  typescript: {
    typeCheck: process.env.CI !== 'true',
  },
  ssr: true,
  nitro: {
    preset: process.env.NUXT_ENV_PRESET || 'node-server',
  },
  compatibilityDate: '2025-04-13',
})