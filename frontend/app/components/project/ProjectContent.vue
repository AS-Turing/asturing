<template>
  <div v-if="content && content.sections" class="space-y-0">
    <section 
      v-for="(section, sectionIndex) in content.sections" 
      :key="sectionIndex"
      class="py-20"
      :class="{
        'bg-white dark:bg-gray-950': section.bgColor === 'white',
        'bg-gray-50 dark:bg-gray-900': section.bgColor === 'gray',
        'bg-gradient-to-br from-primary/5 to-secondary/5 dark:from-primary/10 dark:to-secondary/10': section.bgColor === 'gradient'
      }"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Titre de section -->
        <div v-if="section.title" class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-dark dark:text-white mb-4">
            {{ section.title }}
          </h2>
        </div>

        <!-- Blocs de la section -->
        <div v-if="section.blocks && section.blocks.length > 0" class="space-y-16">
          <div 
            v-for="(block, blockIndex) in section.blocks" 
            :key="blockIndex"
          >
            <!-- Bloc text_image -->
            <div v-if="block.type === 'text_image'" class="grid lg:grid-cols-2 gap-8 items-center">
              <!-- Image/Icônes à gauche -->
              <div v-if="block.layout === 'image_left'" class="order-1">
                <!-- Si c'est la section "solution" et le premier bloc, afficher les icônes tech -->
                <div v-if="section.type === 'solution' && blockIndex === 0 && techIcons && techIcons.length > 0" class="py-8">
                  <!-- Grid d'icônes sans card -->
                  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8">
                    <div 
                      v-for="(icon, iconIndex) in techIcons" 
                      :key="`tech-${icon}-${iconIndex}`"
                      class="group relative flex flex-col items-center gap-3"
                    >
                      <!-- Glow effect au hover -->
                      <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-primary)]/10 to-[var(--color-secondary)]/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 blur-xl"></div>
                      
                      <!-- Icône container -->
                      <div class="relative w-20 h-20 flex items-center justify-center transition-all duration-500 group-hover:scale-110">
                        <SkillIcon 
                          :slug="icon" 
                          class="!w-full !h-full drop-shadow-lg"
                        />
                      </div>
                      
                      <!-- Label avec style épuré -->
                      <span class="text-xs text-center text-gray-500 dark:text-gray-400 font-medium tracking-wide uppercase opacity-70 group-hover:opacity-100 group-hover:text-[var(--color-primary)] transition-all duration-300">
                        {{ getTechLabel(icon) }}
                      </span>
                    </div>
                  </div>
                </div>
                <!-- Sinon afficher l'image avec scroll reveal -->
                <ScrollRevealImage
                  v-else
                  :imageSrc="normalizeImagePath(block.image) || getDefaultImage(section.type, blockIndex)"
                  :altText="projectTitle"
                  :fallbackText="imageText"
                  :fallbackGradient="imageGradient"
                />
              </div>

              <!-- Contenu texte -->
              <div 
                :class="block.layout === 'image_left' ? 'order-2' : 'order-1'"
                class="prose prose-lg max-w-none text-dark dark:text-white" 
                v-html="block.content"
              ></div>

              <!-- Image à droite -->
              <div v-if="block.layout === 'image_right'" class="order-2">
                <ScrollRevealImage
                  :imageSrc="normalizeImagePath(block.image) || getDefaultImage(section.type, blockIndex)"
                  :altText="projectTitle"
                  :fallbackText="imageText"
                  :fallbackGradient="imageGradient || 'from-primary to-secondary'"
                />
              </div>
            </div>

            <!-- Bloc text seul -->
            <div v-else-if="block.type === 'text'" class="prose prose-lg max-w-none text-dark dark:text-white mx-auto" v-html="block.content"></div>

            <!-- Bloc image seule -->
            <div v-else-if="block.type === 'image'" class="max-w-5xl mx-auto">
              <div class="relative h-96 rounded-3xl overflow-hidden shadow-xl">
                <img 
                  v-if="block.image"
                  :src="normalizeImagePath(block.image)"
                  :alt="projectTitle"
                  class="absolute inset-0 w-full h-full object-cover"
                />
              </div>
            </div>
          </div>
        </div>
        
        <!-- Debug: si pas de blocs -->
        <div v-else class="text-center text-gray-500">
          <p>Aucun bloc dans cette section ({{ section.blocks?.length || 0 }} blocs)</p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
interface Props {
  content: any
  projectTitle: string
  imageText?: string
  imageGradient?: string
  technologies?: string[]
  techIcons?: string[]
  imageUrl?: string
  challengeImage?: string
  solutionImage?: string
  resultsImage?: string
}

const props = defineProps<Props>()

// Helper pour normaliser les chemins d'images (ajouter / au début)
const normalizeImagePath = (imagePath: string | null | undefined): string | null => {
  if (!imagePath) return null
  if (imagePath.startsWith('/')) return imagePath
  return `/${imagePath}`
}

// Helper pour obtenir l'image par défaut selon la section et le bloc
const getDefaultImage = (sectionType: string, blockIndex: number): string | null => {
  let imagePath = null
  
  // Section challenge, bloc 0
  if (sectionType === 'challenge' && blockIndex === 0) {
    imagePath = props.challengeImage
  }
  // Section solution, blocs 1+ (le 0 = icônes tech)
  else if (sectionType === 'solution' && blockIndex > 0) {
    imagePath = props.solutionImage
  }
  // Section results, bloc 0
  else if (sectionType === 'results' && blockIndex === 0) {
    imagePath = props.resultsImage || props.imageUrl
  }
  
  return normalizeImagePath(imagePath)
}

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
  'sanity': 'simple-icons:sanity',
  'gutenberg': 'simple-icons:gutenberg',
  
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

// Helper pour obtenir le label d'une techno depuis son slug
const getTechLabel = (slug: string): string => {
  // Capitaliser la première lettre
  return slug.charAt(0).toUpperCase() + slug.slice(1)
}
</script>

<style scoped>
.prose :deep(h2) {
  font-size: 1.875rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  margin-top: 3rem;
}

.prose :deep(h2:first-child) {
  margin-top: 0;
}

.prose :deep(h3) {
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  margin-top: 2rem;
}

.prose :deep(h4) {
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 0.75rem;
  margin-top: 1.5rem;
}

.prose :deep(p) {
  margin-bottom: 1rem;
  line-height: 1.75;
}

.prose :deep(ul) {
  list-style: none;
  margin-bottom: 1.5rem;
}

.prose :deep(li) {
  padding-left: 0;
  margin-bottom: 0.5rem;
}

.prose :deep(strong) {
  font-weight: 600;
  color: var(--color-primary);
}

.dark .prose :deep(strong) {
  color: var(--color-primary-light);
}
</style>
