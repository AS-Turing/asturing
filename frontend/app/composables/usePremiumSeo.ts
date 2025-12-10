import type { UseSeoMetaInput } from '@unhead/schema'

interface SeoConfig {
  title: string
  description: string
  url?: string
  image?: string
  type?: 'website' | 'article' | 'product'
  article?: {
    publishedTime?: string
    modifiedTime?: string
    author?: string
    section?: string
    tags?: string[]
  }
  breadcrumbs?: Array<{ name: string; url: string }>
  faq?: Array<{ question: string; answer: string }>
  product?: {
    name: string
    image: string
    description: string
    price?: string
    currency?: string
  }
}

export const usePremiumSeo = (config: SeoConfig) => {
  const route = useRoute()
  const siteConfig = useSiteConfig()
  
  const url = config.url || `https://www.as-turing.fr${route.path}`
  const image = config.image || 'https://www.as-turing.fr/images/og-default.jpg'
  const siteName = 'AS-Turing'
  const locale = 'fr_FR'
  
  // Base SEO Meta
  const seoMeta: UseSeoMetaInput = {
    title: config.title,
    description: config.description,
    
    // Open Graph
    ogTitle: config.title,
    ogDescription: config.description,
    ogImage: image,
    ogUrl: url,
    ogType: config.type || 'website',
    ogSiteName: siteName,
    ogLocale: locale,
    
    // Twitter Card
    twitterCard: 'summary_large_image',
    twitterTitle: config.title,
    twitterDescription: config.description,
    twitterImage: image,
    twitterSite: '@asturing', // À adapter si tu as un compte Twitter
    
    // Robots
    robots: 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'
  }
  
  useSeoMeta(seoMeta)
  
  // Canonical URL (doit être dans useHead, pas useSeoMeta)
  useHead({
    link: [
      { rel: 'canonical', href: url }
    ]
  })
  
  // JSON-LD Schemas
  const schemas: any[] = []
  
  // Organization Schema (toujours présent)
  schemas.push({
    '@context': 'https://schema.org',
    '@type': 'Organization',
    name: 'AS-Turing',
    url: 'https://www.as-turing.fr',
    logo: 'https://www.as-turing.fr/images/logo2.png',
    description: 'Agence digitale spécialisée dans la création de solutions web innovantes et performantes',
    address: {
      '@type': 'PostalAddress',
      streetAddress: 'Place Abel Surchamp',
      addressLocality: 'Libourne',
      postalCode: '33500',
      addressCountry: 'FR'
    },
    contactPoint: {
      '@type': 'ContactPoint',
      telephone: '+33-7-83-07-00-52',
      contactType: 'customer service',
      email: 'contact@as-turing.fr',
      availableLanguage: 'French'
    },
    sameAs: [
      'https://github.com/as-turing',
      'https://linkedin.com/company/as-turing',
      'https://www.facebook.com/people/AS-Turing/61580387595689/'
    ]
  })
  
  // LocalBusiness Schema
  if (route.path === '/' || route.path.includes('contact')) {
    schemas.push({
      '@context': 'https://schema.org',
      '@type': 'LocalBusiness',
      '@id': 'https://www.as-turing.fr/#business',
      name: 'AS-Turing',
      image: 'https://www.as-turing.fr/images/logo2.png',
      url: 'https://www.as-turing.fr',
      telephone: '+33783070052',
      email: 'contact@as-turing.fr',
      address: {
        '@type': 'PostalAddress',
        streetAddress: 'Place Abel Surchamp',
        addressLocality: 'Libourne',
        addressRegion: 'Nouvelle-Aquitaine',
        postalCode: '33500',
        addressCountry: 'FR'
      },
      geo: {
        '@type': 'GeoCoordinates',
        latitude: '44.9177',
        longitude: '-0.2419'
      },
      openingHoursSpecification: [
        {
          '@type': 'OpeningHoursSpecification',
          dayOfWeek: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
          opens: '08:00',
          closes: '18:30'
        },
        {
          '@type': 'OpeningHoursSpecification',
          dayOfWeek: 'Saturday',
          opens: '08:00',
          closes: '12:00'
        }
      ],
      priceRange: '€€',
      areaServed: [
        'Libourne',
        'Saint-Émilion',
        'Bordeaux',
        'Gironde',
        'Nouvelle-Aquitaine'
      ]
    })
  }
  
  // Article Schema
  if (config.type === 'article' && config.article) {
    schemas.push({
      '@context': 'https://schema.org',
      '@type': 'Article',
      headline: config.title,
      description: config.description,
      image: image,
      author: {
        '@type': 'Organization',
        name: config.article.author || 'AS-Turing'
      },
      publisher: {
        '@type': 'Organization',
        name: 'AS-Turing',
        logo: {
          '@type': 'ImageObject',
          url: 'https://www.as-turing.fr/images/logo2.png'
        }
      },
      datePublished: config.article.publishedTime,
      dateModified: config.article.modifiedTime || config.article.publishedTime,
      mainEntityOfPage: {
        '@type': 'WebPage',
        '@id': url
      }
    })
  }
  
  // Breadcrumbs Schema
  if (config.breadcrumbs && config.breadcrumbs.length > 0) {
    schemas.push({
      '@context': 'https://schema.org',
      '@type': 'BreadcrumbList',
      itemListElement: config.breadcrumbs.map((crumb, index) => ({
        '@type': 'ListItem',
        position: index + 1,
        name: crumb.name,
        item: `https://www.as-turing.fr${crumb.url}`
      }))
    })
  }
  
  // FAQ Schema
  if (config.faq && config.faq.length > 0) {
    schemas.push({
      '@context': 'https://schema.org',
      '@type': 'FAQPage',
      mainEntity: config.faq.map(item => ({
        '@type': 'Question',
        name: item.question,
        acceptedAnswer: {
          '@type': 'Answer',
          text: item.answer
        }
      }))
    })
  }
  
  // Product Schema
  if (config.product) {
    schemas.push({
      '@context': 'https://schema.org',
      '@type': 'Product',
      name: config.product.name,
      image: config.product.image,
      description: config.product.description,
      offers: config.product.price ? {
        '@type': 'Offer',
        price: config.product.price,
        priceCurrency: config.product.currency || 'EUR',
        availability: 'https://schema.org/InStock',
        url: url
      } : undefined
    })
  }
  
  // WebSite Schema avec SearchAction
  if (route.path === '/') {
    schemas.push({
      '@context': 'https://schema.org',
      '@type': 'WebSite',
      '@id': 'https://www.as-turing.fr/#website',
      url: 'https://www.as-turing.fr',
      name: 'AS-Turing',
      description: 'Agence digitale spécialisée dans la création de solutions web',
      publisher: {
        '@id': 'https://www.as-turing.fr/#organization'
      },
      potentialAction: {
        '@type': 'SearchAction',
        target: {
          '@type': 'EntryPoint',
          urlTemplate: 'https://www.as-turing.fr/blog?q={search_term_string}'
        },
        'query-input': 'required name=search_term_string'
      }
    })
  }
  
  // Inject all schemas
  useHead({
    script: schemas.map(schema => ({
      type: 'application/ld+json',
      innerHTML: JSON.stringify(schema)
    }))
  })
}
