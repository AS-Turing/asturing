/**
 * Plugin Nuxt pour tracker automatiquement les vues de pages avec GTM
 */
export default defineNuxtPlugin((nuxtApp) => {
  const router = useRouter()
  const gtm = useGtm()

  // Tracker la page initiale
  router.isReady().then(() => {
    const route = router.currentRoute.value
    gtm.trackPageView(route.path, route.name?.toString())
  })

  // Tracker les changements de route
  router.afterEach((to) => {
    // Attendre que le DOM soit mis à jour
    nextTick(() => {
      gtm.trackPageView(to.path, to.name?.toString())
    })
  })
})
