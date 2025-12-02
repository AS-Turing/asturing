<template>
  <section v-if="projects && projects.length > 0" id="projets" class="py-20 bg-white dark:bg-dark transition-colors duration-300">
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
        <NuxtLink
          v-for="project in projects.slice(0, 3)"
          :key="project.id"
          :to="`/projets/${project.slug}`"
          class="group relative bg-white dark:bg-dark rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 hover:border-primary/50 dark:hover:border-primary/50 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2"
        >
          <!-- Image placeholder -->
          <div class="relative h-48 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-50 dark:from-dark-lighter dark:to-dark">
            <div class="absolute inset-0 flex items-center justify-center">
              <!-- Pattern subtil -->
              <div class="absolute inset-0 opacity-5">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                  <defs>
                    <pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse">
                      <path d="M 20 0 L 0 0 0 20" fill="none" stroke="currentColor" stroke-width="0.5"/>
                    </pattern>
                  </defs>
                  <rect width="100%" height="100%" fill="url(#grid)" />
                </svg>
              </div>
              
              <!-- Icône centrale -->
              <div class="relative z-10 w-16 h-16 rounded-2xl bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                </svg>
              </div>
            </div>
            
            <!-- Badge catégorie -->
            <div class="absolute top-4 left-4">
              <span :class="`px-3 py-1 rounded-full text-xs font-semibold ${project.techClass}`">
                {{ project.category }}
              </span>
            </div>
            
            <!-- Badge statut -->
            <div class="absolute top-4 right-4">
              <span :class="`w-3 h-3 rounded-full ${project.dotColor} animate-pulse block`"></span>
            </div>
          </div>

          <!-- Contenu -->
          <div class="p-6">
            <h3 class="text-xl font-bold text-dark dark:text-white mb-2 group-hover:text-primary transition-colors">
              {{ project.title }}
            </h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
              {{ project.description }}
            </p>
            
            <!-- Technologies -->
            <div class="flex flex-wrap gap-2 mb-4">
              <span
                v-for="tech in project.technologies?.slice(0, 3)"
                :key="tech"
                class="px-2 py-1 bg-gray-100 dark:bg-dark-lighter rounded text-xs text-gray-600 dark:text-gray-400"
              >
                {{ tech }}
              </span>
              <span
                v-if="project.technologies?.length > 3"
                class="px-2 py-1 bg-gray-100 dark:bg-dark-lighter rounded text-xs text-gray-600 dark:text-gray-400"
              >
                +{{ project.technologies.length - 3 }}
              </span>
            </div>

            <!-- CTA -->
            <div class="flex items-center gap-2 text-primary font-semibold group-hover:gap-3 transition-all">
              <span>Voir le projet</span>
              <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
              </svg>
            </div>
          </div>
        </NuxtLink>
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
