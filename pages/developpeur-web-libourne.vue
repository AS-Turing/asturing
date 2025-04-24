<template>
  <div class="px-4 py-10 sm:px-10 max-w-5xl mx-auto space-y-12 text-primary dark:text-white">
    <h1 class="text-4xl font-bold ">Développeur Web à Libourne</h1>
    <p class="text-lg">
      Vous êtes une entreprise, une association ou un indépendant basé à Libourne ? Je vous accompagne dans la création ou la refonte de votre site web. Performance, design, référencement local : faisons rayonner votre activité en ligne.
    </p>

    <section>
      <h2 class="text-2xl font-semibold mb-4">Ce que je vous propose</h2>
      <ul class="list-disc list-inside   space-y-2">
        <li>Sites vitrines performants avec NuxtJS</li>
        <li>Design responsive (mobile/tablette)</li>
        <li>Optimisation du référencement local (Google My Business, balises SEO...)</li>
        <li>Formation à l'utilisation du site</li>
        <li>Maintenance technique en option</li>
      </ul>
    </section>

    <section>
      <h2 class="text-2xl font-semibold mb-4">Formules</h2>
      <div class="grid sm:grid-cols-2 gap-6">
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
      </div>
    </section>

    <section>
      <h2 class="text-2xl font-semibold mb-4">Pourquoi Libourne ?</h2>
      <p class="">
        Basé en Nouvelle-Aquitaine, je connais bien les enjeux numériques des entreprises locales. Je privilégie les échanges simples, humains, et surtout efficaces.
      </p>
    </section>

    <div class="text-center mt-12">
      <NuxtLink
          to="/contact"
          class="bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-secondary transition"
      >
        Me contacter
      </NuxtLink>
    </div>
  </div>
</template>

<script setup lang="ts">
useSeoMeta({
  title: 'Développeur Web Freelance à Libourne | Création de site internet & SEO | AS-Turing',
  description: 'Développeur web à Libourne : création de sites internet vitrine sur mesure, optimisation SEO local, accompagnement digital pour PME, artisans et indépendants.',
  ogTitle: 'Création de Site Internet à Libourne | Développeur Web Freelance | AS-Turing',
  ogDescription: 'AS-Turing, freelance spécialisé NuxtJS à Libourne, conçoit des sites internet rapides, modernes et bien référencés. Devis gratuit, services adaptés aux pros.',
  ogUrl: 'https://www.as-turing.fr/developpeur-web-libourne',
  ogImage: 'https://www.as-turing.fr/images/og-as-turing.jpg',
  twitterCard: 'summary_large_image',
})

</script>
