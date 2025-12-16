<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <!-- Hero -->
    <section class="pt-32 pb-16 gradient-hero text-white relative overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl animate-blob animation-delay-2000"></div>
      </div>
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="inline-block mb-4">
          <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-semibold border border-white/30">
            Nos Localisations
          </span>
        </div>
        <h1 class="text-5xl md:text-6xl font-bold mb-6">
          Création de Sites Internet en Gironde
        </h1>
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
          Nous accompagnons les entreprises locales dans leur transformation digitale
        </p>
      </div>
    </section>

    <!-- Locations Grid -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div v-if="locations.length === 0" class="text-center py-20">
          <Icon name="mdi:map-marker-outline" class="w-24 h-24 mx-auto text-gray-300 dark:text-gray-600 mb-4" />
          <p class="text-xl text-gray-600 dark:text-gray-400">Chargement des localisations...</p>
        </div>

        <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <NuxtLink
            v-for="location in locations"
            :key="location.id"
            :to="`/localisation/${location.slug}`"
            class="group bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
          >
            <div class="p-6">
              <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-3">
                <Icon name="mdi:map-marker" class="w-4 h-4" />
                <span>{{ location.departement }}</span>
              </div>
              
              <h3 class="text-2xl font-bold text-dark dark:text-white mb-3 group-hover:text-primary dark:group-hover:text-primary transition-colors">
                {{ location.ville }}
              </h3>
              
              <p class="text-gray-600 dark:text-gray-300 mb-6">
                Création de sites internet à {{ location.ville }}
              </p>
              
              <div class="flex items-center gap-2 text-primary dark:text-primary font-semibold">
                En savoir plus
                <Icon name="mdi:arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform" />
              </div>
            </div>
          </NuxtLink>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
const { data: rawLocations } = await useFetch('/api/locations', {
  key: 'locations-list'
})

const locations = computed(() => {
  if (!rawLocations.value) return []
  return rawLocations.value.map((loc: any) => ({
    id: loc.id,
    ville: loc.ville,
    slug: loc.slug,
    departement: loc.departement
  }))
})

useHead({
  title: 'Création Site Internet Gironde | Agence Web Locale',
  meta: [
    {
      name: 'description',
      content: 'Agence web en Gironde : création de sites internet pour les entreprises locales. Expertise locale, accompagnement personnalisé.'
    }
  ]
})
</script>

<style scoped>
@keyframes blob {
  0%, 100% { transform: translateY(0px) scale(1); }
  50% { transform: translateY(-20px) scale(1.1); }
}

.animate-blob {
  animation: blob 6s ease-in-out infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}
</style>
