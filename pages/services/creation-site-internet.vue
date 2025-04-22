<template>
  <ServiceLayout :service="service!" />
<!--  <section class="max-w-4xl mx-auto px-4 py-16">-->
<!--    <h1 class="text-4xl font-bold text-primary mb-4">Création de site internet</h1>-->
<!--    <p class="text-lg text-gray-600 dark:text-gray-300 mb-10">-->
<!--      Un site à votre image, rapide, élégant et optimisé, pour donner à votre projet digital la visibilité qu’il mérite.-->
<!--    </p>-->

<!--    <div class="space-y-4 mb-10">-->
<!--      <h2 class="text-2xl font-semibold">Ce que comprend le service :</h2>-->
<!--      <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">-->
<!--        <li>Conception UX/UI avec maquettes sur mesure</li>-->
<!--        <li>Intégration responsive (mobile, tablette, desktop)</li>-->
<!--        <li>Optimisation SEO technique (balises, performance)</li>-->
<!--        <li>Installation sur votre hébergement (OVH, o2switch…)</li>-->
<!--        <li>Formation à la prise en main de votre site</li>-->
<!--      </ul>-->
<!--    </div>-->

<!--    <div class="mb-10">-->
<!--      <h2 class="text-2xl font-semibold mb-4">Grille tarifaire</h2>-->
<!--      <table class="w-full table-auto border-collapse border border-gray-200 dark:border-gray-700">-->
<!--        <thead>-->
<!--        <tr class="bg-gray-100 dark:bg-gray-800">-->
<!--          <th class="border p-3 text-left">Formule</th>-->
<!--          <th class="border p-3 text-left">Ce qui est inclus</th>-->
<!--          <th class="border p-3 text-left">Tarif TTC</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        <tr>-->
<!--          <td class="border p-3">Essentielle</td>-->
<!--          <td class="border p-3">1 à 3 pages (Accueil + Contact + À propos), formulaire, design simple</td>-->
<!--          <td class="border p-3 font-bold text-green-600">800 €</td>-->
<!--        </tr>-->
<!--        <tr class="bg-gray-50 dark:bg-gray-900">-->
<!--          <td class="border p-3">Avancée</td>-->
<!--          <td class="border p-3">5 à 10 pages, design personnalisé, SEO initial, formulaire avancé</td>-->
<!--          <td class="border p-3 font-bold text-green-600">1 500 €</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--          <td class="border p-3">Sur mesure</td>-->
<!--          <td class="border p-3">Site unique, animation, CMS intégré, API, fonctionnalités spécifiques</td>-->
<!--          <td class="border p-3 font-bold">Sur devis</td>-->
<!--        </tr>-->
<!--        </tbody>-->
<!--      </table>-->
<!--      <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Délai moyen : 2 à 4 semaines. Paiement possible en 2 ou 3 fois sans frais.</p>-->
<!--    </div>-->

<!--    <div class="mb-10">-->
<!--      <h2 class="text-2xl font-semibold mb-2">FAQ</h2>-->
<!--      <div class="space-y-4">-->
<!--        <div>-->
<!--          <h3 class="font-semibold">Est-ce que vous fournissez les textes ?</h3>-->
<!--          <p class="text-gray-700 dark:text-gray-300">Non, mais je peux vous recommander un rédacteur partenaire, ou vous aider à structurer votre contenu.</p>-->
<!--        </div>-->
<!--        <div>-->
<!--          <h3 class="font-semibold">Est-ce que vous vous occupez du nom de domaine et de l’hébergement ?</h3>-->
<!--          <p class="text-gray-700 dark:text-gray-300">Oui, je peux vous accompagner dans le choix et la configuration (inclus dans la formule Avancée).</p>-->
<!--        </div>-->
<!--        <div>-->
<!--          <h3 class="font-semibold">Le site sera-t-il évolutif ?</h3>-->
<!--          <p class="text-gray-700 dark:text-gray-300">Tous les sites sont conçus pour être maintenus, améliorés et mis à jour facilement.</p>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

<!--    <div class="text-center">-->
<!--      <NuxtLink to="/contact" class="inline-block bg-primary text-white font-semibold px-6 py-3 rounded-lg shadow hover:bg-secondary transition">-->
<!--        Prendre contact-->
<!--      </NuxtLink>-->
<!--    </div>-->
<!--  </section>-->
</template>

<script setup lang="ts">
import services from '@/data/services/index.ts'
import ServiceLayout from "../../components/service/ServiceLayout.vue";
const service = services.find(s => s.slug === 'creation-site-internet')
</script>

<style scoped>
</style>