<template>
  <div>
    <!-- GTM Script -->
    <ClientOnly>
      <component :is="'script'">
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TK6GRG67');
      </component>
    </ClientOnly>
    
    <NuxtLayout>
      <NuxtPage />
      <MainNotifications />
    </NuxtLayout>
  </div>
</template>

<script setup>
// Initialise dataLayer dès que possible côté client
if (import.meta.client) {
  window.dataLayer = window.dataLayer || []
}
</script>
