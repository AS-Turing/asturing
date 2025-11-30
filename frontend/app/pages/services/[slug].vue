<template>
  <div v-if="service" class="min-h-screen">
    <ServiceHero
      :icon="service.icon"
      :title="service.heroTitle || service.title"
      :subtitle="service.heroSubtitle || service.description"
      :audit-duration="service.auditDuration"
      :delivery-time="service.deliveryTime"
      :starting-price="service.startingPrice"
    />

    <ServiceIntro
      v-if="service.longDescription"
      :icon="service.icon"
      :heading="`Qu'est-ce que ${service.title.toLowerCase()} ?`"
      :description="service.longDescription"
    />

    <ServiceSolutions
      v-if="service.solutions && service.solutions.length"
      :solutions="service.solutions"
    />

    <ServiceProcess
      v-if="service.processSteps && service.processSteps.length"
      :steps="service.processSteps"
    />

    <ServiceTechnologies
      v-if="service.technologies && service.technologies.length"
      :technologies="service.technologies"
    />

    <ServiceFAQ
      v-if="service.faqs && service.faqs.length"
      :subtitle="`Tout ce que vous devez savoir sur ${service.title.toLowerCase()}`"
      :faqs="service.faqs"
    />

    <ServiceCTA />
  </div>

  <div v-else class="min-h-screen flex items-center justify-center">
    <div class="text-center">
      <h1 class="text-4xl font-bold mb-4">Service non trouvé</h1>
      <NuxtLink to="/services" class="text-[var(--color-primary)] hover:underline">
        Retour aux services
      </NuxtLink>
    </div>
  </div>
</template>

<script setup lang="ts">
const route = useRoute()
const { data: service } = await useFetch(() => `/api/services/${route.params.slug}`, {
  key: () => `service-${route.params.slug}`,
  watch: [() => route.params.slug]
})
</script>

