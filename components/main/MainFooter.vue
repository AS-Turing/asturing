<template>
  <footer class="bg-gray-900 text-white py-16 px-4 md:px-8">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
      <!-- Navigation -->
      <div class="space-y-6">
        <h2 class="text-2xl font-semibold">Navigation</h2>
        <ul class="space-y-2">
          <li class="relative group">
            <NuxtLink to="/services" class="hover:underline font-medium">Services</NuxtLink>
            <ul class="ml-4 mt-2 space-y-1 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <li><NuxtLink to="/services/audit" class="hover:underline">Audit</NuxtLink></li>
              <li><NuxtLink to="/services/formation" class="hover:underline">Formation</NuxtLink></li>
              <li><NuxtLink to="/services/dev" class="hover:underline">Développement</NuxtLink></li>
            </ul>
          </li>
          <li><NuxtLink to="/about" class="hover:underline font-medium">À propos</NuxtLink></li>
          <li><NuxtLink to="/contact" class="hover:underline font-medium">Contact</NuxtLink></li>
        </ul>
      </div>

      <!-- Réseaux sociaux -->
      <div class="space-y-6 text-center md:text-right">
        <h2 class="text-2xl font-semibold">Suivez-moi</h2>
        <div class="flex justify-center md:justify-end space-x-6">
          <NuxtLink to="https://github.com/Chadowww" aria-label="GitHub" class="hover:text-indigo-400">
            <Icon name="mdi:github" class="w-6 h-6" />
          </NuxtLink>
          <NuxtLink to="https://www.linkedin.com/in/alexandresale/" aria-label="LinkedIn" class="hover:text-indigo-400">
            <Icon name="mdi:linkedin" class="w-6 h-6" />
          </NuxtLink>
        </div>
      </div>
    </div>

    <!-- Bas de page -->
    <div class="mt-12 text-center text-sm text-gray-400">
      © 2024 AS-Turing. Tous droits réservés.
    </div>
  </footer>
</template>

<script setup lang="ts">
// Tu peux utiliser nuxt-icon ou un autre pack comme lucide ou unimport
</script>
