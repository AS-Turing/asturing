<template>
  <LocalisationPage :data="data" />
</template>

<script setup lang="ts">
import { localisations } from '@/data/localisations'
import LocalisationPage from '@/components/localisation/LocalisationPage.vue'

const data = localisations.find(l => l.slug === 'saint-emilion')!
</script>
