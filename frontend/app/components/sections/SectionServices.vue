<template>
  <section v-if="services.length > 0" class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- En-tête section -->
      <div class="text-center mb-16">
        <span class="inline-block px-4 py-2 bg-primary/10 dark:bg-primary/20 text-primary dark:text-primary rounded-full text-sm font-semibold mb-4">
          Nos Services
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
          Des solutions adaptées à vos besoins
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
          De la simple page vitrine à l'application métier complexe, nous maîtrisons toute la chaîne de valeur du web.
        </p>
      </div>

      <!-- Grille de services -->
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <ServiceCard
          v-for="service in services"
          :key="service.id"
          :service="service"
        />
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
const { fetchServices } = useApi()
const services = ref([])

onMounted(async () => {
  services.value = await fetchServices()
})
</script>
