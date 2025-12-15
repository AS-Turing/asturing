<template>
  <section class="py-20 bg-white dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <div>
          <div class="inline-block mb-4">
            <span class="bg-accent/10 dark:bg-accent/20 text-accent px-4 py-2 rounded-full text-sm font-semibold">
              Nos atouts
            </span>
          </div>
          <h2 class="text-4xl md:text-5xl font-bold text-dark dark:text-white mb-6">
            Ce qui fait la différence AS-Turing
          </h2>
          <div class="space-y-6">
            <div 
              v-for="advantage in advantages" 
              :key="advantage.title"
              class="flex items-start bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 group"
            >
              <div 
                class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center mr-4 gradient-hero group-hover:scale-110 transition-transform"
                :class="advantage.iconGradient"
              >
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
              </div>
              <div>
                <h3 class="text-xl font-bold text-dark dark:text-white mb-2">
                  {{ advantage.title }}
                </h3>
                <p class="text-gray-600 dark:text-gray-300">
                  {{ advantage.description }}
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="relative">
          <div class="absolute inset-0 gradient-hero rounded-3xl blur-3xl opacity-20"></div>
          <div class="relative bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-2xl">
            <div class="h-96 rounded-2xl overflow-hidden">
              <img 
                src="/images/workspace-desk-minimal.jpg" 
                alt="Workspace professionnel AS-Turing" 
                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
const workspaceImage = '/images/workspace-desk-minimal.jpg'

const advantages = [
  {
    title: 'Engagement contractuel de réactivité',
    description: 'SLA de 24h sur tickets support, disponibilité 6j/7 et astreinte possible pour projets critiques',
    iconGradient: 'from-primary to-coral'
  },
  {
    title: 'Stack technologique dernière génération',
    description: 'Vue.js 3, Nuxt, Symfony 7, headless CMS et architecture cloud-native pour des applications scalables',
    iconGradient: 'from-secondary to-accent'
  },
  {
    title: 'Accompagnement personnalisé',
    description: 'Écoute, conseil et suivi sur-mesure adapté à votre secteur d\'activité',
    iconGradient: 'from-accent to-coral'
  },
  {
    title: 'Tarifs transparents',
    description: 'Devis détaillés, pas de frais cachés, paiement échelonné possible',
    iconGradient: 'from-coral to-primary'
  },
]
</script>
