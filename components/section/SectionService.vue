<script setup lang="ts">
const items = [
  {
    title: "Création de site internet",
    description: "Voyons ensemble comment créer votre identité numérique.",
    image: "https://placehold.co/600x300"
  },
  {
    title: "Conseil & accompagnement digital",
    description: "Besoin d'aide sur votre site ou besoin d'un avis ? Parlons-en !",
    image: "https://placehold.co/600x300"
  },
  {
    title: "Développement sur mesure",
    description: "Un développement spécifique ? Un algorithme ? Créons le code qui vous convient.",
    image: "https://placehold.co/600x300"
  },
  {
    title: "Maintenance & support technique",
    description: "Besoin de corriger un bug ? Une montée de version de votre site ? Tout est faisable.",
    image: "https://placehold.co/600x300"
  },
  {
    title: "Intégration de solutions externes",
    description: "Vous souhaitez intégrer un nouveau module à votre site ? Voyons si c’est faisable.",
    image: "https://placehold.co/600x300"
  },
  {
    title: "Formation et vulgarisation",
    description: "Vous souhaitez vous sensibiliser au domaine du web ? Prenons rendez-vous.",
    image: "https://placehold.co/600x300"
  }
];
</script>

<template>
  <section class="bg-white dark:bg-gray-900 py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl sm:text-5xl font-bold text-center text-gray-900 dark:text-white mb-12">
        Mes services
      </h2>

      <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <div v-for="(item, index) in items" :key="index"
             class="group rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-950 shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden">
          <img :src="item.image" alt="Illustration service"
               class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" />
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
              {{ item.title }}
            </h3>
            <p class="text-gray-600 dark:text-gray-400 text-base leading-relaxed">
              {{ item.description }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
