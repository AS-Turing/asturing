/**
 * Plugin GTM - Charge Google Tag Manager
 * Doit être chargé côté client uniquement
 */
export default defineNuxtPlugin(() => {
  // Initialise dataLayer
  window.dataLayer = window.dataLayer || []
  
  // Pousse l'événement de démarrage GTM
  window.dataLayer.push({
    'gtm.start': new Date().getTime(),
    event: 'gtm.js'
  })
  
  // Charge le script GTM
  const script = document.createElement('script')
  script.async = true
  script.src = 'https://www.googletagmanager.com/gtm.js?id=GTM-TK6GRG67'
  
  const firstScript = document.getElementsByTagName('script')[0]
  firstScript.parentNode?.insertBefore(script, firstScript)
  
  // Ajoute le noscript iframe pour GTM
  if (document.body) {
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
