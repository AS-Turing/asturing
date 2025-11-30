<template>
  <div class="min-h-screen">
    <!-- Hero Section with animated background -->
    <section class="relative py-32 px-4 overflow-hidden bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] dark:from-[var(--color-primary)]/90 dark:to-[var(--color-secondary)]/90">
      <!-- Animated background shapes -->
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl animate-float-delayed"></div>
      </div>
      
      <div class="max-w-6xl mx-auto text-center relative z-10">
        <div class="inline-block mb-6 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white/90 text-sm font-semibold">
          💎 Excellence & Innovation
        </div>
        <h1 class="text-6xl md:text-7xl font-heading font-bold text-white mb-6 leading-tight">
          Nos Services<br/>
          <span class="bg-gradient-to-r from-white to-white/70 bg-clip-text text-transparent">Premium</span>
        </h1>
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed">
          Des solutions digitales sur-mesure conçues pour transformer votre vision en réalité et propulser votre croissance
        </p>
      </div>
    </section>

    <!-- Services Grid with enhanced cards -->
    <section class="py-24 px-4 bg-gray-50 dark:bg-gray-900 transition-colors">
      <div class="max-w-7xl mx-auto">
        <!-- Section header -->
        <div class="text-center mb-16">
          <h2 class="text-4xl font-heading font-bold text-gray-900 dark:text-white mb-4">
            Une expertise complète
          </h2>
          <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            Découvrez nos services pensés pour répondre à tous vos besoins digitaux
          </p>
        </div>

        <div v-if="pending" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="i in 6" :key="i" class="bg-white dark:bg-gray-800 rounded-2xl p-8 animate-pulse">
            <div class="h-16 w-16 bg-gray-200 dark:bg-gray-700 rounded-xl mb-6"></div>
            <div class="h-8 bg-gray-200 dark:bg-gray-700 rounded mb-4"></div>
            <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded mb-2"></div>
            <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-3/4 mb-6"></div>
            <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded-lg"></div>
          </div>
        </div>

        <div v-else-if="services && services.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <ServiceCard 
            v-for="service in services" 
            :key="service.id"
            :service="service"
          />
        </div>

        <div v-else class="text-center py-12">
          <p class="text-gray-600 dark:text-gray-400 text-lg">Aucun service disponible pour le moment.</p>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 bg-white dark:bg-gray-800 transition-colors">
      <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-4xl font-heading font-bold mb-6 text-gray-900 dark:text-white">
          Un projet en tête ?
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">
          Discutons de vos besoins et trouvons ensemble la solution adaptée
        </p>
        <NuxtLink 
          to="/contact" 
          class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-secondary)] text-white font-bold rounded-xl hover:shadow-xl hover:scale-105 transition-all duration-300"
        >
          Démarrer un projet
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </NuxtLink>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
const { data: services, pending } = await useFetch('/api/services')
</script>
