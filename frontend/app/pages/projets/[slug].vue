<template>
  <div v-if="project" class="min-h-screen bg-white dark:bg-dark transition-colors duration-300">
    <!-- Hero Section -->
    <section class="relative py-20 overflow-hidden gradient-hero" :class="project.bgGradient">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" :class="`gradient-hero ${project.imageGradient}`"></div>
      </div>
      
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8 flex items-center gap-2 text-sm">
          <NuxtLink to="/" class="text-white/60 hover:text-white transition-colors">
            Accueil
          </NuxtLink>
          <span class="text-white/40">/</span>
          <NuxtLink to="/projets" class="text-white/60 hover:text-white transition-colors">
            Projets
          </NuxtLink>
          <span class="text-white/40">/</span>
          <span class="text-white">{{ project.title }}</span>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <!-- Left: Info -->
          <div>
            <div class="inline-block mb-4">
              <span :class="`px-4 py-2 rounded-full text-sm font-semibold ${project.techClass}`">
                {{ project.category }}
              </span>
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
              {{ project.title }}
            </h1>
            
            <p class="text-xl text-white/90 mb-8 leading-relaxed">
              {{ project.excerpt || project.description }}
            </p>

            <!-- Meta Info Grid -->
            <div class="grid grid-cols-2 gap-4 mb-8">
              <div v-if="project.client" class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                <div class="text-white/60 text-sm mb-1">Client</div>
                <div class="text-white font-semibold">{{ project.client }}</div>
              </div>
              <div v-if="project.year" class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                <div class="text-white/60 text-sm mb-1">Année</div>
                <div class="text-white font-semibold">{{ project.year }}</div>
              </div>
              <div v-if="project.duration" class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                <div class="text-white/60 text-sm mb-1">Durée</div>
                <div class="text-white font-semibold">{{ project.duration }}</div>
              </div>
              <div v-if="project.sector" class="bg-white/10 backdrop-blur-sm rounded-xl p-4">
                <div class="text-white/60 text-sm mb-1">Secteur</div>
                <div class="text-white font-semibold">{{ project.sector }}</div>
              </div>
            </div>

            <!-- CTA -->
            <div class="flex flex-wrap gap-4">
              <a
                v-if="project.url"
                :href="project.url"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center gap-2 px-6 py-3 bg-white text-dark rounded-full font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300"
              >
                Voir le site
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
              </a>
              <div v-if="project.status" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 text-white rounded-full font-semibold backdrop-blur-sm">
                <span :class="`w-2 h-2 rounded-full ${project.dotColor} animate-pulse`"></span>
                {{ project.status }}
              </div>
            </div>
          </div>

          <!-- Right: Image -->
          <div class="relative">
            <div class="relative h-96 rounded-3xl overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-500">
              <div 
                class="absolute inset-0 flex items-center justify-center text-white text-lg font-semibold gradient-hero"
                :class="project.imageGradient"
              >
                {{ project.imageText }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contenu du projet (Challenge, Solution, Results) -->
    <ProjectContent 
      v-if="project.content"
      :content="project.content"
      :projectTitle="project.title"
      :imageText="project.imageText"
      :imageGradient="project.imageGradient"
      :technologies="project.technologies"
      :techIcons="project.techIcons || []"
      :imageUrl="project.imageUrl"
      :challengeImage="project.challengeImage"
      :solutionImage="project.solutionImage"
      :resultsImage="project.resultsImage"
    />

    <!-- Features Grid - Pleine largeur avec cards -->
    <section v-if="project.features && project.features.length > 0" class="py-20 bg-white dark:bg-dark">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-dark dark:text-white mb-4">Fonctionnalités Clés</h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">Ce qui rend ce projet unique</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="(feature, index) in project.features"
            :key="index"
            class="group relative bg-gradient-to-br from-gray-50 to-white dark:from-dark-lighter dark:to-dark-lighter border border-gray-200 dark:border-gray-800 rounded-2xl p-6 hover:shadow-xl hover:scale-105 transition-all duration-300"
          >
            <div class="flex items-start gap-4">
              <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </div>
              <span class="text-dark dark:text-white font-medium flex-1">{{ feature }}</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonial - Pleine largeur encadré -->
    <section v-if="project.testimonial" class="py-20 bg-white dark:bg-dark">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative">
          <div class="absolute -top-6 -left-6 w-24 h-24 bg-primary/10 rounded-full blur-2xl"></div>
          <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-secondary/10 rounded-full blur-2xl"></div>
          
          <div class="relative bg-gradient-to-br from-primary/10 to-secondary/10 dark:from-primary/20 dark:to-secondary/20 rounded-3xl p-8 md:p-12 border border-primary/20">
            <svg class="w-16 h-16 text-primary mb-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
            </svg>
            <p class="text-2xl md:text-3xl text-dark dark:text-white mb-8 leading-relaxed italic font-light">
              {{ project.testimonial.quote }}
            </p>
            <div class="flex items-center gap-4">
              <div class="w-16 h-16 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white text-xl font-bold">
                {{ project.testimonial.author.charAt(0) }}
              </div>
              <div>
                <div class="font-semibold text-lg text-dark dark:text-white">{{ project.testimonial.author }}</div>
                <div class="text-gray-600 dark:text-gray-400">{{ project.testimonial.role }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Other Projects -->
    <section class="py-20 bg-gray-50 dark:bg-dark-lighter">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-dark dark:text-white mb-4">Découvrez nos autres réalisations</h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">Chaque projet est unique</p>
        </div>
        <div class="flex justify-center">
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

    <!-- CTA Final -->
    <section class="py-20 gradient-hero from-primary to-secondary">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
          Un projet similaire en tête ?
        </h2>
        <p class="text-xl text-white/90 mb-8">
          Discutons de vos besoins et construisons ensemble votre solution sur-mesure
        </p>
        <NuxtLink
          to="/contact"
          class="inline-flex items-center gap-2 px-8 py-4 bg-white text-primary rounded-full font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300"
        >
          Demander un devis gratuit
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
          </svg>
        </NuxtLink>
      </div>
    </section>
  </div>

  <!-- Loading state -->
  <div v-else class="min-h-screen flex items-center justify-center bg-white dark:bg-dark">
    <div class="text-center">
      <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-primary mx-auto mb-4"></div>
      <p class="text-gray-600 dark:text-gray-400">Chargement du projet...</p>
    </div>
  </div>
</template>

<script setup lang="ts">
const route = useRoute()
const slug = route.params.slug as string

const { data: project, error } = await useFetch(`/api/projects/${slug}`)

// SEO Premium AAA avec Schema
watch(project, (newProject) => {
  if (newProject) {
    usePremiumSeo({
      title: `${newProject.title} - Réalisation AS-Turing`,
      description: newProject.excerpt || newProject.description,
      url: `https://www.as-turing.fr/projets/${newProject.slug}`,
      image: newProject.imageUrl || 'https://www.as-turing.fr/images/og-projects.jpg',
      type: 'article',
      breadcrumbs: [
        { name: 'Accueil', url: '/' },
        { name: 'Projets', url: '/projets' },
        { name: newProject.title, url: `/projets/${newProject.slug}` }
      ]
    })
  }
}, { immediate: true })

// Handle 404
if (error.value) {
  throw createError({
    statusCode: 404,
    statusMessage: 'Projet non trouvé',
    fatal: true
  })
}
</script>

<style scoped>
/* Styles prose sans @apply - utilisation de classes Tailwind directement dans le template */
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

.prose :deep(a) {
  color: var(--color-primary);
  transition: color 0.2s;
}

.prose :deep(a:hover) {
  color: var(--color-primary-dark);
}

.dark .prose :deep(a) {
  color: var(--color-primary-light);
}

.dark .prose :deep(a:hover) {
  color: var(--color-primary);
}

.prose :deep(table) {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 1.5rem;
}

.prose :deep(th) {
  background-color: #f3f4f6;
  padding: 0.75rem 1rem;
  text-align: left;
  font-weight: 600;
  border-bottom: 2px solid #d1d5db;
}

.dark .prose :deep(th) {
  background-color: #1f2937;
  border-bottom-color: #374151;
}

.prose :deep(td) {
  padding: 0.75rem 1rem;
  border-bottom: 1px solid #e5e7eb;
}

.dark .prose :deep(td) {
  border-bottom-color: #1f2937;
}
</style>
