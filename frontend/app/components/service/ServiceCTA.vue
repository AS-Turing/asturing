<template>
  <section class="py-24 px-4 bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 30px 30px;"></div>
    </div>
    
    <div class="max-w-4xl mx-auto text-center relative z-10">
      <h2 class="text-4xl md:text-5xl font-heading font-bold text-white mb-6">
        {{ title }}
      </h2>
      <p class="text-xl md:text-2xl text-white/90 mb-12 leading-relaxed">
        {{ subtitle }}
      </p>
      
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <NuxtLink 
          to="/contact"
          class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-[var(--color-primary)] rounded-xl font-bold text-lg hover:bg-gray-100 transition-all shadow-2xl hover:scale-105"
        >
          <Icon name="mdi:calendar" class="w-6 h-6" />
          {{ primaryButtonText }}
        </NuxtLink>
        <a 
          v-if="company?.phone"
          :href="`tel:${phoneFormatted}`"
          class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 backdrop-blur-sm text-white rounded-xl font-bold text-lg hover:bg-white/20 transition-all border-2 border-white/30"
        >
          <Icon name="mdi:phone" class="w-6 h-6" />
          {{ company.phone }}
        </a>
      </div>
      
      <p class="mt-8 text-white/80 text-sm">
        Réponse sous 24h • Devis gratuit • Accompagnement personnalisé
      </p>
    </div>
  </section>
</template>

<script setup lang="ts">
const { companyInfo: company } = useCompany()

const props = withDefaults(defineProps<{
  title?: string
  subtitle?: string
  primaryButtonText?: string
}>(), {
  title: 'Prêt à démarrer votre projet ?',
  subtitle: 'Discutons de vos besoins et trouvons la meilleure solution ensemble. Audit gratuit et sans engagement.',
  primaryButtonText: 'Demander un devis'
})

const phoneFormatted = computed(() => company.value?.phone?.replace(/\s/g, '') || '')
</script>
