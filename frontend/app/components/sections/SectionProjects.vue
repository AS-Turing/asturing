<template>
  <section id="projets" class="py-20 bg-white dark:bg-dark transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <div class="inline-block mb-4">
          <span class="bg-coral/10 dark:bg-coral/20 text-coral px-4 py-2 rounded-full text-sm font-semibold">
            Portfolio
          </span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-dark dark:text-white mb-6">
          Projets réalisés avec excellence
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
          Découvrez quelques-unes de nos réalisations récentes
        </p>
      </div>

      <div class="grid md:grid-cols-2 gap-8">
        <div
          v-for="project in projects"
          :key="project.id"
          class="group rounded-3xl overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 gradient-hero"
          :class="project.bgGradient"
        >
          <!-- Image placeholder -->
          <div class="relative h-64 overflow-hidden">
            <div 
              class="absolute inset-0 flex items-center justify-center text-white text-lg font-semibold gradient-hero"
              :class="project.imageGradient"
            >
              {{ project.imageText }}
            </div>
            <div class="absolute top-4 right-4">
              <span :class="`w-3 h-3 rounded-full ${project.dotColor} animate-pulse block`"></span>
            </div>
          </div>

          <!-- Content -->
          <div class="p-8">
            <div :class="`text-sm font-semibold mb-2 ${project.categoryColor}`">
              {{ project.category }}
            </div>
            <h3 class="text-2xl font-bold mb-4 text-white">
              {{ project.title }}
            </h3>
            <p :class="`mb-6 leading-relaxed ${project.descColor}`">
              {{ project.description }}
            </p>

            <!-- Technologies -->
            <div class="flex flex-wrap gap-2 mb-6">
              <span
                v-for="tech in project.technologies"
                :key="tech"
                :class="`px-3 py-1 rounded-full text-xs font-semibold ${project.techClass}`"
              >
                {{ tech }}
              </span>
            </div>

            <NuxtLink
              :to="`/projets/${project.slug}`"
              :class="`inline-flex items-center gap-2 font-semibold group-hover:gap-3 transition-all ${project.linkColor}`"
            >
              Voir le projet
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
              </svg>
            </NuxtLink>
          </div>
        </div>
      </div>

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
