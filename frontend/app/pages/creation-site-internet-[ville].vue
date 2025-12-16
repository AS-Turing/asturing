<template>
  <div v-if="location" class="min-h-screen bg-white dark:bg-dark transition-colors duration-300">
    <!-- Hero Section -->
    <section class="relative py-20 overflow-hidden gradient-hero from-primary to-secondary">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-gradient-to-br from-white to-transparent"></div>
      </div>
      
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
          <div class="inline-block mb-4">
            <span class="bg-white/20 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm flex items-center gap-2">
              <Icon name="mdi:map-marker" class="w-4 h-4" />
              {{ location.ville }} - {{ location.departement }}
            </span>
          </div>
          
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
            {{ location.hero.title }}
          </h1>
          
          <p class="text-2xl text-white/90 mb-4 font-semibold">
            {{ location.hero.subtitle }}
          </p>
          
          <p class="text-xl text-white/80 mb-8 leading-relaxed">
            {{ location.hero.description }}
          </p>

          <!-- Stats -->
          <div class="grid grid-cols-3 gap-6 max-w-2xl mx-auto pt-8 border-t border-white/20">
            <div v-for="stat in location.hero.stats" :key="stat.label" class="text-center">
              <div class="text-3xl md:text-4xl font-bold mb-1 text-white">{{ stat.value }}</div>
              <div class="text-white/80 text-sm">{{ stat.label }}</div>
            </div>
          </div>

          <!-- CTA -->
          <div class="mt-8">
            <NuxtLink
              to="/contact"
              class="inline-flex items-center gap-2 px-8 py-4 bg-white text-primary rounded-full font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300"
            >
              {{ location.hero.cta }}
              <Icon name="mdi:arrow-right" class="w-5 h-5" />
            </NuxtLink>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Choose Section -->
    <section class="py-20 bg-white dark:bg-gray-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
            {{ location.whyChoose.title }}
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            {{ location.whyChoose.intro }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div
            v-for="(advantage, index) in location.whyChoose.advantages"
            :key="index"
            class="bg-gray-50 dark:bg-gray-900 rounded-2xl p-6 hover:shadow-xl transition-all duration-300"
          >
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] flex items-center justify-center mb-4">
              <Icon :name="advantage.icon" class="!w-6 !h-6 text-white" />
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">
              {{ advantage.title }}
            </h3>
            <p class="text-gray-600 dark:text-gray-400">
              {{ advantage.description }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
            {{ location.services.title }}
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            {{ location.services.intro }}
          </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
          <div
            v-for="(service, index) in location.services.list"
            :key="index"
            class="bg-white dark:bg-gray-800 rounded-2xl p-8 hover:shadow-xl transition-all duration-300"
          >
            <div class="flex items-start gap-4">
              <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] flex items-center justify-center flex-shrink-0">
                <Icon :name="service.icon" class="!w-6 !h-6 text-white" />
              </div>
              <div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">
                  {{ service.title }}
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mb-3">
                  {{ service.description }}
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-500">
                  <strong>Exemples :</strong> {{ service.examples }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Projects Section (if exists) -->
    <section v-if="location.projects" class="py-20 bg-white dark:bg-gray-950">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
            {{ location.projects.title }}
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
            {{ location.projects.intro }}
          </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
          <a
            v-for="(project, index) in location.projects.featured"
            :key="index"
            :href="project.url"
            target="_blank"
            rel="noopener noreferrer"
            class="group bg-gray-50 dark:bg-gray-900 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1"
          >
            <div class="flex items-start gap-4">
              <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] flex items-center justify-center flex-shrink-0">
                <Icon name="mdi:web" class="!w-5 !h-5 text-white" />
              </div>
              <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1 group-hover:text-[var(--color-primary)] transition-colors">
                  {{ project.title }}
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                  <Icon name="mdi:map-marker" class="w-4 h-4 inline" />
                  {{ project.location }}
                </p>
                <span class="inline-block px-3 py-1 bg-white dark:bg-gray-800 rounded-full text-xs text-gray-600 dark:text-gray-400">
                  {{ project.type }}
                </span>
              </div>
              <Icon name="mdi:arrow-right" class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-transform" />
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- Process Section -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
            {{ location.process.title }}
          </h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div
            v-for="(step, index) in location.process.steps"
            :key="index"
            class="relative text-center"
          >
            <div class="mb-6">
              <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] flex items-center justify-center text-white text-2xl font-bold">
                {{ step.number }}
              </div>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">
              {{ step.title }}
            </h3>
            <p class="text-gray-600 dark:text-gray-400">
              {{ step.description }}
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-white dark:bg-gray-950">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
            Questions fréquentes
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Tout ce que vous devez savoir sur nos services à {{ location.ville }}
          </p>
        </div>

        <div class="space-y-4">
          <div
            v-for="(item, index) in location.faq"
            :key="index"
            class="bg-gray-50 dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-200/50 dark:border-gray-700/50"
          >
            <button
              @click="toggleFaq(index)"
              class="w-full font-bold text-lg text-gray-900 dark:text-white flex justify-between items-center p-6 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-750 transition-colors text-left rounded-2xl"
            >
              <span class="pr-8 flex items-start gap-3">
                <span class="flex-shrink-0 mt-1 w-7 h-7 rounded-full bg-gradient-to-br from-[var(--color-primary)]/20 to-[var(--color-secondary)]/20 flex items-center justify-center text-sm font-bold text-[var(--color-primary)]">
                  {{ index + 1 }}
                </span>
                <span>{{ item.question }}</span>
              </span>
              <Icon
                name="mdi:chevron-down"
                class="w-6 h-6 transition-transform duration-300 flex-shrink-0 text-[var(--color-primary)]"
                :class="{ 'rotate-180': openFaqIndex === index }"
              />
            </button>

            <Transition
              enter-active-class="transition-all duration-300 ease-out"
              enter-from-class="max-h-0 opacity-0"
              enter-to-class="max-h-96 opacity-100"
              leave-active-class="transition-all duration-200 ease-in"
              leave-from-class="max-h-96 opacity-100"
              leave-to-class="max-h-0 opacity-0"
            >
              <div
                v-if="openFaqIndex === index"
                class="overflow-hidden"
              >
                <div class="px-6 pb-6 pl-[72px] border-t border-gray-200/50 dark:border-gray-700/50 pt-4">
                  <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ item.answer }}</p>
                </div>
              </div>
            </Transition>
          </div>
        </div>

        <div class="mt-16 text-center p-8 bg-gradient-to-br from-[var(--color-primary)]/10 to-[var(--color-secondary)]/10 rounded-3xl border border-[var(--color-primary)]/20">
          <div class="flex items-center justify-center mb-4">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] flex items-center justify-center">
              <Icon name="mdi:help-circle" class="w-6 h-6 text-white" />
            </div>
          </div>
          <p class="text-lg text-gray-700 dark:text-gray-300 mb-4 font-semibold">
            Vous avez d'autres questions ?
          </p>
          <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
            Notre équipe est là pour vous répondre et vous accompagner
          </p>
          <NuxtLink
            to="/contact"
            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] text-white font-semibold rounded-lg hover:shadow-xl transition-all hover:-translate-y-0.5"
          >
            Contactez-nous
            <Icon name="mdi:arrow-right" class="w-5 h-5" />
          </NuxtLink>
        </div>
      </div>
    </section>

    <!-- CTA Final -->
    <section class="py-20 bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)]">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
          {{ location.cta.title }}
        </h2>
        <p class="text-xl text-white/90 mb-8">
          {{ location.cta.description }}
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
          <NuxtLink
            to="/contact"
            class="inline-flex items-center gap-2 px-8 py-4 bg-white text-primary rounded-full font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300"
          >
            {{ location.cta.primaryButton }}
            <Icon name="mdi:arrow-right" class="w-5 h-5" />
          </NuxtLink>
          <NuxtLink
            to="/projets"
            class="inline-flex items-center gap-2 px-8 py-4 bg-white/10 text-white rounded-full font-semibold hover:bg-white/20 transition-all duration-300 backdrop-blur-sm"
          >
            {{ location.cta.secondaryButton }}
            <Icon name="mdi:folder-open" class="w-5 h-5" />
          </NuxtLink>
        </div>
      </div>
    </section>
  </div>

  <!-- Loading state -->
  <div v-else class="min-h-screen flex items-center justify-center bg-white dark:bg-dark">
    <div class="text-center">
      <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-primary mx-auto mb-4"></div>
      <p class="text-gray-600 dark:text-gray-400">Chargement...</p>
    </div>
  </div>
