<template>
  <section class="py-20 bg-gradient-to-br from-gray-50 to-white dark:from-dark-lighter dark:to-dark transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="text-center mb-16">
        <div class="inline-block mb-4">
          <span class="bg-primary/10 dark:bg-primary/20 text-primary px-4 py-2 rounded-full text-sm font-semibold">
            Notre approche
          </span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-dark dark:text-white mb-6">
          Des solutions web qui durent
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto mb-8">
          Parce que votre projet mérite mieux qu'un template WordPress et un hébergement Ionos
        </p>
        
        <!-- Texte de présentation -->
        <div class="max-w-4xl mx-auto mt-12 mb-16">
          <div class="bg-white dark:bg-dark rounded-3xl p-8 md:p-12 shadow-lg border border-gray-100 dark:border-gray-800">
            <p class="text-2xl md:text-3xl font-bold text-dark dark:text-white mb-6 leading-relaxed">
              Le web artisanal a encore du sens.
            </p>
            <div class="space-y-4 text-lg text-gray-600 dark:text-gray-400 text-left">
              <p>
                Dans un monde de templates WordPress à 50€ et d'hébergements mutualisés surchargés, AS Turing fait le choix de l'excellence technique. Développement from scratch, serveurs dédiés configurés à la main, code propre et maintenable.
              </p>
              <p>
                Nous sommes une petite structure, et c'est notre force : proximité, réactivité, implication totale dans chaque projet. Pas d'intermédiaires, pas de bullshit commercial, juste du code de qualité et un accompagnement humain.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- 3 Piliers -->
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Pilier 1: Expertise -->
        <div class="group relative bg-white dark:bg-dark rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <div class="mb-6">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-primary to-secondary flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
              <!-- Icon Code -->
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
              </svg>
            </div>
          </div>
          <h3 class="text-2xl font-bold text-dark dark:text-white mb-4">
            Expertise Full-Stack
          </h3>
          <ul class="space-y-3 text-gray-600 dark:text-gray-400">
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <span>Développement sur-mesure (Symfony, React, Docker)</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <span>Pas de solutions génériques</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <span>Code maintenable et évolutif</span>
            </li>
          </ul>
        </div>

        <!-- Pilier 2: Infrastructure -->
        <div class="group relative bg-white dark:bg-dark rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <div class="mb-6">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-secondary to-primary flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
              <!-- Icon Server -->
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
              </svg>
            </div>
          </div>
          <h3 class="text-2xl font-bold text-dark dark:text-white mb-4">
            Infrastructure maîtrisée
          </h3>
          <ul class="space-y-3 text-gray-600 dark:text-gray-400">
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <span>Serveurs configurés from scratch</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <span>CI/CD automatisé</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <span>Sauvegardes et monitoring inclus</span>
            </li>
          </ul>
        </div>

        <!-- Pilier 3: Accompagnement -->
        <div class="group relative bg-white dark:bg-dark rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          <div class="mb-6">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-coral to-primary flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
              <!-- Icon Users -->
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div>
          </div>
          <h3 class="text-2xl font-bold text-dark dark:text-white mb-4">
            Accompagnement long terme
          </h3>
          <ul class="space-y-3 text-gray-600 dark:text-gray-400">
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <span>Formation à l'autonomie</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <span>Support technique réactif</span>
            </li>
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 text-primary flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              <span>Évolution du projet avec vous</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
// Pas de props nécessaires, contenu statique
</script>
