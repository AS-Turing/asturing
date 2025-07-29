<script setup lang="ts">
import {useRoute} from "vue-router";
import {Service} from "../../types/services";

const route = useRoute()
const slug = route.params.slug as string

const { data: response } = await useFetch(`/api/service/${slug}`, {
  baseURL: process.env.API_BASE_URL || 'http://backend.localhost:8000',
})

const service: Service = response.value?.success ? response.value.data : null

if (!location) {
  throw createError({
    statusCode: 404,
    statusMessage: 'Service non trouvé',
    fatal: true,
  })
}
</script>

<template>
  <ServiceLayout :service="service!" />
</template>

<style scoped>

</style>