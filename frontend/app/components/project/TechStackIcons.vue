<template>
  <div class="flex flex-wrap gap-3 justify-center">
    <div 
      v-for="(icon, index) in techIcons" 
      :key="index"
      class="group relative"
      :title="technologies[index]"
    >
      <div class="w-12 h-12 flex items-center justify-center transition-transform duration-300 hover:scale-110">
        <Icon :name="getIconName(icon)" class="w-full h-full" />
      </div>
      <!-- Tooltip au hover -->
      <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-1 bg-dark dark:bg-white text-white dark:text-dark text-xs font-semibold rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
        {{ technologies[index] }}
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{
  technologies: string[]
  techIcons: string[]
}>()

// Mapping des slugs vers les icônes skill-icons
const iconMap: Record<string, string> = {
  // Frontend Frameworks
  'vue': 'skill-icons:vuejs-dark',
  'nuxt': 'skill-icons:nuxtjs-dark',
  'react': 'skill-icons:react-dark',
  'next': 'skill-icons:nextjs-dark',
  'angular': 'skill-icons:angular-dark',
  'svelte': 'skill-icons:svelte',
  
  // Backend Frameworks
  'symfony': 'skill-icons:symfony-dark',
  'laravel': 'skill-icons:laravel-dark',
  'django': 'skill-icons:django',
  'flask': 'skill-icons:flask-dark',
  'express': 'skill-icons:expressjs-dark',
  'nestjs': 'skill-icons:nestjs-dark',
  'fastapi': 'skill-icons:fastapi',
  
  // Languages
  'php': 'skill-icons:php-dark',
  'javascript': 'skill-icons:javascript',
  'typescript': 'skill-icons:typescript',
  'python': 'skill-icons:python-dark',
  'java': 'skill-icons:java-dark',
  'go': 'skill-icons:golang',
  'rust': 'skill-icons:rust',
  'c#': 'skill-icons:cs',
  
  // Databases
  'mysql': 'skill-icons:mysql-dark',
  'postgresql': 'skill-icons:postgresql-dark',
  'mongodb': 'skill-icons:mongodb',
  'redis': 'skill-icons:redis-dark',
  'sqlite': 'skill-icons:sqlite',
  
  // DevOps & Tools
  'docker': 'skill-icons:docker',
  'kubernetes': 'skill-icons:kubernetes',
  'git': 'skill-icons:git',
  'github': 'skill-icons:github-dark',
  'gitlab': 'skill-icons:gitlab-dark',
  'nginx': 'skill-icons:nginx',
  'apache': 'skill-icons:apache',
  
  // Cloud
  'aws': 'skill-icons:aws-dark',
  'gcp': 'skill-icons:gcp-dark',
  'azure': 'skill-icons:azure-dark',
  'vercel': 'skill-icons:vercel-dark',
  'netlify': 'skill-icons:netlify-dark',
  
  // CSS & UI
  'tailwind': 'skill-icons:tailwindcss-dark',
  'bootstrap': 'skill-icons:bootstrap',
  'sass': 'skill-icons:sass',
  
  // Build Tools
  'vite': 'skill-icons:vite-dark',
  'webpack': 'skill-icons:webpack-dark',
  'rollup': 'skill-icons:rollupjs-dark',
  
  // Testing
  'jest': 'skill-icons:jest',
  'vitest': 'skill-icons:vitest-dark',
  'cypress': 'skill-icons:cypress-dark',
  
  // API & Data
  'graphql': 'skill-icons:graphql-dark',
  'rest': 'logos:rest',
  'api platform': 'logos:api-platform',
  'postman': 'skill-icons:postman',
  
  // CMS
  'wordpress': 'skill-icons:wordpress',
  'strapi': 'skill-icons:strapi-dark',
  'sanity': 'skill-icons:sanity',
  
  // Backend Services
  'supabase': 'skill-icons:supabase-dark',
  
  // Frontend Libs
  'threejs': 'skill-icons:threejs-dark',
  'pinia': 'skill-icons:pinia',
  'pwa': 'skill-icons:pwa',
  
  // Autres
  'node': 'skill-icons:nodejs-dark',
  'npm': 'skill-icons:npm-dark',
  'yarn': 'skill-icons:yarn-dark',
  'pnpm': 'skill-icons:pnpm-dark',
}

const getIconName = (slug: string): string => {
  return iconMap[slug] || 'mdi:code-tags'
}
</script>

<style scoped>
/* Animation subtile au hover */
.group:hover .w-12 {
  filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.15));
}
</style>
