<script setup lang="ts">
useHead({
  title: 'Contact - AS Turing',
  meta: [
    { name: 'description', content: 'Prenez contact avec AS Turing pour vos besoins digitaux ou pour toute question.' },
  ],
})
useSeoMeta({
  title: 'Contact | AS-Turing',
  description: 'Prenez contact avec AS Turing pour vos besoins digitaux ou pour toute question.',
  ogUrl: 'https://www.as-turing.fr/contact',
  ogTitle: 'CGV - AS-Turing',
  ogDescription: 'Prenez contact avec AS Turing pour vos besoins digitaux ou pour toute question.',
})
</script>

<template>
  <div class="w-full bg-white dark:bg-gray-900">
    <div class="w-11/12 mx-auto flex flex-col lg:flex-row gap-10">
      <div class="w-full lg:w-1/2">
        <SectionEntreprise />
      </div>
      <div class="w-full lg:w-1/2">
        <SectionContact />
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>