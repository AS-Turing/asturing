<template>
  <div class="flex min-h-screen flex-col bg-white dark:bg-gray-900">
    <MainHeader />
    <main class="flex-1">
      <slot />
    </main>
    <MainFooter />
  </div>
</template>

<script setup lang="ts">
useSeoMeta({
  charset: 'utf-8',
  viewport: 'width=device-width, initial-scale=1',
  ogType: 'website',
  ogLocale: 'fr_FR',
  ogSiteName: 'AS-Turing',
  linkCanonical: 'https://www.as-turing.fr',
})

</script>