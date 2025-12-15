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

    <section
      v-if="hasContextBlocks"
      class="py-24 px-4 bg-gradient-to-b from-white via-gray-50/50 to-white dark:from-gray-950 dark:via-gray-900/30 dark:to-gray-950 transition-colors"
    >
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
            Est-ce fait pour vous ?
          </h2>
          <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            Découvrez si cette prestation correspond à vos besoins et les résultats que vous pouvez en attendre
          </p>
        </div>
        
        <div
          class="grid gap-8 grid-cols-1"
          :class="contextGridClass"
        >
          <article
            v-if="audienceBlock?.items?.length"
            class="group relative overflow-hidden rounded-3xl border border-gray-200/60 dark:border-gray-800/60 bg-white dark:bg-gray-900 p-10 shadow-lg hover:shadow-2xl transition-all duration-300"
          >
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[var(--color-primary)] via-[var(--color-secondary)] to-[var(--color-primary)] opacity-80"></div>
            
            <div class="hidden md:block absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-[var(--color-primary)]/5 to-transparent rounded-full blur-3xl -mr-32 -mt-32 group-hover:scale-150 transition-transform duration-700"></div>
            
            <div class="relative">
              <div class="flex items-center gap-4 mb-6">
                <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] shadow-lg">
                  <MdiIcon name="mdi:account-star" class="w-7 h-7 text-white" />
                </div>
                <div>
                  <div class="text-xs font-semibold uppercase tracking-wider text-[var(--color-primary)] mb-1">
                    Profil idéal
                  </div>
                  <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white">
                    {{ audienceBlock.title }}
                  </h3>
                </div>
              </div>
              
              <ul class="space-y-4">
                <li
                  v-for="(item, idx) in audienceBlock.items"
                  :key="`audience-${idx}`"
                  class="flex items-start gap-4 group/item"
                >
                  <div class="flex-shrink-0 mt-1">
                    <div class="flex items-center justify-center w-7 h-7 rounded-lg bg-gradient-to-br from-[var(--color-primary)]/10 to-[var(--color-secondary)]/10 group-hover/item:from-[var(--color-primary)]/20 group-hover/item:to-[var(--color-secondary)]/20 transition-colors">
                      <MdiIcon name="mdi:check-circle" class="w-5 h-5 text-[var(--color-primary)]" />
                    </div>
                  </div>
                  <span class="text-gray-700 dark:text-gray-300 leading-relaxed text-[15px]">{{ item }}</span>
                </li>
              </ul>
            </div>
          </article>

          <article
            v-if="outcomesBlock?.items?.length"
            class="group relative overflow-hidden rounded-3xl border border-gray-200/60 dark:border-gray-800/60 bg-white dark:bg-gray-900 p-10 shadow-lg hover:shadow-2xl transition-all duration-300"
          >
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[var(--color-secondary)] via-[var(--color-primary)] to-[var(--color-secondary)] opacity-80"></div>
            
            <div class="hidden md:block absolute top-0 left-0 w-64 h-64 bg-gradient-to-br from-[var(--color-secondary)]/5 to-transparent rounded-full blur-3xl -ml-32 -mt-32 group-hover:scale-150 transition-transform duration-700"></div>
            
            <div class="relative">
              <div class="flex items-center gap-4 mb-6">
                <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-[var(--color-secondary)] to-[var(--color-primary)] shadow-lg">
                  <MdiIcon name="mdi:chart-line-variant" class="w-7 h-7 text-white" />
                </div>
                <div>
                  <div class="text-xs font-semibold uppercase tracking-wider text-[var(--color-secondary)] mb-1">
                    Résultats concrets
                  </div>
                  <h3 class="text-2xl font-heading font-bold text-gray-900 dark:text-white">
                    {{ outcomesBlock.title }}
                  </h3>
                </div>
              </div>
              
              <ul class="space-y-4">
                <li
                  v-for="(item, idx) in outcomesBlock.items"
                  :key="`outcome-${idx}`"
                  class="flex items-start gap-4 group/item"
                >
                  <div class="flex-shrink-0 mt-1">
                    <div class="flex items-center justify-center w-7 h-7 rounded-lg bg-gradient-to-br from-[var(--color-secondary)]/10 to-[var(--color-primary)]/10 group-hover/item:from-[var(--color-secondary)]/20 group-hover/item:to-[var(--color-primary)]/20 transition-colors">
                      <MdiIcon name="mdi:star-check" class="w-5 h-5 text-[var(--color-secondary)]" />
                    </div>
                  </div>
                  <span class="text-gray-700 dark:text-gray-300 leading-relaxed text-[15px]">{{ item }}</span>
                </li>
              </ul>
            </div>
          </article>
        </div>
      </div>
    </section>

    <ServiceSolutions
      v-if="solutions.length"
      :solutions="solutions"
    />

    <section
      v-if="ctaSoftBlock"
      class="py-24 px-4 bg-gray-50 dark:bg-gray-950 transition-colors"
    >
      <div class="max-w-6xl mx-auto">
        <div class="relative group overflow-hidden rounded-[32px] border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-xl hover:shadow-2xl transition-all duration-500">
          <!-- Subtle gradient background -->
          <div class="absolute inset-0 bg-gradient-to-br from-[var(--color-primary)]/5 via-transparent to-[var(--color-secondary)]/5 opacity-50 group-hover:opacity-70 transition-opacity"></div>
          
          <!-- Animated gradient orbs (desktop only for performance) -->
          <div class="hidden md:block absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-[var(--color-primary)]/10 to-transparent rounded-full blur-3xl -mr-48 -mt-48 group-hover:scale-125 transition-transform duration-1000"></div>
          <div class="hidden md:block absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-[var(--color-secondary)]/10 to-transparent rounded-full blur-3xl -ml-48 -mb-48 group-hover:scale-125 transition-transform duration-1000"></div>
          
          <div class="relative z-10 p-10 md:p-14">
            <!-- Icon badge -->
            <div class="flex justify-center mb-6">
              <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] shadow-lg group-hover:scale-110 transition-transform duration-300">
                <MdiIcon name="mdi:chat-question" class="w-8 h-8 text-white" />
              </div>
            </div>

            <div class="text-center space-y-6 max-w-2xl mx-auto">
              <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[var(--color-primary)] mb-3">
                  Prochaine étape
                </p>
                <h3 class="text-3xl md:text-4xl font-heading font-bold text-gray-900 dark:text-white leading-tight mb-4">
                  {{ ctaSoftBlock.title }}
                </h3>
                <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                  {{ ctaSoftBlock.description }}
                </p>
              </div>

              <div class="flex flex-col sm:flex-row gap-4 justify-center pt-2">
                <NuxtLink
                  to="/contact"
                  class="group/btn inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] text-white font-semibold text-lg shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all"
                >
                  <MdiIcon name="mdi:calendar-clock" class="w-5 h-5 group-hover/btn:rotate-12 transition-transform" />
                  {{ ctaSoftBlock.buttonText || 'Parler à un expert' }}
                </NuxtLink>
                <NuxtLink
                  to="/services"
                  class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl border-2 border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 font-semibold text-lg hover:border-[var(--color-primary)] hover:text-[var(--color-primary)] dark:hover:border-[var(--color-primary)] dark:hover:text-[var(--color-primary)] hover:bg-gray-50 dark:hover:bg-gray-800 transition-all"
                >
                  <MdiIcon name="mdi:information-outline" class="w-5 h-5" />
                  Voir tous nos services
                </NuxtLink>
              </div>

              <div v-if="ctaSoftBlock.microReassurance" class="flex items-center justify-center gap-6 pt-4 text-sm text-gray-600 dark:text-gray-400 flex-wrap">
                <span
                  v-for="(item, idx) in ctaSoftBlock.microReassurance.split('•')"
                  :key="idx"
                  class="flex items-center gap-2"
                >
                  <MdiIcon name="mdi:check-circle" class="w-4 h-4 text-[var(--color-primary)]" />
                  {{ item.trim() }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

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
  key: `service-${route.params.slug}`,
  watch: [() => route.params.slug]
})

