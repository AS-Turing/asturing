<template>
  <ServiceLayout :service="service!" />
</template>

<script setup lang="ts">
import services from '@/data/services'
import ServiceLayout from '@/components/service/ServiceLayout.vue'

const service = services.find(s => s.slug === 'formation-vulgarisation')
</script>

<style scoped>
</style>