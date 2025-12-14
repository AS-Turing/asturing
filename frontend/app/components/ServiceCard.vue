<template>
  <div 
    class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg hover:shadow-2xl dark:shadow-xl dark:hover:shadow-2xl transition-all duration-300 group border-t-4 dark:border-t-4"
    :class="getBorderClass(service.borderColor)"
  >
    <div 
      class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg"
      :class="getGradientClass(service.iconGradient)"
    >
      <MdiIcon v-if="service.icon" :name="service.icon" class="!w-8 !h-8 text-white" />
    </div>
    <h3 class="text-2xl font-bold text-dark dark:text-white mb-4">{{ service.title }}</h3>
    <p class="text-gray-600 dark:text-gray-300 mb-6">
      {{ service.description }}
    </p>
    <NuxtLink 
      :to="`/services/${service.slug}`" 
      class="font-semibold hover:underline inline-flex items-center group/link"
      :class="getLinkClass(service.linkColor)"
    >
      En savoir plus 
      <svg class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
      </svg>
    </NuxtLink>
  </div>
</template>

<script setup>
const props = defineProps({
  service: {
    type: Object,
    required: true
  }
})

const getGradientClass = (gradient) => {
  const map = {
    'from-primary to-coral': 'gradient-primary-coral',
    'from-secondary to-accent': 'gradient-secondary-accent',
    'from-accent to-coral': 'gradient-accent-coral',
    'from-coral to-primary': 'gradient-coral-primary',
    'from-primary to-secondary': 'gradient-primary-secondary',
    'from-secondary to-primary': 'gradient-secondary-primary'
  }
  const result = map[gradient] || 'gradient-primary-coral'
  console.log(`Gradient: "${gradient}" => ${result}`)
  return result
}

const getBorderClass = (border) => {
  const map = {
    'border-primary': 'border-t-primary',
    'border-secondary': 'border-t-secondary',
    'border-accent': 'border-t-accent',
    'border-coral': 'border-t-coral'
  }
  return map[border] || 'border-t-primary'
}

const getLinkClass = (link) => {
  const map = {
    'text-primary': 'link-primary',
    'text-secondary': 'link-secondary',
    'text-accent': 'link-accent',
    'text-coral': 'link-coral'
  }
  return map[link] || 'link-primary'
}
</script>
