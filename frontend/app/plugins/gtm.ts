export default defineNuxtPlugin(() => {
  if (process.client) {
    // Initialiser dataLayer et google_tag_manager
    window.dataLayer = window.dataLayer || []
    window.google_tag_manager = window.google_tag_manager || {}
    
    // Push l'événement initial AVANT de charger le script
    window.dataLayer.push({
      'gtm.start': new Date().getTime(),
      event: 'gtm.js'
    })
    
    // Charger le script GTM
    const script = document.createElement('script')
    script.async = true
    script.src = 'https://www.googletagmanager.com/gtm.js?id=GTM-TK6GRG67'
    
    // Ajouter au head plutôt qu'avant le premier script
    document.head.appendChild(script)
    
    // Ajouter noscript au début du body
    const noscript = document.createElement('noscript')
    const iframe = document.createElement('iframe')
    iframe.src = 'https://www.googletagmanager.com/ns.html?id=GTM-TK6GRG67'
    iframe.height = '0'
    iframe.width = '0'
    iframe.style.display = 'none'
    iframe.style.visibility = 'hidden'
    noscript.appendChild(iframe)
    
    if (document.body.firstChild) {
      document.body.insertBefore(noscript, document.body.firstChild)
    } else {
      document.body.appendChild(noscript)
    }
  }
})

// Types pour TypeScript
declare global {
  interface Window {
    dataLayer: Array<Record<string, any>>
    google_tag_manager: Record<string, any>
  }
}
