<template>
  <div v-if="config" class="min-h-screen">
    <section class="relative py-32 px-4 overflow-hidden bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)]">
      <div class="absolute inset-0 opacity-20">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl animate-float-delayed"></div>
      </div>

      <div class="max-w-5xl mx-auto text-center relative z-10">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white/90 text-sm font-semibold mb-8">
          <Icon name="mdi:chart-timeline-variant" class="w-5 h-5" />
          <span>{{ config.hero.badge }}</span>
        </div>

        <h1 class="text-5xl md:text-7xl font-heading font-bold text-white mb-8 leading-tight">
          {{ config.hero.title }}
        </h1>
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed">
          {{ config.hero.subtitle }}
        </p>
      </div>
    </section>

    <section class="py-24 px-4 bg-white dark:bg-gray-900 transition-colors">
      <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
            {{ config.process.title }}
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            {{ config.process.description }}
          </p>
        </div>

        <div class="relative">
          <div class="absolute left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-[var(--color-primary)] via-[var(--color-secondary)] to-[var(--color-coral)] transform -translate-x-1/2 hidden md:block"></div>

          <div class="space-y-16">
            <div v-for="(step, index) in config.process.steps" :key="index" class="relative flex flex-col md:flex-row gap-8 items-center" :class="{ 'md:flex-row-reverse': index % 2 === 1 }">
              <div class="flex-shrink-0 relative z-10">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] flex items-center justify-center shadow-2xl">
                  <span class="text-white text-3xl font-bold">{{ index + 1 }}</span>
                </div>
              </div>

              <div class="flex-1 w-full md:w-auto">
                <div class="bg-gray-50 dark:bg-gray-800 rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all">
                  <div class="flex items-start gap-4 mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[var(--color-primary)]/10 to-[var(--color-secondary)]/10 flex items-center justify-center flex-shrink-0">
                      <Icon :name="step.icon" class="!w-7 !h-7 text-[var(--color-primary)]" />
                    </div>
                    <div>
                      <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ step.title }}</h3>
                      <p class="text-sm text-[var(--color-primary)] font-semibold">{{ step.duration }}</p>
                    </div>
                  </div>
                  <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed mb-6">{{ step.description }}</p>

                  <div v-if="step.deliverables" class="space-y-2">
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Livrables :</p>
                    <ul class="space-y-2">
                      <li v-for="(deliverable, idx) in step.deliverables" :key="idx" class="flex items-start gap-2">
                        <Icon name="mdi:check-circle" class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" />
                        <span class="text-gray-600 dark:text-gray-400 text-sm">{{ deliverable }}</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-24 px-4 bg-gray-50 dark:bg-gray-800 transition-colors">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
            {{ config.values.title }}
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            {{ config.values.description }}
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="(value, index) in config.values.items" :key="index" class="bg-white dark:bg-gray-900 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 relative overflow-hidden group">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-secondary)]"></div>

            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[var(--color-primary)]/10 to-[var(--color-secondary)]/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <Icon :name="value.icon" class="!w-8 !h-8 text-[var(--color-primary)]" />
            </div>

            <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">{{ value.title }}</h3>
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ value.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <ServiceCTA />
  </div>
</template>

<script setup lang="ts">
const { data: config } = await useFetch('/api/process/config')

useHead({
  title: config.value?.seo?.title || 'Notre Méthodologie',
  meta: [{ name: 'description', content: config.value?.seo?.description || '' }]
})
</script>

<style scoped>
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}

@keyframes float-delayed {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(20px); }
}

.animate-float {
  animation: float 6s ease-in-out infinite;
}

.animate-float-delayed {
  animation: float-delayed 8s ease-in-out infinite;
}
</style>