</template>

<script setup lang="ts">
const route = useRoute()
const ville = route.params.ville as string

const { data: location, error } = await useFetch(() => `/api/locations/${ville}`, {
  key: `location-${ville}`
})

// Handle 404
if (error.value) {
  throw createError({
    statusCode: 404,
    statusMessage: 'Ville non trouvée',
    fatal: true
  })
}

// FAQ accordion state
const openFaqIndex = ref<number | null>(null)

const toggleFaq = (index: number) => {
  openFaqIndex.value = openFaqIndex.value === index ? null : index
}

// SEO Premium avec tous les schemas
watch(location, (newLocation) => {
  if (newLocation) {
    usePremiumSeo({
      title: newLocation.meta.title,
      description: newLocation.meta.description,
      url: `https://www.as-turing.fr/creation-site-internet-${newLocation.slug}`,
      image: 'https://www.as-turing.fr/images/og-location.jpg',
      type: 'website',
      breadcrumbs: [
        { name: 'Accueil', url: '/' },
        { name: `Création site internet ${newLocation.ville}`, url: `/creation-site-internet-${newLocation.slug}` }
      ],
      faq: newLocation.faq
    })
    
    // Meta géographiques et keywords
    useHead({
      meta: [
        { name: 'keywords', content: newLocation.meta.keywords },
        { name: 'geo.region', content: 'FR-33' },
        { name: 'geo.placename', content: newLocation.ville },
        { name: 'geo.position', content: `${newLocation.coordinates?.latitude || ''};${newLocation.coordinates?.longitude || ''}` }
      ]
    })
  }
}, { immediate: true })
</script>
