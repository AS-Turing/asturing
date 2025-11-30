<template>
  <section class="py-20 bg-white dark:bg-dark transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- En-tête section -->
      <div class="text-center mb-16">
        <span class="inline-block px-4 py-2 bg-secondary/10 dark:bg-secondary/20 text-secondary rounded-full text-sm font-semibold mb-4">
          Notre Méthode
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-dark dark:text-white mb-6">
          Un processus agile et transparent
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
          De l'idée à la mise en ligne, nous vous accompagnons à chaque étape avec une méthodologie éprouvée.
        </p>
      </div>

      <!-- Timeline -->
      <div class="relative">
        <!-- Ligne centrale -->
        <div class="absolute left-1/2 top-0 bottom-0 w-1 gradient-bar transform -translate-x-1/2 hidden md:block"></div>

        <!-- Steps -->
        <div class="space-y-12">
          <div 
            v-for="(step, index) in processSteps" 
            :key="index"
            class="relative grid md:grid-cols-2 gap-8 items-center"
          >
            <!-- Card (alterne gauche/droite) -->
            <div 
              class="w-full md:w-10/12"
              :class="index % 2 === 0 ? 'md:pr-12 md:text-right' : 'md:pl-12 md:order-2'"
            >
              <div class="bg-gray-50 dark:bg-gray-800 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 group">
                <!-- Icon -->
                <div 
                  class="inline-flex w-16 h-16 rounded-xl items-center justify-center mb-4 gradient-hero group-hover:scale-110 transition-transform"
                  :class="step.iconGradient"
                >
                  <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="step.icon" />
                  </svg>
                </div>
                
                <h3 class="text-2xl font-bold text-dark dark:text-white mb-3">
                  {{ index + 1 }}. {{ step.title }}
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                  {{ step.description }}
                </p>
                <div 
                  class="text-sm font-semibold"
                  :class="step.durationColor"
                >
                  ⏱ {{ step.duration }}
                </div>
              </div>
            </div>

            <!-- Center badge -->
            <div 
              class="absolute left-1/2 w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-2xl transform -translate-x-1/2 hidden md:flex gradient-hero"
              :class="step.badgeGradient"
            >
              {{ index + 1 }}
            </div>

            <!-- Empty space for alternating layout -->
            <div 
              class="w-full md:w-10/12"
              :class="index % 2 === 0 ? 'md:pl-12' : 'md:pr-12'"
            ></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
const processSteps = [
  {
    icon: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
    iconGradient: 'from-primary to-coral',
    title: 'Écoute & Analyse',
    description: 'Compréhension approfondie de vos besoins, objectifs et contraintes. Audit de l\'existant si besoin.',
    duration: '2-3 jours',
    durationColor: 'text-primary dark:text-primary',
    badgeGradient: 'from-primary to-coral'
  },
  {
    icon: 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01',
    iconGradient: 'from-coral to-accent',
    title: 'Conception & Devis',
    description: 'Proposition technique détaillée, maquettes si nécessaire, devis transparent avec paiement échelonné.',
    duration: '2-5 jours',
    durationColor: 'text-coral dark:text-coral',
    badgeGradient: 'from-coral to-accent'
  },
  {
    icon: 'M13 10V3L4 14h7v7l9-11h-7z',
    iconGradient: 'from-accent to-secondary',
    title: 'Développement Agile',
    description: 'Itérations rapides, démos régulières, feedback continu. Vous suivez l\'avancement en temps réel.',
    duration: '2-6 semaines selon projet',
    durationColor: 'text-accent dark:text-accent',
    badgeGradient: 'from-accent to-secondary'
  },
  {
    icon: 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
    iconGradient: 'from-secondary to-primary',
    title: 'Livraison & Suivi',
    description: 'Formation complète, documentation, déploiement sécurisé. Support post-lancement inclus.',
    duration: 'Support 30 jours inclus',
    durationColor: 'text-secondary dark:text-secondary',
    badgeGradient: 'from-secondary to-primary'
  },
]
</script>
