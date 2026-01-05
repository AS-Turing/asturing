export default defineNuxtPlugin(() => {
  if (process.client) {
    // GTM sera chargé via useHead dans app.vue
    // Ce plugin sert juste à s'assurer que dataLayer existe
    window.dataLayer = window.dataLayer || []
  }
})

// Types pour TypeScript
declare global {
  interface Window {
    dataLayer: Array<Record<string, any>>
    google_tag_manager: Record<string, any>
  }
}
