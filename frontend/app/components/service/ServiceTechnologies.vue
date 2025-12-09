<template>
  <section class="py-24 px-4 bg-gray-50 dark:bg-gray-800 transition-colors">
    <div class="max-w-6xl mx-auto">
      <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
          Technologies & Outils
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
          Les meilleures technologies pour des solutions performantes et pérennes
        </p>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div 
          v-for="(tech, index) in technologies" 
          :key="tech.id || index"
          class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all flex items-start gap-4"
        >
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[var(--color-primary)]/10 to-[var(--color-secondary)]/10 flex items-center justify-center flex-shrink-0">
            <MdiIcon :name="tech.icon || 'mdi:code-tags'" class="!w-6 !h-6 text-[var(--color-primary)]" />
          </div>
          <div class="flex-1">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ tech.name }}</h3>
            <p v-if="tech.description" class="text-gray-600 dark:text-gray-300 text-sm">{{ tech.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
defineProps<{
  technologies: Array<{
    id?: number
    name: string
    description?: string
    icon?: string
  }>
}>()
</script>
