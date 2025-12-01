<template>
  <div v-if="service" class="min-h-screen">
    <ServiceHero
      :icon="service.icon"
      :title="service.heroTitle || service.title"
      :subtitle="service.heroSubtitle || service.description"
      :description="service.heroDescription"
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

    <ServiceCTA 
      v-if="service.cta"
      :title="service.cta.title"
      :subtitle="service.cta.description"
      :primary-button-text="service.cta.buttonText"
    />
    <ServiceCTA v-else />
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

// SEO dynamique basé sur les données du service
useHead(() => ({
  title: service.value?.metaTitle || `${service.value?.title} | AS-Turing`,
  meta: [
    {
      name: 'description',
      content: service.value?.metaDescription || service.value?.description || ''
    },
    // Keywords
    {
      name: 'keywords',
      content: service.value?.metaKeywords || ''
    },
    // Open Graph
    {
      property: 'og:title',
      content: service.value?.metaTitle || service.value?.title || ''
    },
    {
      property: 'og:description',
      content: service.value?.metaDescription || service.value?.description || ''
    },
    {
      property: 'og:type',
      content: 'website'
    },
    {
      property: 'og:image',
      content: service.value?.ogImage || ''
    },
    // Robots
    {
      name: 'robots',
      content: 'index, follow'
    }
  ],
  // Schema.org Service détaillé
  script: service.value ? [
    {
      type: 'application/ld+json',
      children: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'Service',
        'name': service.value.title,
        'description': service.value.description,
        'serviceType': service.value.title,
        'url': `https://as-turing.fr/services/${service.value.slug}`,
        'provider': {
          '@type': 'LocalBusiness',
          'name': 'AS-Turing',
          'address': {
            '@type': 'PostalAddress',
            'addressLocality': 'Libourne',
            'addressRegion': 'Nouvelle-Aquitaine',
            'postalCode': '33500',
            'addressCountry': 'FR'
          }
        },
        'areaServed': [
          {
            '@type': 'City',
            'name': 'Libourne'
          },
          {
            '@type': 'City',
            'name': 'Saint-Émilion'
          },
          {
            '@type': 'City',
            'name': 'Bordeaux'
          }
        ],
        ...(service.value.startingPrice ? {
          'offers': {
            '@type': 'Offer',
            'price': service.value.startingPrice.replace(/[^0-9]/g, ''),
            'priceCurrency': 'EUR',
            'priceSpecification': {
              '@type': 'PriceSpecification',
              'price': service.value.startingPrice.replace(/[^0-9]/g, ''),
              'priceCurrency': 'EUR'
            }
          }
        } : {})
      })
    }
  ] : []
}))
</script>

