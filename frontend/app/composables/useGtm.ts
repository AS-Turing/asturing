/**
 * Composable pour interagir avec Google Tag Manager
 * Permet de tracker des événements personnalisés facilement
 */

const useGtmPlugin = () => {
  const nuxtApp = useNuxtApp()
  return nuxtApp.$gtm || null
}

export const useGtm = () => {
  const gtm = useGtmPlugin()

  const pushEvent = (event: string, data: Record<string, any> = {}) => {
    if (gtm) {
      gtm.trackEvent({
        event,
        ...data
      })
    }
  }

  // Événements de navigation
  const trackPageView = (pageName: string, pageCategory?: string) => {
    pushEvent('page_view', {
      page_name: pageName,
      page_category: pageCategory
    })
  }

  // Événements de formulaire
  const trackFormSubmit = (formName: string, formType: string = 'contact') => {
    pushEvent('form_submit', {
      form_name: formName,
      form_type: formType
    })
  }

  const trackFormStart = (formName: string) => {
    pushEvent('form_start', {
      form_name: formName
    })
  }

  // Événements de clic
  const trackButtonClick = (buttonName: string, buttonLocation?: string) => {
    pushEvent('button_click', {
      button_name: buttonName,
      button_location: buttonLocation
    })
  }

  const trackCTAClick = (ctaName: string, ctaLocation: string) => {
    pushEvent('cta_click', {
      cta_name: ctaName,
      cta_location: ctaLocation
    })
  }

  // Événements de contenu
  const trackArticleView = (articleTitle: string, articleCategory: string, articleId?: string) => {
    pushEvent('article_view', {
      article_title: articleTitle,
      article_category: articleCategory,
      article_id: articleId
    })
  }

  const trackProjectView = (projectTitle: string, projectCategory: string, projectId?: string) => {
    pushEvent('project_view', {
      project_title: projectTitle,
      project_category: projectCategory,
      project_id: projectId
    })
  }

  const trackServiceView = (serviceTitle: string, serviceId?: string) => {
    pushEvent('service_view', {
      service_title: serviceTitle,
      service_id: serviceId
    })
  }

  // Événements d'engagement
  const trackSocialClick = (socialNetwork: string, action: string = 'share') => {
    pushEvent('social_click', {
      social_network: socialNetwork,
      action
    })
  }

  const trackDownload = (fileName: string, fileType: string) => {
    pushEvent('file_download', {
      file_name: fileName,
      file_type: fileType
    })
  }

  const trackOutboundLink = (url: string, linkText?: string) => {
    pushEvent('outbound_link', {
      url,
      link_text: linkText
    })
  }

  // Événements de scroll
  const trackScrollDepth = (percentage: number, pageName: string) => {
    pushEvent('scroll_depth', {
      scroll_percentage: percentage,
      page_name: pageName
    })
  }

  // Événements e-commerce (si besoin futur)
  const trackLeadGeneration = (leadSource: string, leadType: string, leadValue?: number) => {
    pushEvent('generate_lead', {
      lead_source: leadSource,
      lead_type: leadType,
      value: leadValue || 0,
      currency: 'EUR'
    })
  }

  return {
    pushEvent,
    trackPageView,
    trackFormSubmit,
    trackFormStart,
    trackButtonClick,
    trackCTAClick,
    trackArticleView,
    trackProjectView,
    trackServiceView,
    trackSocialClick,
    trackDownload,
    trackOutboundLink,
    trackScrollDepth,
    trackLeadGeneration
  }
}

// Types pour TypeScript
declare global {
  interface Window {
    dataLayer: Array<Record<string, any>>
  }
}
