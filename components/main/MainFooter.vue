<script setup lang="ts">
import LogoSvg from '~/public/images/logo.svg?raw';
</script>

<template>
  <footer class="pt-16 px-4 md:px-8 bg-white dark:bg-primary text-primary dark:text-white border-t">
    <!-- Conteneur principal -->
    <div class="max-w-7xl mx-auto flex flex-col items-center md:items-start md:justify-between md:flex-row gap-12 md:gap-8">

      <!-- Logo -->
      <div class=" flex md:justify-start">
        <NuxtLink to="/" class="dark:text-white hover:dark:text-secondary hover:scale-110 transition ease-in-out duration-700">
          <div v-html="LogoSvg" class="w-full flex justify-center h-auto fill-current transform:scale-125"></div>
        </NuxtLink>
      </div>

      <!-- Navigation -->
      <div class="w-3/4 flex flex-col items-center md:items-start text-center md:text-left space-y-4">
        <ul class="space-y-2 flex flex-col md:flex-row  w-full">
          <li class="relative group mt-2 lg:w-4/12">
            <NuxtLink to="/services" class="hover:underline font-medium block pl-2 hover:dark:text-secondary">Services</NuxtLink>
            <ul class="mt-1 space-y-1 text-sm ggroup-hover:block">
              <li>
                <NuxtLink to="/services/creation-site-internet"
                          class="block px-2 py-1 rounded hover:underline hover:dark:text-secondary">
                  Création de site internet
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/services/conseil-accompagnement-digital"
                          class="block px-2 py-1 rounded hover:underline hover:dark:text-secondary">
                  Conseil & accompagnement digital
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/services/developpement-sur-mesure"
                          class="block px-2 py-1 rounded hover:underline hover:dark:text-secondary">
                  Développement sur mesure
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/services/maintenance-support-technique"
                          class="block px-2 py-1 rounded hover:underline hover:dark:text-secondary">
                  Maintenance & support technique
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/services/integration-solutions-externes"
                          class="block px-2 py-1 rounded hover:underline hover:dark:text-secondary">
                  Intégration de solutions externes
                </NuxtLink>
              </li>
              <li>
                <NuxtLink to="/services/formation-vulgarisation"
                          class="block px-2 py-1 rounded hover:underline hover:dark:text-secondary">
                  Formation et vulgarisation
                </NuxtLink>
              </li>
            </ul>
          </li>
          <li class="lg:w-4/12 text-center">
            <NuxtLink to="/about" class="hover:underline font-medium hover:dark:text-secondary">
              À propos
            </NuxtLink>
          </li>
          <li class="lg:w-4/12 text-center">
            <NuxtLink to="/contact" class="hover:underline font-medium hover:dark:text-secondary">
              Contact
            </NuxtLink>
          </li>
          <li class="lg:w-4/12 text-center">
            <p>
              <NuxtLink to="/conditions-generales-de-ventes"
                       class="hover:underline font-medium hover:dark:text-secondary">
              Conditions générales de ventes
            </NuxtLink>
            </p>
            <p>
            <NuxtLink to="/engagements" class="hover:underline font-medium hover:dark:text-secondary">
              La charte d'engagement d'AS-Turing
            </NuxtLink>
            </p>
          </li>

        </ul>
      </div>

      <!-- Réseaux sociaux -->
      <div class="flex flex-col items-center md:items-end space-y-4 text-center md:text-right">
        <h2 class="text-xl font-semibold">Suivez-moi</h2>
        <div class="flex gap-6 justify-center md:justify-end">
          <NuxtLink to="https://github.com/Chadowww" aria-label="GitHub" class="hover:text-secondary">
            <Icon name="mdi:github" class="w-12 h-12" />
          </NuxtLink>
          <NuxtLink to="https://www.linkedin.com/in/alexandresale/" aria-label="LinkedIn" class="hover:text-secondary">
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
