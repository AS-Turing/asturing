import { createGtm } from '@gtm-support/vue-gtm'

export default defineNuxtPlugin((nuxtApp) => {
  if (process.client) {
    const router = useRouter()
    
    const gtm = createGtm({
      id: 'GTM-TK6GRG67',
      defer: false,
      compatibility: false,
      enabled: true,
      debug: true,
      loadScript: true,
      vueRouter: router,
      trackOnNextTick: false,
    })

    nuxtApp.vueApp.use(gtm)
    
    // Exposer GTM dans nuxtApp pour qu'il soit accessible via useNuxtApp()
    return {
      provide: {
        gtm: nuxtApp.vueApp.config.globalProperties.$gtm
      }
    }
  }
})
