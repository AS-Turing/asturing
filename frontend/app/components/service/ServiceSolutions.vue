<template>
  <section class="py-24 px-4 bg-gray-50 dark:bg-gray-800 transition-colors">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
          Nos Solutions
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
          Des offres adaptées à chaque besoin et chaque budget
        </p>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div 
          v-for="(solution, index) in solutions" 
          :key="solution.id || index"
          class="bg-white dark:bg-gray-900 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 relative overflow-hidden group"
        >
          <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-secondary)]"></div>
          
          <div v-if="index === 1" class="absolute top-6 right-6 px-3 py-1 bg-[var(--color-coral)] text-white text-xs font-bold rounded-full">
            Populaire
          </div>
          
          <div class="mb-6">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[var(--color-primary)]/10 to-[var(--color-secondary)]/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <MdiIcon :name="solution.icon || 'mdi:check-circle'" class="!w-8 !h-8 text-[var(--color-primary)]" />
            </div>
            <h3 class="text-2xl font-bold mb-3 text-gray-900 dark:text-white">{{ solution.title }}</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">{{ solution.description }}</p>
          </div>
          
          <ul v-if="solution.features && solution.features.length" class="space-y-3 mb-6">
            <li v-for="(feature, idx) in solution.features" :key="idx" class="flex items-start gap-3">
              <MdiIcon name="mdi:check-circle" class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" />
              <span class="text-gray-700 dark:text-gray-300">{{ feature }}</span>
            </li>
          </ul>
          
          <NuxtLink 
            to="/contact"
            class="block w-full text-center px-6 py-3 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-secondary)] text-white font-semibold rounded-xl hover:shadow-lg transition-all"
          >
            Choisir cette solution
          </NuxtLink>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
defineProps<{
  solutions: Array<{
    id?: number
    icon?: string
    title: string
    description: string
    features?: string[]
  }>
}>()
</script>
