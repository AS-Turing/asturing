<template>
  <NuxtLink
    :to="`/projets/${project.slug}`"
    class="group relative bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-[var(--color-primary)]/50 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2"
  >
    <!-- Image -->
    <div class="relative h-48 overflow-hidden rounded-t-2xl logo-surface">
      <!-- Image si disponible -->
      <div v-if="project.imageUrl" class="absolute inset-0 flex items-center justify-center p-4 z-10">
        <img
          :src="project.imageUrl"
          :alt="project.imageText || project.title"
          class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-105 opacity-85 group-hover:opacity-100"
          style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15));"
        />
      </div>
      
      <!-- Fallback si pas d'image -->
      <div v-else class="absolute inset-0 flex items-center justify-center z-10">
        <!-- Pattern subtil -->
        <div class="absolute inset-0 opacity-5 z-0">
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
        <div class="relative z-10 w-16 h-16 rounded-2xl bg-gradient-to-br from-[var(--color-primary)]/20 to-[var(--color-secondary)]/20 flex items-center justify-center">
          <svg class="w-8 h-8 text-[var(--color-primary)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
          </svg>
        </div>
      </div>
      
      <!-- Badge catégorie -->
      <div class="absolute top-4 left-4 z-20">
        <span :class="`px-3 py-1 rounded-full text-xs font-semibold ${project.techClass}`">
          {{ project.category }}
        </span>
      </div>
    </div>

    <!-- Contenu -->
    <div class="p-6">
      <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-[var(--color-primary)] transition-colors">
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
          class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-xs text-gray-600 dark:text-gray-400"
        >
          {{ tech }}
        </span>
        <span
          v-if="project.technologies?.length > 3"
          class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-xs text-gray-600 dark:text-gray-400"
        >
          +{{ project.technologies.length - 3 }}
        </span>
      </div>

      <!-- CTA -->
      <div class="flex items-center gap-2 text-[var(--color-primary)] font-semibold group-hover:gap-3 transition-all">
        <span>Voir le projet</span>
        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
        </svg>
      </div>
    </div>
  </NuxtLink>
</template>

<script setup lang="ts">
interface Project {
  id: number
  slug: string
  title: string
  description: string
  category: string
  techClass: string
  imageUrl?: string
  imageText?: string
  technologies?: string[]
}

defineProps<{
  project: Project
}>()
</script>
