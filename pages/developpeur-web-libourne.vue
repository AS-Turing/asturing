<template>
  <div class="px-4 py-10 sm:px-10 max-w-5xl mx-auto space-y-12">
    <h1 class="text-4xl font-bold text-primary">Développeur Web à Libourne</h1>
    <p class="text-lg text-gray-600 dark:text-gray-300">
      Vous êtes une entreprise, une association ou un indépendant basé à Libourne ? Je vous accompagne dans la création ou la refonte de votre site web. Performance, design, référencement local : faisons rayonner votre activité en ligne.
    </p>

    <section>
      <h2 class="text-2xl font-semibold mb-4">✅ Ce que je vous propose</h2>
      <ul class="list-disc list-inside text-gray-700 dark:text-gray-200 space-y-2">
        <li>Sites vitrines performants avec NuxtJS</li>
        <li>Design responsive (mobile/tablette)</li>
        <li>Optimisation du référencement local (Google My Business, balises SEO...)</li>
        <li>Formation à l'utilisation du site</li>
        <li>Maintenance technique en option</li>
      </ul>
    </section>

    <section>
      <h2 class="text-2xl font-semibold mb-4">💸 Tarifs</h2>
      <div class="grid sm:grid-cols-2 gap-6">
        <div class="border rounded-xl p-4 shadow-sm bg-white dark:bg-gray-900">
          <h3 class="text-xl font-bold">Pack Vitrine</h3>
          <ul class="list-disc list-inside text-sm mt-2 space-y-1">
            <li>1 à 3 pages</li>
            <li>Référencement local</li>
            <li>Formation incluse</li>
          </ul>
          <p class="mt-4 font-semibold text-primary">À partir de 690€ TTC</p>
        </div>
        <div class="border rounded-xl p-4 shadow-sm bg-white dark:bg-gray-900">
          <h3 class="text-xl font-bold">Pack Entreprise</h3>
          <ul class="list-disc list-inside text-sm mt-2 space-y-1">
            <li>Site complet jusqu’à 6 pages</li>
            <li>Blog ou section actualité</li>
            <li>SEO avancé</li>
          </ul>
          <p class="mt-4 font-semibold text-primary">À partir de 1 190€ TTC</p>
        </div>
      </div>
    </section>

    <section>
      <h2 class="text-2xl font-semibold mb-4">📍 Pourquoi Libourne ?</h2>
      <p class="text-gray-700 dark:text-gray-300">
        Basé en Nouvelle-Aquitaine, je connais bien les enjeux numériques des entreprises locales. Je privilégie les échanges simples, humains, et surtout efficaces.
      </p>
    </section>

    <div class="text-center mt-12">
      <NuxtLink
          to="/contact"
          class="bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-secondary transition"
      >
        📩 Me contacter
      </NuxtLink>
    </div>
  </div>
</template>

<script setup lang="ts">
useSeoMeta({
  title: 'Développeur Web à Libourne | Création de site internet | AS-Turing',
  description:
      'Création de site internet sur mesure à Libourne avec AS-Turing. Sites vitrines performants, SEO local, accompagnement personnalisé.',
  ogTitle: 'Développeur Web à Libourne | AS-Turing',
  ogDescription:
      'Création de sites internet performants pour entreprises et indépendants à Libourne. Freelance expert NuxtJS & SEO local.',
  ogUrl: 'https://www.as-turing.fr/developpeur-web-libourne',
})
</script>
