<script setup lang="ts">

import getFigerprint from "../../../utils/fingerprint";

const fingerprint = ref<string>('Chargement...')

onMounted(async () => {
  fingerprint.value = await getFigerprint()
})

</script>

<template>
  <div class="p-4">
    <h1 class="text-xl font-bold">Votre empreinte d'appareil :</h1>
    <p class="mt-4 font-mono break-all text-blue-600">{{ fingerprint }}</p>
  </div></template>

<style scoped>

</style>