const solutions = computed(() => service.value?.solutions ?? [])
const audienceBlock = computed(() => service.value?.audience ?? null)
const outcomesBlock = computed(() => service.value?.outcomes ?? null)
const ctaSoftBlock = computed(() => service.value?.ctaSoft ?? null)
const audienceItemsCount = computed(() => audienceBlock.value?.items?.length ?? 0)
const outcomesItemsCount = computed(() => outcomesBlock.value?.items?.length ?? 0)
const hasContextBlocks = computed(() => {
  return audienceItemsCount.value + outcomesItemsCount.value > 0
})
const contextGridClass = computed(() =>
  audienceItemsCount.value > 0 && outcomesItemsCount.value > 0
    ? 'md:grid-cols-2'
    : 'md:grid-cols-1'
)

// SEO Premium AAA avec Schema Product et FAQs
watch(service, (newService) => {
  if (newService) {
    usePremiumSeo({
      title: newService.metaTitle || `${newService.title} | AS-Turing`,
      description: newService.metaDescription || newService.description || '',
      url: `https://www.as-turing.fr/services/${newService.slug}`,
      image: newService.ogImage || 'https://www.as-turing.fr/images/og-services.jpg',
      type: 'website',
      breadcrumbs: [
        { name: 'Accueil', url: '/' },
        { name: 'Services', url: '/services' },
        { name: newService.title, url: `/services/${newService.slug}` }
      ],
      faq: newService.faqs?.map((faq: any) => ({
        question: faq.question,
        answer: faq.answer
      })),
      product: newService.startingPrice ? {
        name: newService.title,
        image: newService.ogImage || 'https://www.as-turing.fr/images/og-services.jpg',
        description: newService.description,
        price: newService.startingPrice.replace(/[^0-9]/g, ''),
        currency: 'EUR'
      } : undefined
    })
    
    // Keywords meta supplémentaires
    useHead({
      meta: [
        {
          name: 'keywords',
          content: newService.metaKeywords || `${newService.title}, agence web Libourne, ${newService.slug}`
        }
      ]
    })
  }
}, { immediate: true })
</script>
