<template>
  <section id="faq" class="py-24 px-4 bg-white dark:bg-gray-900 transition-colors scroll-mt-20">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
          Questions fréquentes
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400">
          {{ subtitle }}
        </p>
      </div>
      
      <div class="max-w-4xl mx-auto space-y-4">
        <div 
          v-for="(faq, index) in faqs" 
          :key="faq.id || index"
          class="bg-gray-50 dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-200/50 dark:border-gray-700/50"
        >
          <button
            @click="toggleFaq(index)"
            class="w-full font-bold text-lg text-gray-900 dark:text-white flex justify-between items-center p-6 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-750 transition-colors text-left rounded-2xl"
          >
            <span class="pr-8 flex items-start gap-3">
              <span class="flex-shrink-0 mt-1 w-7 h-7 rounded-full bg-gradient-to-br from-[var(--color-primary)]/20 to-[var(--color-secondary)]/20 flex items-center justify-center text-sm font-bold text-[var(--color-primary)]">
                {{ index + 1 }}
              </span>
              <span>{{ faq.question }}</span>
            </span>
            <MdiIcon 
              name="mdi:chevron-down" 
              class="w-6 h-6 transition-transform duration-300 flex-shrink-0 text-[var(--color-primary)]"
              :class="{ 'rotate-180': openIndex === index }"
            />
          </button>
          
          <Transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="max-h-0 opacity-0"
            enter-to-class="max-h-96 opacity-100"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="max-h-96 opacity-100"
            leave-to-class="max-h-0 opacity-0"
          >
            <div
              v-if="openIndex === index"
              class="overflow-hidden"
            >
              <div class="px-6 pb-6 pl-[72px] border-t border-gray-200/50 dark:border-gray-700/50 pt-4">
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ faq.answer }}</p>
              </div>
            </div>
          </Transition>
        </div>
      </div>
      
      <div class="mt-16 text-center p-8 bg-gradient-to-br from-[var(--color-primary)]/10 to-[var(--color-secondary)]/10 rounded-3xl border border-[var(--color-primary)]/20">
        <div class="flex items-center justify-center mb-4">
          <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] flex items-center justify-center">
            <MdiIcon name="mdi:help-circle" class="w-6 h-6 text-white" />
          </div>
        </div>
        <p class="text-lg text-gray-700 dark:text-gray-300 mb-4 font-semibold">
          Vous avez d'autres questions ?
        </p>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
          Notre équipe est là pour vous répondre et vous accompagner
        </p>
        <NuxtLink 
          to="/contact"
          class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] text-white font-semibold rounded-lg hover:shadow-xl transition-all hover:-translate-y-0.5"
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

const openIndex = ref<number | null>(null)

const toggleFaq = (index: number) => {
  openIndex.value = openIndex.value === index ? null : index
}
</script>
