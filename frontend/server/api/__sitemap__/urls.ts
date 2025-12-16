import { defineSitemapEventHandler } from '#imports'
import type { SitemapUrl } from '#sitemap/types'

export default defineSitemapEventHandler(async () => {
  const config = useRuntimeConfig()
  const apiBase = config.public.apiBase || 'http://symfony'
  
  const urls: SitemapUrl[] = []
  
  try {
    // Services
    const servicesResponse = await $fetch(`${apiBase}/api/services`)
    if (servicesResponse && Array.isArray(servicesResponse)) {
      servicesResponse.forEach((service: any) => {
        urls.push({
          loc: `/services/${service.slug}`,
          lastmod: service.updatedAt || new Date().toISOString(),
          changefreq: 'monthly',
          priority: 0.8
        })
      })
    }
    
    // Projets  
    const projetsResponse = await $fetch(`${apiBase}/api/projects`)
    if (projetsResponse && Array.isArray(projetsResponse)) {
      projetsResponse.forEach((projet: any) => {
        urls.push({
          loc: `/projets/${projet.slug}`,
          lastmod: projet.updatedAt || new Date().toISOString(),
          changefreq: 'monthly',
          priority: 0.7
        })
      })
    }
    
    // Locations (pages locales SEO) - skip if error
    try {
      const locationsResponse = await $fetch(`${apiBase}/api/locations`)
      if (locationsResponse && Array.isArray(locationsResponse)) {
        locationsResponse.forEach((location: any) => {
          urls.push({
            loc: `/creation-site-internet-${location.slug}`,
            lastmod: location.updatedAt || new Date().toISOString(),
            changefreq: 'monthly',
            priority: 0.9 // Haute priorité pour SEO local
          })
        })
      }
    } catch (locationsError: any) {
      console.error('Locations API error:', locationsError.message || locationsError)
      console.error('Locations API URL tried:', `${apiBase}/api/locations`)
    }
    
    // Blog - skip if 404
    try {
      const blogResponse = await $fetch(`${apiBase}/api/blog/posts`)
      if (blogResponse && Array.isArray(blogResponse)) {
        blogResponse.forEach((article: any) => {
          urls.push({
            loc: `/blog/${article.slug}`,
            lastmod: article.publishedAt || new Date().toISOString(),
            changefreq: 'weekly',
            priority: 0.6
          })
        })
      }
    } catch (blogError: any) {
      console.error('Blog API error:', blogError.message || blogError)
      console.error('Blog API URL tried:', `${apiBase}/api/blog/posts`)
    }
  } catch (error) {
    console.error('Error fetching dynamic routes for sitemap:', error)
  }
  
  return urls
})
