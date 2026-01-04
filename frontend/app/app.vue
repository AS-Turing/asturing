<template>
  <div>
    <NuxtLayout>
      <NuxtPage />
      <MainNotifications />
    </NuxtLayout>
  </div>
</template>

<script setup>
// Charge GTM directement au montage du composant
onMounted(() => {
  // Initialise dataLayer
  window.dataLayer = window.dataLayer || []
  window.dataLayer.push({
    'gtm.start': new Date().getTime(),
    event: 'gtm.js'
  })
  
  // Injecte le script GTM
  const script = document.createElement('script')
  script.async = true
  script.src = 'https://www.googletagmanager.com/gtm.js?id=GTM-TK6GRG67'
  document.head.appendChild(script)
  
  // Ajoute le noscript iframe
  const noscript = document.createElement('noscript')
  const iframe = document.createElement('iframe')
  iframe.src = 'https://www.googletagmanager.com/ns.html?id=GTM-TK6GRG67'
  iframe.height = '0'
  iframe.width = '0'
  iframe.style.display = 'none'
  iframe.style.visibility = 'hidden'
  noscript.appendChild(iframe)
  document.body.insertBefore(noscript, document.body.firstChild)
})
</script>
