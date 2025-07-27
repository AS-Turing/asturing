<script setup lang="ts">
import { useSeoMeta } from 'nuxt/app'
import { Localisation } from '../../types/localisation'

const props = defineProps<{
  data: Localisation
}>()

useSeoMeta({
  title: props.data.title,
  description: props.data.description,
  ogTitle: props.data.ogTitle,
  ogDescription: props.data.ogDescription,
  ogUrl: props.data.ogUrl,
})
</script>

<template>
  <div class="px-4 py-10 sm:px-10 max-w-5xl mx-auto space-y-12 text-primary dark:text-white">
    <h1 class="text-4xl font-bold ">Création site internet à {{ props.data.ville }}</h1>
    <p class="text-lg">{{props.data.description}}</p>

    <section>
      <h2 class="text-2xl font-semibold mb-4">Ce que je vous propose</h2>
      <ul class="list-disc list-inside   space-y-2">
        <li>Création de vos site, Wordpress, Nuxt, Prestashop.</li>
        <li>Design responsive (mobile/tablette)</li>
        <li>Optimisation du référencement local (Google My Business, balises SEO...)</li>
        <li>Formation à l'utilisation du site</li>
        <li>Maintenance technique en option</li>
      </ul>
    </section>

    <section>
      <h2 class="text-2xl font-semibold mb-4">Formules</h2>
      <div class="grid sm:grid-cols-3 gap-6">
        <div class="border rounded-xl p-4 shadow-sm">
          <h3 class="text-xl font-bold">Pack Essentiel</h3>
          <ul class="list-disc list-inside text-sm mt-2 space-y-1">
            <li>1 à 3 pages</li>
            <li>Référencement local</li>
            <li>Formation incluse</li>
          </ul>
          <p class="mt-4 font-semibold text-secondary">À partir de 690€ TTC</p>
        </div>
        <div class="border rounded-xl p-4 shadow-sm ">
          <h3 class="text-xl font-bold">Pack Standard</h3>
          <ul class="list-disc list-inside text-sm mt-2 space-y-1">
            <li>Site complet jusqu’à 6 pages</li>
            <li>Blog ou section actualité</li>
            <li>SEO avancé</li>
          </ul>
          <p class="mt-4 font-semibold text-secondary">À partir de 1 190€ TTC</p>
        </div>
        <div class="border rounded-xl p-4 shadow-sm ">
          <h3 class="text-xl font-bold">Sur mesure</h3>
          <ul class="list-disc list-inside text-sm mt-2 space-y-1">
            <li>Nombre de pages illimité</li>
            <li>Développement spécifique (formulaires avancés, animations...)</li>
            <li>Maintenance 3 mois offerte</li>
          </ul>
          <p class="mt-4 font-semibold text-secondary">À partir de 1 190€ TTC</p>
        </div>
      </div>
    </section>
    <section class="flex justify-center">
      <iframe
        :src="props.data.map"
        width="600"
        height="450"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
      ></iframe>
    </section>

    <section>
      <h2 class="text-2xl font-semibold mb-4">Pourquoi {{ props.data.ville }} ?</h2>
      <p class="">
        Basé en Nouvelle-Aquitaine, je connais bien les enjeux numériques des entreprises locales. Je privilégie les échanges simples, humains, et surtout efficaces.
      </p>
    </section>

    <div class="text-center mt-12">
      <NuxtLink
        to="/contact"
        class="group inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center border rounded-lg
             text-secondary bg-primary hover:text-primary hover:bg-secondary border-secondary hover:border-primary
             dark:text-primary dark:bg-secondary dark:hover:text-secondary dark:hover:bg-primary dark:border-gray-700    dark:focus:ring-gray-800
             hover:scale-105 transition-all duration-700 ease-in-out transform focus:ring-4 focus:ring-gray-100 hover:cursor-pointer"
      >
        <Icon name="lucide:mail"
              class="w-5 h-5 transition-all duration-700 group-hover:scale-110 group-hover:rotate-12" />
        <span class="ml-2 transition-all duration-700 group-hover:translate-x-1  font-bold">
          Me contacter
        </span>
      </NuxtLink>
    </div>
  </div>
</template>
