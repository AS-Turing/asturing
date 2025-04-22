<script setup lang="ts">
import services from '@/data/services'
import ServiceLayout from '@/components/service/ServiceLayout.vue'

const service = services.find(s => s.slug === 'formation-vulgarisation')

useSeo()
</script>

<template>
  <ServiceLayout :service="service!" />
</template>

<style scoped>
</style>