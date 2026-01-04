export default defineNuxtPlugin(() => {
  if (process.client) {
    // Initialiser dataLayer
    window.dataLayer = window.dataLayer || []
    
    // Charger le script GTM
    const script = document.createElement('script')
    script.async = true
    script.src = 'https://www.googletagmanager.com/gtm.js?id=GTM-TK6GRG67'
    
    const firstScript = document.getElementsByTagName('script')[0]
    if (firstScript && firstScript.parentNode) {
      firstScript.parentNode.insertBefore(script, firstScript)
    }
    
    // Push l'événement initial
    window.dataLayer.push({
      'gtm.start': new Date().getTime(),
      event: 'gtm.js'
    })
    
    // Ajouter noscript
    const noscript = document.createElement('noscript')
    const iframe = document.createElement('iframe')
    iframe.src = 'https://www.googletagmanager.com/ns.html?id=GTM-TK6GRG67'
    iframe.height = '0'
    iframe.width = '0'
    iframe.style.display = 'none'
    iframe.style.visibility = 'hidden'
    noscript.appendChild(iframe)
    document.body.insertBefore(noscript, document.body.firstChild)
  }
})

// Types pour TypeScript
declare global {
  interface Window {
    dataLayer: Array<Record<string, any>>
  }
}
