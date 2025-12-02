<template>
  <div class="min-h-screen bg-white dark:bg-dark transition-colors duration-300">
    <!-- Hero Section -->
    <section class="relative py-20 overflow-hidden gradient-hero from-primary to-secondary">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-gradient-to-br from-white to-transparent"></div>
      </div>
      
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-block mb-4">
          <span class="bg-white/20 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm">
            Réalisations
          </span>
        </div>
        
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
          Nos Projets
        </h1>
        
        <p class="text-xl text-white/90 max-w-3xl mx-auto mb-8">
          Découvrez nos réalisations récentes : sites vitrines, applications métier et solutions sur-mesure pour nos clients
        </p>
      </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Loading state -->
        <div v-if="pending" class="text-center py-20">
          <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-primary mx-auto mb-4"></div>
          <p class="text-gray-600 dark:text-gray-400">Chargement des projets...</p>
        </div>

        <!-- Projects list -->
        <div v-else-if="projects && projects.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <NuxtLink
            v-for="project in projects"
            :key="project.id"
            :to="`/projets/${project.slug}`"
            class="group block"
          >
            <article class="h-full rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 gradient-hero" :class="project.bgGradient">
              <!-- Image -->
              <div class="relative h-64 overflow-hidden">
                <div 
                  class="absolute inset-0 flex items-center justify-center text-white text-lg font-semibold gradient-hero transition-transform duration-500 group-hover:scale-110"
                  :class="project.imageGradient"
                >
                  {{ project.imageText }}
                </div>
                <div class="absolute top-4 right-4">
                  <span :class="`w-3 h-3 rounded-full ${project.dotColor} animate-pulse block`"></span>
                </div>
              </div>

              <!-- Content -->
              <div class="p-6">
                <div :class="`text-sm font-semibold mb-2 ${project.categoryColor}`">
                  {{ project.category }}
                </div>
                
                <h2 class="text-2xl font-bold mb-3 text-white group-hover:text-white/90 transition-colors">
                  {{ project.title }}
                </h2>
                
                <p :class="`mb-4 leading-relaxed line-clamp-3 ${project.descColor}`">
                  {{ project.description }}
                </p>

                <!-- Technologies (max 3) -->
                <div class="flex flex-wrap gap-2 mb-4">
                  <span
                    v-for="tech in project.technologies.slice(0, 3)"
                    :key="tech"
                    :class="`px-3 py-1 rounded-full text-xs font-semibold ${project.techClass}`"
                  >
                    {{ tech }}
                  </span>
                  <span 
                    v-if="project.technologies.length > 3"
                    :class="`px-3 py-1 rounded-full text-xs font-semibold ${project.techClass}`"
                  >
                    +{{ project.technologies.length - 3 }}
                  </span>
                </div>

                <div :class="`inline-flex items-center gap-2 font-semibold group-hover:gap-3 transition-all ${project.linkColor}`">
                  Voir le projet
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                  </svg>
                </div>
              </div>
            </article>
          </NuxtLink>
        </div>

        <!-- Empty state -->
        <div v-else class="text-center py-20">
          <div class="text-6xl mb-4">📁</div>
          <h2 class="text-2xl font-bold text-dark dark:text-white mb-2">Aucun projet pour le moment</h2>
          <p class="text-gray-600 dark:text-gray-400">Nos réalisations seront bientôt disponibles</p>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-50 dark:bg-dark-lighter">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-dark dark:text-white mb-6">
          Prêt à lancer votre projet ?
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">
          Discutons de vos besoins et créons ensemble la solution parfaite pour votre entreprise
        </p>
        <NuxtLink
          to="/contact"
          class="inline-flex items-center gap-2 px-8 py-4 gradient-hero from-primary to-secondary text-white rounded-full font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300"
        >
          Demander un devis gratuit
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
          </svg>
        </NuxtLink>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
const { data: projects, pending } = await useFetch('/api/projects')

// SEO
useHead({
  title: 'Nos Projets - Réalisations AS Turing',
  meta: [
    { name: 'description', content: 'Découvrez nos réalisations : sites vitrines premium, applications métier et solutions web sur-mesure pour TPE, PME et associations.' },
    { property: 'og:title', content: 'Nos Projets - Réalisations AS Turing' },
    { property: 'og:description', content: 'Découvrez nos réalisations web et applications métier.' },
  ]
})
</script>

<style scoped>
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
