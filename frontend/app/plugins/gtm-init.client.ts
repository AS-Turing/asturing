/**
 * Plugin GTM - Charge Google Tag Manager
 * Utilise l'approche recommandée pour Nuxt 4
 */
export default defineNuxtPlugin(() => {
  // Initialise immédiatement le dataLayer
  if (typeof window !== 'undefined') {
    window.dataLayer = window.dataLayer || []
    window.dataLayer.push({
      'gtm.start': new Date().getTime(),
      event: 'gtm.js'
    })
  }

  // Charge le script GTM avec useScript
  useScript({
    src: 'https://www.googletagmanager.com/gtm.js?id=GTM-TK6GRG67',
    async: true
  })
})
