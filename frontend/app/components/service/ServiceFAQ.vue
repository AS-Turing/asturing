<template>
  <section class="py-24 px-4 bg-white dark:bg-gray-900 transition-colors">
    <div class="max-w-4xl mx-auto">
      <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
          Questions fréquentes
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400">
          {{ subtitle }}
        </p>
      </div>
      
      <div class="space-y-4">
        <details 
          v-for="(faq, index) in faqs" 
          :key="faq.id || index"
          class="bg-gray-50 dark:bg-gray-800 rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-all group"
        >
          <summary class="font-bold text-lg text-gray-900 dark:text-white list-none flex justify-between items-center p-6 cursor-pointer">
            <span class="pr-8">{{ faq.question }}</span>
            <MdiIcon name="mdi:chevron-down" class="w-6 h-6 transition-transform group-open:rotate-180 flex-shrink-0 text-[var(--color-primary)]" />
          </summary>
          <div class="px-6 pb-6">
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ faq.answer }}</p>
          </div>
        </details>
      </div>
      
      <div class="mt-12 text-center p-8 bg-gradient-to-br from-[var(--color-primary)]/10 to-[var(--color-secondary)]/10 rounded-3xl">
        <p class="text-lg text-gray-700 dark:text-gray-300 mb-4">
          Vous avez d'autres questions ?
        </p>
        <NuxtLink 
          to="/contact"
          class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-secondary)] text-white font-semibold rounded-lg hover:shadow-xl transition-all"
        >
          Contactez-nous
          <MdiIcon name="mdi:arrow-right" class="w-5 h-5" />
        </NuxtLink>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
defineProps<{
  subtitle: string
  faqs: Array<{
    id?: number
    question: string
    answer: string
  }>
}>()
</script>
