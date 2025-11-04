export default defineNuxtPlugin(() => {
  const route = useRoute()
  const { $config } = useNuxtApp()
  
  // Le module @nuxtjs/sitemap expose automatiquement site.url
  // On peut y accéder via import.meta.env ou directement
  const siteUrl = 'https://www.as-turing.fr' // Correspond à site.url dans nuxt.config.ts
  
  useHead(() => ({
    link: [
      {
        rel: 'canonical',
        href: `${siteUrl}${route.path}`,
        key: 'canonical'
      }
    ]
  }))
})
