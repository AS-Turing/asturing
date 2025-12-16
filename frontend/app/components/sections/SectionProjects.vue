<template>
  <section v-if="projects && projects.length > 0" id="projets" class="py-20 gradient-soft transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <div class="inline-block mb-4">
          <span class="bg-coral/10 dark:bg-coral/20 text-coral px-4 py-2 rounded-full text-sm font-semibold">
            Réalisations
          </span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-dark dark:text-white mb-6">
          Projets réalisés avec excellence
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
          Découvrez quelques-unes de nos réalisations récentes
        </p>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        <ProjectCard
          v-for="project in projects.slice(0, 3)"
          :key="project.id"
          :project="project"
        />
      </div>

      <!-- CTA voir tous les projets -->
      <div class="text-center mt-12">
        <NuxtLink
          to="/projets"
          class="inline-flex items-center gap-2 px-8 py-4 gradient-hero from-primary to-secondary text-white rounded-full font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300"
        >
          Voir tous les projets
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
          </svg>
        </NuxtLink>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
const { data: projects } = await useFetch('/api/projects')
</script>
