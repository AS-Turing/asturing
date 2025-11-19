<script setup lang="ts">
import {useRoute} from "vue-router";
import {Service} from "../../types/services";
import {useRuntimeConfig} from "nuxt/app";

const config = useRuntimeConfig()
const route = useRoute()

const baseUrl = import.meta.server ? config.apiBaseUrl : config.public.apiBaseUrl
const slug = route.params.slug as string

const { data: response, error } = await useFetch(`${baseUrl}/service/${slug}`)

if (error.value) {
  throw createError({
    statusCode: 404,
    statusMessage: 'Service non trouvé',
    fatal: true,
  })
}

const service = computed(() => response.value?.success ? response.value.data : null)
</script>

<template>
  <ServiceLayout v-if="service" :service="service!" />
</template>