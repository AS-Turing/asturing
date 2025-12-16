<template>
  <section v-if="clients && clients.length > 0" class="py-20 bg-white dark:bg-gray-900 overflow-hidden transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
      <div class="text-center">
        <div class="inline-block mb-4">
          <span class="bg-primary/10 dark:bg-primary/20 text-primary px-4 py-2 rounded-full text-sm font-semibold">
            Nos Clients
          </span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-dark dark:text-white mb-4">
          Ils nous ont fait confiance
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
          PME, artisans et startups de Nouvelle-Aquitaine
        </p>
      </div>
    </div>

    <div v-if="clients && clients.length > 0" class="relative">
      <!-- Gradient overlays pour smooth edges -->
      <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-white dark:from-gray-900 to-transparent z-10 pointer-events-none"></div>
      <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-white dark:from-gray-900 to-transparent z-10 pointer-events-none"></div>
      
      <!-- Logos slider -->
      <div class="flex gap-8 animate-scroll-slow">
        <!-- Premier set -->
        <div class="flex gap-8 shrink-0">
          <div 
            v-for="client in clients" 
            :key="client.id"
            class="group relative w-56 h-32 rounded-2xl logo-surface shadow-lg hover:shadow-2xl flex items-center justify-center transition-all duration-300 hover:scale-105 overflow-hidden"
          >
            <!-- Logo en background qui couvre toute la card -->
            <div v-if="client.logo" class="absolute inset-0 p-8 flex items-center justify-center z-10">
              <img :src="client.logo" :alt="client.name" class="w-full h-full object-contain opacity-90 group-hover:opacity-100 drop-shadow-lg transition-all duration-300 group-hover:scale-110">
            </div>
            
            <!-- Nom en fallback si pas de logo -->
            <div v-else class="text-center px-4 relative z-10">
              <span class="text-xl font-bold text-gray-700 dark:text-gray-300 group-hover:text-primary dark:group-hover:text-primary transition-colors duration-300">
                {{ client.name }}
              </span>
            </div>

            <!-- Hover overlay avec description -->
            <div v-if="client.description" class="absolute inset-0 bg-gradient-to-br from-primary/95 to-secondary/95 flex items-center justify-center p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
              <div class="text-center">
                <p class="text-white font-semibold text-lg mb-1">{{ client.name }}</p>
                <p class="text-white/90 text-sm">{{ client.description }}</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Duplicate pour loop infini -->
        <div class="flex gap-8 shrink-0" aria-hidden="true">
          <div 
            v-for="client in clients" 
            :key="'dup-' + client.id"
            class="group relative w-56 h-32 rounded-2xl logo-surface shadow-lg hover:shadow-2xl flex items-center justify-center transition-all duration-300 hover:scale-105 overflow-hidden"
          >
            <!-- Logo en background qui couvre toute la card -->
            <div v-if="client.logo" class="absolute inset-0 p-6 flex items-center justify-center z-10">
              <img :src="client.logo" :alt="client.name" class="w-full h-full object-contain transition-all duration-300 group-hover:scale-110 group-hover:opacity-100 opacity-85" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15));">
            </div>
            
            <!-- Nom en fallback si pas de logo -->
            <div v-else class="text-center px-4 relative z-10">
              <span class="text-xl font-bold text-gray-700 dark:text-gray-300 group-hover:text-primary dark:group-hover:text-primary transition-colors duration-300">
                {{ client.name }}
              </span>
            </div>

            <!-- Hover overlay avec description -->
            <div v-if="client.description" class="absolute inset-0 bg-gradient-to-br from-primary/95 to-secondary/95 flex items-center justify-center p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
              <div class="text-center">
                <p class="text-white font-semibold text-lg mb-1">{{ client.name }}</p>
                <p class="text-white/90 text-sm">{{ client.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA -->
    <div class="text-center mt-16">
      <p class="text-gray-600 dark:text-gray-400 mb-6 text-lg">
        Envie de rejoindre nos clients satisfaits ?
      </p>
      <NuxtLink
        to="/contact"
        class="inline-flex items-center gap-2 px-8 py-4 gradient-hero text-white rounded-full font-semibold hover:shadow-2xl transition-all duration-300 hover:scale-105"
      >
        Démarrer un projet
        <Icon name="mdi:arrow-right" class="w-5 h-5" />
      </NuxtLink>
    </div>
  </section>
</template>

<script setup lang="ts">
const { data: clients } = await useFetch('/api/clients')
</script>

<style scoped>
@keyframes scroll-slow {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(calc(-100% - 2rem));
  }
}

.animate-scroll-slow {
  animation: scroll-slow 40s linear infinite;
}

.animate-scroll-slow:hover {
  animation-play-state: paused;
}
</style>
