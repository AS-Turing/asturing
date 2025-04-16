/* eslint-disable @typescript-eslint/naming-convention */
// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  css: ['~/assets/css/app.css'],
  colorMode: {
    dataValue: 'theme',
    classSuffix: '',
    preference: 'asturing',
    fallback: 'asturing',
  },
  devtools: {
    enabled: true,
    timeline: {
      enabled: true,
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
  compatibilityDate: '2025-04-13',
})