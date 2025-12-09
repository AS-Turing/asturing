<template>
  <section class="py-24 px-4 bg-white dark:bg-gray-900 transition-colors">
    <div class="max-w-5xl mx-auto">
      <div class="flex flex-col md:flex-row gap-12 items-center">
        <div class="md:w-1/3">
          <div class="w-full aspect-square rounded-3xl bg-gradient-to-br from-[var(--color-primary)]/20 to-[var(--color-secondary)]/20 flex items-center justify-center">
            <MdiIcon :name="icon" class="!w-32 !h-32 text-[var(--color-primary)]" />
          </div>
        </div>
        <div class="md:w-2/3">
          <h2 class="text-4xl font-heading font-bold text-gray-900 dark:text-white mb-6">
            {{ heading }}
          </h2>
          <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed mb-6">
            {{ description }}
          </p>
          <NuxtLink 
            to="/contact"
            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-secondary)] text-white font-semibold rounded-lg hover:shadow-xl transition-all"
          >
            Demander un devis gratuit
            <MdiIcon name="mdi:arrow-right" class="w-5 h-5" />
          </NuxtLink>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
defineProps<{
  icon: string
  heading: string
  description: string
}>()
</script>
