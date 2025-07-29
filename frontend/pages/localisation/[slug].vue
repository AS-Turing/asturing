<script setup lang="ts">
import { useRoute } from 'vue-router'
import LocalisationPage from '@/components/localisation/LocalisationPage.vue'
import { Localisation } from '../../types/localisation'
import {useRuntimeConfig} from "nuxt/app";

const config = useRuntimeConfig()
const route = useRoute()
const slug = route.params.slug as string
const baseUrl = config.public.apiBaseUrl

// Fetch location data from API
const { data: response } = await useFetch(`${baseUrl}/api/location/${slug}`)

const location: Localisation = response.value?.success ? response.value.data : null

// Map API response to match the expected format for LocalisationPage
const locationData = computed(() => {
  if (!location) return null

  return {
    ville: location.city,
    title: location.title,
    description: location.description,
    ogTitle: location.ogTitle,
    ogDescription: location.ogDescription,
    ogUrl: location.ogUrl,
    map: location.map,
  }
})

// Handle 404 if location not found
if (!location) {
  throw createError({
    statusCode: 404,
    statusMessage: 'Localisation non trouvée',
    fatal: true,
  })
}
</script>

<template>
  <LocalisationPage v-if="location" :data="locationData" />
  <div v-else class="px-4 py-10 sm:px-10 max-w-5xl mx-auto text-center">
    <h1 class="text-4xl font-bold text-primary dark:text-white">Localisation non trouvée</h1>
    <p class="mt-4 text-lg text-primary dark:text-white">
      La localisation que vous recherchez n'existe pas.
    </p>
    <NuxtLink
      to="/"
      class="mt-8 inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center border rounded-lg
           text-secondary bg-primary hover:text-primary hover:bg-secondary border-secondary hover:border-primary
           dark:text-primary dark:bg-secondary dark:hover:text-secondary dark:hover:bg-primary dark:border-gray-700 dark:focus:ring-gray-800
           hover:scale-105 transition-all duration-700 ease-in-out transform focus:ring-4 focus:ring-gray-100 hover:cursor-pointer"
    >
      Retour à l'accueil
    </NuxtLink>
  </div>
</template>