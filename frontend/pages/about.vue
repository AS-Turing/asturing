<script setup lang="ts">
useSeoMeta({
  title: 'À propos - AS Turing',
  description: 'Découvrez l’histoire, la mission et l’équipe derrière AS Turing.',
  ogUrl: 'https://www.as-turing.fr/about',
  ogTitle: 'À propos de AS-Turing',
  ogDescription: 'Découvrez l’histoire, la mission et l’équipe derrière AS Turing.',
})
</script>

<template>
  <section class="bg-white dark:bg-gray-900 py-16 px-4 sm:px-8">
    <div class="max-w-5xl mx-auto space-y-16">
      <div class="text-center">
        <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4 underline dark:decoration-secondary underline-offset-8">Qui suis-je ?</h1>
        <p class="text-lg text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
          J’ai toujours aimé comprendre comment les choses fonctionnent. D’abord dans l’éducation populaire, puis dans le développement web, j’ai découvert un outil fabuleux pour donner vie à des idées. AS-Turing, c’est un peu le croisement entre cette envie de transmettre, et le plaisir de créer.
        </p>
      </div>

      <div class="space-y-6">
        <h2 class="text-2xl font-semibold text-primary dark:text-white">Mon parcours</h2>
        <ol class="relative border-l border-gray-300 dark:border-gray-700 ml-4">
          <li class="mb-10 ml-6">
            <div class="absolute w-3 h-3 bg-primary rounded-full -left-1.5 border border-white dark:border-gray-900"></div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">🎓 Reconversion 2023</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Formation intensive en développement web, premières bases solides en HTML, CSS, PHP, Symfony, JS …</p>
          </li>
          <li class="mb-10 ml-6">
            <div class="absolute w-3 h-3 bg-primary rounded-full -left-1.5 border border-white dark:border-gray-900"></div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">🧪 Premiers projets freelance 2024</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Création de petits projets web pour associations, amis et clients locaux. Création d’AS-Turing.</p>
          </li>
          <li class="mb-10 ml-6">
            <div class="absolute w-3 h-3 bg-primary rounded-full -left-1.5 border border-white dark:border-gray-900"></div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
              🧭 Développeur Full-Stack chez Motion4Ever 2024-2025
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Une belle aventure à Nantes. Retour à Libourne pour me consacrer pleinement à AS-Turing.</p>
          </li>
          <li class="ml-6">
            <div class="absolute w-3 h-3 bg-primary rounded-full -left-1.5 border border-white dark:border-gray-900"></div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
              🧭 Lancement de l'aventure AS-Turing 2025
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">AS-Turing, ce n’est pas juste une activité freelance,
              c’est maintenant un engagement à rendre le web plus humain, plus accessible, et plus simple pour tous ceux
              qui ont une idée à concrétiser.</p>
          </li>
        </ol>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-6 shadow-sm">
          <h3 class="text-xl font-semibold text-primary dark:text-white mb-2">🧡 Ce que j’aime</h3>
          <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
            <li>Le code propre</li>
            <li>Les projets qui ont du sens</li>
            <li>Les retours clairs</li>
            <li>Les gens curieux</li>
          </ul>
        </div>
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-6 shadow-sm">
          <h3 class="text-xl font-semibold text-primary dark:text-white mb-2">🚫 Moins fan de</h3>
          <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
            <li>Les rushs improvisés</li>
            <li>Le jargon inutile</li>
            <li>L’opacité dans les projets</li>
          </ul>
        </div>
      </div>

      <div class="text-center">
        <h2 class="text-2xl font-semibold text-primary dark:text-white mb-4">Ma vision du web</h2>
        <p class="text-lg text-gray-700 dark:text-gray-300 max-w-3xl mx-auto">
          Le web doit être un levier, pas un frein. Je conçois des outils simples, bien pensés, et surtout bien expliqués. Pas besoin d’être tech pour comprendre son propre site.
        </p>
      </div>

      <div class="text-center">
        <a
          href="/CV_FULL_SATCK_Alexandre_Salé.pdf" download
          class="group inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center border rounded-lg
             text-secondary bg-primary hover:text-primary hover:bg-secondary border-secondary hover:border-primary
             dark:text-primary dark:bg-secondary dark:hover:text-secondary dark:hover:bg-primary dark:border-gray-700    dark:focus:ring-gray-800
             hover:scale-105 transition-all duration-700 ease-in-out transform focus:ring-4 focus:ring-gray-100 hover:cursor-pointer"
        >
          <Icon name="lucide:download"
                class="w-5 h-5 transition-all duration-700 group-hover:scale-110 group-hover:rotate-12" />
          <span class="ml-2 transition-all duration-700 group-hover:translate-x-1  font-bold">
            Télécharger mon CV
          </span>
        </a>
      </div>
    </div>
  </section>
</template>

<style scoped>

</style>