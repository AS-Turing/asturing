<script setup lang="ts">
import {useRoute} from "vue-router";
import {Service} from "../../types/services";
import {useRuntimeConfig} from "nuxt/app";

const config = useRuntimeConfig()
const route = useRoute()

const baseUrl = config.public.apiBaseUrl
const slug = route.params.slug as string

const { data: response } = await useFetch(`${baseUrl}/api/service/${slug}`)

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