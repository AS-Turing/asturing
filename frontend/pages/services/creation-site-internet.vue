<script setup lang="ts">
import services from '@/data/services/index.ts'
import ServiceLayout from '../../components/service/ServiceLayout.vue'
const service = services.find(s => s.slug === 'creation-site-internet')

useSeo()
</script>

<template>
  <ServiceLayout :service="service!" />

</template>

<style scoped>
</style>