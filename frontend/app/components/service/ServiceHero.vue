<template>
  <section class="relative py-32 px-4 overflow-hidden bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] dark:from-[var(--color-primary)]/90 dark:to-[var(--color-secondary)]/90">
    <!-- Background animation -->
    <div class="absolute inset-0 opacity-20">
      <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl animate-float"></div>
      <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl animate-float-delayed"></div>
    </div>
    
    <div class="max-w-6xl mx-auto text-center relative z-10">
      <!-- Badge -->
      <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white/90 text-sm font-semibold mb-8">
        <Icon :name="icon" class="!w-5 !h-5" />
        <span>Service Premium</span>
      </div>
      
      <h1 class="text-5xl md:text-7xl font-heading font-bold text-white mb-8 leading-tight">
        {{ title }}
      </h1>
      <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto mb-6 leading-relaxed">
        {{ subtitle }}
      </p>
      <p v-if="description" class="text-lg text-white/80 max-w-3xl mx-auto mb-12 leading-relaxed">
        {{ description }}
      </p>
      <p v-else class="mb-12"></p>
      
      <!-- Quick stats -->
      <div class="grid gap-6 max-w-4xl mx-auto" :class="{
        'grid-cols-2 md:grid-cols-4': statsCount >= 4,
        'grid-cols-2 md:grid-cols-3': statsCount === 3,
        'grid-cols-2': statsCount === 2,
        'grid-cols-1 md:grid-cols-2': statsCount === 1
      }">
        <div v-if="auditDuration" class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
          <div class="text-3xl font-bold text-white mb-2">{{ auditDuration }}</div>
          <div class="text-white/80 text-sm">Audit gratuit</div>
        </div>
        <div v-if="deliveryTime" class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
          <div class="text-3xl font-bold text-white mb-2">{{ deliveryTime }}</div>
          <div class="text-white/80 text-sm">{{ deliveryTimeLabel }}</div>
        </div>
        <div v-if="startingPrice" class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
          <div class="text-3xl font-bold text-white mb-2">{{ startingPrice }}</div>
          <div class="text-white/80 text-sm">À partir de</div>
        </div>
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
          <div class="text-3xl font-bold text-white mb-2">{{ guarantee }}</div>
          <div class="text-white/80 text-sm">{{ guaranteeLabel }}</div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
const props = withDefaults(defineProps<{
  icon: string
  title: string
  subtitle: string
  description?: string | null
  auditDuration?: string | null
  deliveryTime?: string | null
  deliveryTimeLabel?: string
  startingPrice?: string | null
  guarantee?: string
  guaranteeLabel?: string
}>(), {
  deliveryTimeLabel: 'Semaines',
  guarantee: '100%',
  guaranteeLabel: 'Sur-mesure'
})

const statsCount = computed(() => {
  let count = 1 // guarantee is always shown
  if (props.auditDuration) count++
  if (props.deliveryTime) count++
  if (props.startingPrice) count++
  return count
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
