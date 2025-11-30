<template>
  <section class="py-16 bg-gray-50 dark:bg-gray-900 overflow-hidden transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
      <div class="text-center">
        <h2 class="text-3xl font-bold text-dark dark:text-white mb-2">
          Ils nous ont fait confiance
        </h2>
        <p class="text-gray-600 dark:text-gray-400">
          PME, artisans et startups de Nouvelle-Aquitaine
        </p>
      </div>
    </div>

    <div class="relative">
      <!-- Gradient overlays pour smooth edges -->
      <div class="absolute left-0 top-0 bottom-0 w-32 gradient-hero from-gray-50 dark:from-gray-900 to-transparent z-10 pointer-events-none"></div>
      <div class="absolute right-0 top-0 bottom-0 w-32 gradient-hero from-gray-50 dark:from-gray-900 to-transparent z-10 pointer-events-none"></div>
      
      <!-- Logos slider -->
      <div class="flex gap-12 animate-scroll">
        <div class="flex gap-12 shrink-0">
          <div 
            v-for="client in clients" 
            :key="client.name"
            class="w-48 h-24 bg-white dark:bg-gray-800 rounded-2xl shadow-md flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 hover:scale-105 group"
          >
            <span class="text-2xl font-bold text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors">
              {{ client.name }}
            </span>
          </div>
        </div>
        <!-- Duplicate pour loop infini -->
        <div class="flex gap-12 shrink-0" aria-hidden="true">
          <div 
            v-for="client in clients" 
            :key="'dup-' + client.name"
            class="w-48 h-24 bg-white dark:bg-gray-800 rounded-2xl shadow-md flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 hover:scale-105 group"
          >
            <span class="text-2xl font-bold text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors">
              {{ client.name }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
const clients = [
  { name: 'Client 1' },
  { name: 'Client 2' },
  { name: 'Client 3' },
  { name: 'Client 4' },
  { name: 'Client 5' },
]
</script>
