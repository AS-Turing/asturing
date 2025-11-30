<template>
  <div class="min-h-screen">
    <!-- Hero -->
    <section class="relative py-32 px-4 overflow-hidden bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)]">
      <div class="absolute inset-0 opacity-20">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl animate-float-delayed"></div>
      </div>

      <div class="max-w-5xl mx-auto text-center relative z-10">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white/90 text-sm font-semibold mb-8">
          <Icon name="mdi:chart-timeline-variant" class="w-5 h-5" />
          <span>Notre Approche</span>
        </div>

        <h1 class="text-5xl md:text-7xl font-heading font-bold text-white mb-8 leading-tight">
          Notre Méthodologie
        </h1>
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed">
          Un processus éprouvé, transparent et collaboratif pour garantir la réussite de vos projets digitaux
        </p>
      </div>
    </section>

    <!-- Process -->
    <section class="py-24 px-4 bg-white dark:bg-gray-900 transition-colors">
      <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
            Notre Processus en 5 Étapes
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            De l'idée à la mise en ligne, un accompagnement structuré et agile
          </p>
        </div>

        <div class="relative">
          <div class="absolute left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-[var(--color-primary)] via-[var(--color-secondary)] to-[var(--color-coral)] transform -translate-x-1/2 hidden md:block"></div>

          <div class="space-y-16">
            <div v-for="(step, index) in processSteps" :key="index" class="relative flex flex-col md:flex-row gap-8 items-center" :class="{ 'md:flex-row-reverse': index % 2 === 1 }">
              <div class="flex-shrink-0 relative z-10">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[var(--color-primary)] to-[var(--color-secondary)] flex items-center justify-center shadow-2xl">
                  <span class="text-white text-3xl font-bold">{{ index + 1 }}</span>
                </div>
              </div>

              <div class="flex-1 w-full md:w-auto">
                <div class="bg-gray-50 dark:bg-gray-800 rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all">
                  <div class="flex items-start gap-4 mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[var(--color-primary)]/10 to-[var(--color-secondary)]/10 flex items-center justify-center flex-shrink-0">
                      <Icon :name="step.icon" class="w-7 h-7 text-[var(--color-primary)]" />
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

    <!-- Values -->
    <section class="py-24 px-4 bg-gray-50 dark:bg-gray-800 transition-colors">
      <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
          <h2 class="text-4xl md:text-5xl font-heading font-bold text-gray-900 dark:text-white mb-4">
            Nos Engagements
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            Les valeurs qui guident notre travail au quotidien
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="(value, index) in values" :key="index" class="bg-white dark:bg-gray-900 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 relative overflow-hidden group">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-secondary)]"></div>

            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[var(--color-primary)]/10 to-[var(--color-secondary)]/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <Icon :name="value.icon" class="w-8 h-8 text-[var(--color-primary)]" />
            </div>

            <h3 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">{{ value.title }}</h3>
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ value.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <ServiceCTA />
  </div>
</template>

<script setup lang="ts">
const processSteps = [
  {
    icon: 'mdi:compass',
    title: 'Découverte & Cadrage',
    duration: '1-2 semaines',
    description: 'Nous commençons par comprendre en profondeur votre activité, vos objectifs et vos contraintes. Ateliers de cadrage, analyse de l\'existant, définition du périmètre.',
    deliverables: ['Cahier des charges détaillé', 'Architecture technique', 'Estimation budget & planning', 'Maquettes fonctionnelles']
  },
  {
    icon: 'mdi:palette',
    title: 'Design & Prototypage',
    duration: '2-3 semaines',
    description: 'Conception de l\'expérience utilisateur (UX) et de l\'interface (UI). Création de prototypes interactifs que vous validez avant de passer au développement.',
    deliverables: ['Maquettes haute-fidélité', 'Prototype cliquable', 'Charte graphique', 'Guide de style']
  },
  {
    icon: 'mdi:code-braces',
    title: 'Développement Agile',
    duration: '4-12 semaines',
    description: 'Développement par sprints de 2 semaines avec démonstrations régulières. Vous suivez l\'avancement en temps réel et validez chaque fonctionnalité.',
    deliverables: ['Code source versionné', 'Démos toutes les 2 semaines', 'Documentation technique', 'Environnement de préproduction']
  },
  {
    icon: 'mdi:test-tube',
    title: 'Tests & Optimisation',
    duration: '1-2 semaines',
    description: 'Tests approfondis : fonctionnels, performances, sécurité, compatibilité multi-navigateurs et mobile. Optimisation SEO et accessibilité.',
    deliverables: ['Rapport de tests complets', 'Corrections de bugs', 'Optimisation performances', 'Documentation utilisateur']
  },
  {
    icon: 'mdi:rocket-launch',
    title: 'Mise en ligne & Suivi',
    duration: '1 semaine',
    description: 'Déploiement sécurisé en production, formation de vos équipes, et suivi post-lancement. Nous restons disponibles pour vous accompagner.',
    deliverables: ['Site en production', 'Formation utilisateurs', 'Documentation complète', 'Support 1 mois offert']
  }
]

const values = [
  {
    icon: 'mdi:handshake',
    title: 'Transparence Totale',
    description: 'Vous avez accès en temps réel à l\'avancement du projet. Pas de surprises, pas de jargon incompréhensible. On vous explique tout clairement.'
  },
  {
    icon: 'mdi:account-group',
    title: 'Collaboration Active',
    description: 'Votre projet, c\'est VOTRE projet. Nous co-construisons ensemble, vous validez chaque étape, et votre feedback fait évoluer le produit.'
  },
  {
    icon: 'mdi:quality-high',
    title: 'Qualité Premium',
    description: 'Code propre, sécurisé et maintenable. Tests rigoureux, respect des standards web, performances optimales. Pas de compromis sur la qualité.'
  },
  {
    icon: 'mdi:rocket',
    title: 'Livraison Continue',
    description: 'Pas besoin d\'attendre 6 mois pour voir quelque chose. Avec notre approche agile, vous voyez des résultats concrets toutes les 2 semaines.'
  },
  {
    icon: 'mdi:school',
    title: 'Transmission de Savoir',
    description: 'On ne vous laisse pas seul après la livraison. Formation complète, documentation claire, et on vous rend autonome sur votre outil.'
  },
  {
    icon: 'mdi:shield-check',
    title: 'Engagement Long Terme',
    description: 'On ne disparaît pas après le projet. Support, maintenance, évolutions... On reste votre partenaire tech sur la durée.'
  }
]
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
