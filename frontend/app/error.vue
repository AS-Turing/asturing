<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-950 px-4">
    <div class="max-w-2xl w-full text-center">
      <!-- Illustration -->
      <div class="mb-8">
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-primary to-secondary text-white text-4xl font-bold">
          404
        </div>
      </div>

      <!-- Title -->
      <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
        Page introuvable
      </h1>

      <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">
        Désolé, la page que vous cherchez n'existe pas ou a été déplacée.
      </p>

      <!-- Suggestions -->
      <div class="mb-8">
        <p class="text-gray-700 dark:text-gray-300 mb-4 font-semibold">
          Peut-être cherchiez-vous :
        </p>
        <div class="flex flex-wrap gap-3 justify-center">
          <NuxtLink
            to="/"
            class="px-6 py-3 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-all text-gray-700 dark:text-gray-300 hover:text-primary"
          >
            <Icon name="mdi:home" class="inline mr-2" />
            Accueil
          </NuxtLink>
          <NuxtLink
            to="/projets"
            class="px-6 py-3 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-all text-gray-700 dark:text-gray-300 hover:text-primary"
          >
            <Icon name="mdi:folder-open" class="inline mr-2" />
            Nos projets
          </NuxtLink>
          <NuxtLink
            to="/blog"
            class="px-6 py-3 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-all text-gray-700 dark:text-gray-300 hover:text-primary"
          >
            <Icon name="mdi:post" class="inline mr-2" />
            Blog
          </NuxtLink>
          <NuxtLink
            to="/contact"
            class="px-6 py-3 bg-gradient-to-br from-primary to-secondary text-white rounded-lg shadow hover:shadow-xl transition-all"
          >
            <Icon name="mdi:email" class="inline mr-2" />
            Contact
          </NuxtLink>
        </div>
      </div>

      <!-- Search suggestion -->
      <div class="text-sm text-gray-500 dark:text-gray-500">
        <p>
          Besoin d'aide ? 
          <NuxtLink to="/contact" class="text-primary hover:underline">Contactez-nous</NuxtLink>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
const error = useError()

// SEO pour page 404 (important pour éviter duplicate content)
useSeoMeta({
  title: 'Page introuvable (404)',
  description: 'La page que vous cherchez n\'existe pas. Découvrez nos services de création de sites internet à Libourne.',
  robots: 'noindex, follow' // Important : noindex pour éviter indexation des 404
})

useHead({
  link: [
    { rel: 'canonical', href: 'https://www.as-turing.fr/' } // Canonical vers home
  ]
})

// Définir le status code 404
setResponseStatus(error.value?.statusCode || 404)
</script>
