<script setup lang="ts">
const items = [
  {
    title: "Création de site internet",
    description: "Voyons ensemble comment créer votre identité numérique.",
    image: "https://placehold.co/100x55"
  },
  {
    title: "Conseil & accompagnement digital",
    description: "Besoin d'aide sur votre site ou besoin d'un avis ? Parlons-en !",
    image: "https://placehold.co/100x55"
  },
  {
    title: "Développement sur mesure",
    description: "Un développement spécifique ? Un algorithme ? Créons le code qui vous convient",
    image: "https://placehold.co/100x55"
  },
  {
    title: "Maintenance & support technique",
    description: "Besoin de corriger un bug ? Une monté de version de votre site ? Tout est faisable",
    image: "https://placehold.co/100x55"
  },
  {
    title: "Intégration de solutions externes",
    description: "Vous souhaité intégrer un nouveau module à votre site ? Voyons si son intégration est faisable.",
    image: "https://placehold.co/100x55"
  },
  {
    title: "Formation et vulgarisation",
    description: "Vous souhaitez vous sensibiliser au domaine du web ? Prenons un rendez-vous.",
    image: "https://placehold.co/100x55"
  }
];</script>

<template>
  <section class="bg-white dark:bg-gray-900 min-h-[60vh] py-12">
    <h2 class="mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-back text-center">
      Mes services
    </h2>
    <div class="flex gap-4 flex-wrap justify-around items-center py-4 px-6 lg:px-8">
      <div v-for="(item, index) in items" :key="index" class="max-w-sm mb-4 rounded overflow-hidden shadow-lg">
        <img class="w-full" :src="item.image" alt="Sunset in the mountains">
        <div class="px-6 py-4">
          <div class="font-bold text-xl mb-2">{{ item.title }}</div>
          <p class="text-gray-700 text-base min-h-24">
            {{ item.description }}
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>

</style>