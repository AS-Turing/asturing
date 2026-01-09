<template>
  <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-700">
    <div class="flex items-start gap-4">
      <!-- Avatar/Logo -->
      <div class="flex-shrink-0">
        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white font-bold text-xl">
          AT
        </div>
      </div>
      
      <!-- Info -->
      <div class="flex-1">
        <div class="flex items-center gap-2 mb-2">
          <h3 class="text-lg font-bold text-gray-900 dark:text-white">
            {{ authorName }}
          </h3>
          <Icon name="mdi:check-decagram" class="w-5 h-5 text-primary" title="Auteur vérifié" />
        </div>
        
        <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">
          {{ bio }}
        </p>
        
        <!-- Stats/Badges -->
        <div class="flex flex-wrap gap-2">
          <span class="inline-flex items-center gap-1 px-3 py-1 bg-white dark:bg-gray-800 rounded-full text-xs font-medium text-gray-700 dark:text-gray-300">
            <Icon name="mdi:web" class="w-4 h-4" />
            Agence Web
          </span>
          <span class="inline-flex items-center gap-1 px-3 py-1 bg-white dark:bg-gray-800 rounded-full text-xs font-medium text-gray-700 dark:text-gray-300">
            <Icon name="mdi:map-marker" class="w-4 h-4" />
            Libourne
          </span>
          <span class="inline-flex items-center gap-1 px-3 py-1 bg-white dark:bg-gray-800 rounded-full text-xs font-medium text-gray-700 dark:text-gray-300">
            <Icon name="mdi:certificate" class="w-4 h-4" />
            Expert certifié
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
interface Props {
  authorName?: string
  bio?: string
}

withDefaults(defineProps<Props>(), {
  authorName: 'AS-Turing',
  bio: 'Agence digitale spécialisée en création de sites web et e-commerce. Expert Nuxt, Vue.js et Symfony depuis 2015.'
})
</script>
