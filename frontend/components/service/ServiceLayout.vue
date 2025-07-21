<script setup lang="ts">
import type { Service } from '@/data/services'

const props = defineProps<{ service: Service }>()

useSeoMeta({
  title: props.service.seo.title,
  description: props.service.seo.description,
  ogTitle: props.service.seo.ogTitle,
  ogDescription: props.service.seo.ogDescription,
  ogUrl: props.service.seo.ogUrl,
})
</script>

<template>
  <section class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8 dark:text-white text-primary">
    <h1 class="text-4xl sm:text-5xl font-bold text-center text-primary dark:text-white mb-12 underline dark:decoration-secondary underline-offset-8">{{ service.title }}</h1>
    <p class="mb-8">{{ service.description }}</p>

    <h2 class="text-xl font-semibold mt-8 mb-2">Ce que le service comprend</h2>
    <ul class="relative list-disc pl-6  space-y-1">
      <li v-for="item in service.microServices" :key="item">{{ item }}</li>
    </ul>

    <h2 class="text-xl font-semibold mt-8 mb-2">Formules</h2>
    <div class="grid md:grid-cols-3 gap-6">
      <div v-for="tarif in service.prices" :key="tarif.name" class="border rounded-lg p-4 shadow">
        <h3 class="text-lg font-semibold">{{ tarif.name }}</h3>
        <p class="text-2xl font-bold text-secondary mt-2 mb-4">{{ tarif.price }}</p>
        <ul class="text-sm list-disc pl-4">
          <li v-for="include in tarif.includes" :key="include">{{ include }}</li>
        </ul>
      </div>
    </div>

    <h2 class="text-xl font-semibold mt-8 mb-2">FAQ</h2>
    <div class="space-y-4">
      <details v-for="item in service.faq" :key="item.question" class="border rounded p-3">
        <summary class="font-medium cursor-pointer">{{ item.question }}</summary>
        <p class="text-sm mt-2">{{ item.answer }}</p>
      </details>
    </div>
    <div class="text-center mt-12">
      <NuxtLink
          to="/contact"
          class="group inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center border rounded-lg
             text-secondary bg-primary hover:text-primary hover:bg-secondary border-secondary hover:border-primary
             dark:text-primary dark:bg-secondary dark:hover:text-secondary dark:hover:bg-primary dark:border-gray-700    dark:focus:ring-gray-800
             hover:scale-105 transition-all duration-700 ease-in-out transform focus:ring-4 focus:ring-gray-100 hover:cursor-pointer"
      >
        <Icon name="lucide:mail"
              class="w-5 h-5 transition-all duration-700 group-hover:scale-110 group-hover:rotate-12" />
        <span class="ml-2 transition-all duration-700 group-hover:translate-x-1 font-bold">
          Me contacter
        </span>
      </NuxtLink>
    </div>
  </section>
</template>
