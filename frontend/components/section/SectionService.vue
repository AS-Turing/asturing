<script setup lang="ts">
import { useRuntimeConfig } from 'nuxt/app'
import { ref, onMounted, onBeforeUnmount, watch, nextTick, computed } from 'vue'
import { Service } from '/types/services'

const baseUrl = useRuntimeConfig().public.apiBaseUrl
const visibleCards = ref<number[]>([])

// useFetch au top level pour SSR
const { data: apiResponse, pending: loading, error: fetchError } = await useFetch<ApiResponse<Service[]>>(`${baseUrl}/services`)

// Computed pour transformer les données
const services = computed(() => {
  if (!apiResponse.value?.success) return []
  return (apiResponse.value.data || []).map((s) => ({
    ...s,
    icon: s.icon ?? 'lucide:square',
    img: s.img ?? '/images/placeholder-service.webp',
  }))
})

const error = computed(() => {
  if (fetchError.value) return 'Erreur de connexion au serveur'
  if (apiResponse.value && !apiResponse.value.success) {
    return apiResponse.value.data as any || 'Erreur lors du chargement des services'
  }
  return null
})

let observer: IntersectionObserver | null = null

function ensureObserver() {
  if (observer) observer.disconnect()
  observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        const index = Number(entry.target.getAttribute('data-index'))
        if (entry.isIntersecting) {
          if (!visibleCards.value.includes(index)) visibleCards.value.push(index)
        } else {
          const i = visibleCards.value.indexOf(index)
          if (i !== -1) visibleCards.value.splice(i, 1)
        }
      })
    },
    { threshold: 0.3 },
  )
  document.querySelectorAll<HTMLElement>('.card-item').forEach((el) => observer!.observe(el))
}

onMounted(async () => {
  await nextTick()
  ensureObserver()
})

watch(
  () => services.value?.length,
  async () => {
    await nextTick()
    ensureObserver()
  },
)

onBeforeUnmount(() => {
  if (observer) observer.disconnect()
})
</script>

<template>
  <section class="bg-white dark:bg-gray-900 py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl sm:text-5xl font-bold text-center text-primary dark:text-white mb-12 underline dark:decoration-secondary underline-offset-8">
        Mes services
      </h2>

      <div v-if="error" class="text-red-600 dark:text-red-400 text-center">{{ error }}</div>

      <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <NuxtLink
          v-for="(item, index) in services"
          :key="item.id ?? (item.title + '-' + index)"
          :to="`/services/` + item.slug"
          class="card-item group overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-primary shadow-sm hover:shadow-lg transition-all duration-500"
          :data-index="index"
          :class="{ 'animate-visible': visibleCards.includes(index) }"
        >
          <img
            :src="item.img"
            :alt="`Illustration service ${item.title}`"
            loading="lazy"
            class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300"
          />
          <div class="p-6">
            <h3 class="text-xl min-h-16 font-semibold text-primary hover:dark:text-secondary dark:text-white mb-2 flex items-center gap-2">
              <Icon :name="item.icon" class="w-5 h-5 dark:text-secondary" />
              {{ item.title }}
            </h3>
            <p class="dark:text-gray-200 text-base leading-relaxed">
              {{ item.description }}
            </p>
          </div>
        </NuxtLink>
      </div>

      <div v-if="loading" class="mt-8 text-center opacity-60">Chargement…</div>
    </div>
  </section>
</template>

<style scoped>
.card-item {
  opacity: 0;
  transform: translateY(30px);
}

.card-item.animate-visible {
  opacity: 1;
  transform: translateY(0);
  transition: all 1s ease-out;
}

.group:hover .card-item img {
  transform: scale(1.05);
}
</style>