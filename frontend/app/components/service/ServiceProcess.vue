<template>
  <section class="py-24 px-4 bg-white dark:bg-gray-900 transition-colors">
    <div class="max-w-6xl mx-auto">
      <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
          Notre Méthodologie
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
          Un processus éprouvé pour garantir votre réussite
        </p>
      </div>
      
      <div class="space-y-12">
        <div 
          v-for="(step, index) in steps" 
          :key="step.id || index"
          class="flex flex-col md:flex-row gap-8 items-start"
          :class="{ 'md:flex-row-reverse': index % 2 === 1 }"
        >
          <div class="flex-shrink-0 relative">
            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] flex items-center justify-center shadow-2xl">
              <span class="text-white text-3xl font-bold">{{ index + 1 }}</span>
            </div>
            <div v-if="index < steps.length - 1" class="absolute left-1/2 top-24 w-1 h-24 bg-gradient-to-b from-[var(--color-primary)] to-transparent transform -translate-x-1/2 hidden md:block"></div>
          </div>
          
          <div class="flex-1 bg-gray-50 dark:bg-gray-800 rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all">
            <h3 class="text-2xl md:text-3xl font-bold mb-4 text-gray-900 dark:text-white">{{ step.title }}</h3>
            <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">{{ step.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
defineProps<{
  steps: Array<{
    id?: number
    title: string
    description: string
  }>
}>()
</script>
