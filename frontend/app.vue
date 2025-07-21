<template>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
  <MainNotifications />
</template>

<script setup lang="ts">
useHead({
  htmlAttrs: {
    lang: 'fr',
  }
})
</script>