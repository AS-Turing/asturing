<template>
  <footer class="pt-16 px-4 md:px-8 bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
    <!-- Conteneur principal -->
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-12 md:gap-8">

      <!-- Logo -->
      <div class=" flex justify-center items-center md:justify-start">
        <div v-html="LogoSvg" class="w-full flex justify-center h-auto fill-current transform:scale-125"></div>
      </div>

      <!-- Navigation -->
      <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left space-y-4">
        <ul class="space-y-2 flex flex-col md:flex-row  w-full">
          <li class="relative group mt-2 lg:w-4/12">
            <NuxtLink to="/services" class="hover:underline font-medium block pl-2">Services</NuxtLink>
            <ul class="mt-1 space-y-1 text-sm ggroup-hover:block">
              <li>
                <NuxtLink to="/services/creation-site-internet"
                          class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                  Création de site internet
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/services/conseil-accompagnement-digital"
                          class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                  Conseil & accompagnement digital
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/services/developpement-sur-mesure"
                          class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                  Développement sur mesure
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/services/maintenance-support-technique"
                          class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                  Maintenance & support technique
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/services/integration-solutions-externes"
                          class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                  Intégration de solutions externes
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/services/formation-vulgarisation"
                          class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                  Formation et vulgarisation
                </NuxtLink>
              </li>
            </ul>
          </li>
          <li class="lg:w-4/12"><NuxtLink to="/about" class="hover:underline font-medium">À propos</NuxtLink></li>
          <li class="lg:w-4/12"><NuxtLink to="/contact" class="hover:underline font-medium">Contact</NuxtLink></li>
        </ul>
      </div>

      <!-- Réseaux sociaux -->
      <div class="flex flex-col items-center md:items-end space-y-4 text-center md:text-right">
        <h2 class="text-xl font-semibold">Suivez-moi</h2>
        <div class="flex gap-6 justify-center md:justify-end">
          <NuxtLink to="https://github.com/Chadowww" aria-label="GitHub" class="hover:text-indigo-500">
            <Icon name="mdi:github" class="w-12 h-12" />
          </NuxtLink>
          <NuxtLink to="https://www.linkedin.com/in/alexandresale/" aria-label="LinkedIn" class="hover:text-indigo-500">
            <Icon name="mdi:linkedin" class="w-12 h-12" />
          </NuxtLink>
        </div>
      </div>
    </div>

    <!-- Bas de page -->
    <div class="mt-12 text-center text-sm text-gray-500 dark:text-gray-400">
      © 2024 AS-Turing. Tous droits réservés.
    </div>
  </footer>
</template>

<script setup lang="ts">
import LogoSvg from '~/public/images/logo.svg?raw';
</script>
