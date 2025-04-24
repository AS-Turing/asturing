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
  </section>
</template>
