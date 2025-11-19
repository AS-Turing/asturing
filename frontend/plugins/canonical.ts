export default defineNuxtPlugin(() => {
  const route = useRoute()
  const { $config } = useNuxtApp()
  
  // Le module @nuxtjs/sitemap expose automatiquement site.url
  // On peut y accéder via import.meta.env ou directement
  const siteUrl = 'https://www.as-turing.fr' // Correspond à site.url dans nuxt.config.ts
  
  useHead(() => {
    // Normaliser le path en retirant le trailing slash (sauf pour la home)
    const normalizedPath = route.path === '/' ? '/' : route.path.replace(/\/$/, '')
    
    return {
      link: [
        {
          rel: 'canonical',
          href: `${siteUrl}${normalizedPath}`,
          key: 'canonical'
        }
      ]
    }
  })
})
