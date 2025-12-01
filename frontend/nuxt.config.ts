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
  
  vite: {
    plugins: [
      tailwindcss(),
    ],
    server: {
      allowedHosts: ['v2.as-turing.local']
    }
  }
})