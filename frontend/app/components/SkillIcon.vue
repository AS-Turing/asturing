<template>
  <img 
    :src="iconUrl" 
    :alt="getTechLabel(slug)"
    :class="props.class"
    class="tech-icon"
    @error="onError"
  />
</template>

<script setup lang="ts">
const props = defineProps<{
  slug: string
  class?: string
}>()

// Mapping des slugs tech vers les noms d'icônes skillicons.dev
const skillIconsMap: Record<string, string> = {
  // Frontend
  'vue': 'vue',
  'nuxt': 'nuxtjs',
  'react': 'react',
  'next': 'nextjs',
  'angular': 'angular',
  'svelte': 'svelte',
  
  // Backend
  'symfony': 'symfony',
  'laravel': 'laravel',
  'django': 'django',
  'flask': 'flask',
  'express': 'expressjs',
  'nestjs': 'nestjs',
  'fastapi': 'fastapi',
  
  // Languages
  'php': 'php',
  'javascript': 'js',
  'typescript': 'ts',
  'python': 'py',
  'java': 'java',
  'go': 'go',
  'golang': 'go',
  'rust': 'rust',
  'c#': 'cs',
  
  // Databases
  'mysql': 'mysql',
  'postgresql': 'postgres',
  'mongodb': 'mongodb',
  'redis': 'redis',
  'sqlite': 'sqlite',
  
  // DevOps & Tools
  'docker': 'docker',
  'kubernetes': 'kubernetes',
  'git': 'git',
  'github': 'github',
  'gitlab': 'gitlab',
  'nginx': 'nginx',
  'apache': 'apache',
  
  // Cloud
  'aws': 'aws',
  'gcp': 'gcp',
  'azure': 'azure',
  'vercel': 'vercel',
  'netlify': 'netlify',
  
  // CSS & UI
  'tailwind': 'tailwind',
  'bootstrap': 'bootstrap',
  'sass': 'sass',
  
  // Build Tools
  'vite': 'vite',
  'webpack': 'webpack',
  'rollup': 'rollup',
  
  // Testing
  'jest': 'jest',
  'vitest': 'vitest',
  'cypress': 'cypress',
  
  // API & Data
  'graphql': 'graphql',
  'postman': 'postman',
  
  // CMS
  'wordpress': 'wordpress',
  'strapi': 'strapi',
  
  // Backend Services
  'supabase': 'supabase',
  
  // Frontend Libs
  'threejs': 'threejs',
  'pinia': 'pinia',
  
  // Autres
  'node': 'nodejs',
  'npm': 'npm',
  'yarn': 'yarn',
  'pnpm': 'pnpm',
}

const iconUrl = computed(() => {
  const iconName = skillIconsMap[props.slug.toLowerCase()] || props.slug.toLowerCase()
  return `https://skillicons.dev/icons?i=${iconName}&theme=dark`
})

const getTechLabel = (slug: string): string => {
  return slug.charAt(0).toUpperCase() + slug.slice(1)
}

const onError = (e: Event) => {
  console.warn(`Failed to load skill icon for: ${props.slug}`)
  // On pourrait ajouter un fallback ici
}
</script>

<style scoped>
.tech-icon {
  width: 100%;
  height: 100%;
  object-fit: contain;
}
</style>
