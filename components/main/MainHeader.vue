<script setup lang="ts">
import LogoSvg from '~/public/images/logo.svg?raw';
const colorMode = useColorMode()
const mobileMenuOpen = ref(false)

</script>
<template>
  <header
      class="flex text-primary items-center justify-between px-6 py-4 border-b bg-white dark:bg-primary dark:text-white sticky top-0 shadow z-50 w-full">
    <button class="md:hidden p-2" @click="mobileMenuOpen = !mobileMenuOpen">
      <span class="sr-only">Ouvrir le menu</span>
      <span v-if="!mobileMenuOpen">☰</span>
      <span v-else>✕</span>
    </button>
    <!-- Menu mobile -->
    <nav
        v-if="mobileMenuOpen"
        class="md:hidden flex flex-col gap-2 absolute top-full left-0 w-full bg-white dark:bg-primary text-primary dark:text-white shadow z-40 px-6 py-4"
    >
      <NuxtLink to="/services" class="font-semibold hover:underline">Services</NuxtLink>
      <div class="ml-4 text-sm space-y-1">
        <NuxtLink @click="mobileMenuOpen = false"
                  to="/services/creation-site-internet"
                  class="block hover:underline"
        >
          Création de site internet
        </NuxtLink>
        <NuxtLink @click="mobileMenuOpen = false"
                  to="/services/conseil-accompagnement-digital"
                  class="block hover:underline"
        >
          Conseil & accompagnement
        </NuxtLink>
        <NuxtLink @click="mobileMenuOpen = false"
                  to="/services/developpement-sur-mesure"
                  class="block hover:underline"
        >
          Développement sur mesure
        </NuxtLink>
        <NuxtLink @click="mobileMenuOpen = false"
                  to="/services/maintenance-support-technique"
                  class="block hover:underline"
        >
          Maintenance & support
        </NuxtLink>
        <NuxtLink @click="mobileMenuOpen = false"
                  to="/services/integration-solutions-externes"
                  class="block hover:underline"
        >
          Intégration de solutions
        </NuxtLink>
        <NuxtLink @click="mobileMenuOpen = false"
                  to="/services/formation-vulgarisation"
                  class="block hover:underline"
        >
          Formation et vulgarisation
        </NuxtLink>
      </div>
      <NuxtLink to="/about" class="hover:underline">À propos</NuxtLink>
      <NuxtLink to="/contact" class="hover:underline">Contact</NuxtLink>
    </nav>
    <!-- Logo -->
    <NuxtLink to="/" class="dark:text-white hover:dark:text-secondary hover:scale-110 transition ease-in-out duration-700">
    <div v-html="LogoSvg" class="fill-current"></div>
    </NuxtLink>

    <!-- Liens navigation -->
    <nav class="hidden md:flex gap-6">
      <!-- Menu déroulant -->
      <div class="relative group">
        <button class="hover:underline inline-flex items-center gap-1">
          <NuxtLink to="/services" class="">Services</NuxtLink>
          <span class="text-xs">▼</span>
        </button>

        <!-- Sous-menu -->
        <div
            class="absolute left-0  w-40 rounded-md bg-white dark:bg-gray-800 shadow-lg p-2 space-y-2 text-sm z-50
                 hidden group-hover:block pointer-events-none group-hover:pointer-events-auto transition"
        >
          <NuxtLink to="/services/creation-site-internet"
                    class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded hover:underline hover:dark:text-secondary">
            Création de site internet
          </NuxtLink>

          <NuxtLink to="/services/conseil-accompagnement-digital"
                    class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded hover:underline hover:dark:text-secondary">
            Conseil & accompagnement digital
          </NuxtLink>

          <NuxtLink to="/services/developpement-sur-mesure"
                    class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded hover:underline hover:dark:text-secondary">
            Développement sur mesure
          </NuxtLink>

          <NuxtLink to="/services/maintenance-support-technique"
                    class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded hover:underline hover:dark:text-secondary">
            Maintenance & support technique
          </NuxtLink>

          <NuxtLink to="/services/integration-solutions-externes"
                    class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded hover:underline hover:dark:text-secondary">
            Intégration de solutions externes
          </NuxtLink>

          <NuxtLink to="/services/formation-vulgarisation"
                    class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded hover:underline hover:dark:text-secondary">
            Formation et vulgarisation
          </NuxtLink>
        </div>
      </div>
      <NuxtLink to="/about" class="text-sm font-medium hover:underline hover:dark:text-secondary">À propos</NuxtLink>
      <NuxtLink to="/contact" class="text-sm font-medium hover:underline hover:dark:text-secondary">Contact</NuxtLink>
    </nav>
    <!-- Toggle thème -->
    <button
        @click="colorMode.preference = colorMode.preference === 'dark' ? 'light' : 'dark'"
        class="p-2 rounded  hover:bg-gray-100 dark:hover:bg-gray-800 transition"
        aria-label="Changer le thème"
    >
      <Icon :name="colorMode.preference === 'dark' ? 'heroicons:sun' : 'heroicons:moon'" class="w-5 h-5" />

    </button>
    <!-- Menu mobile (icône) -->

  </header>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap');

.jetbrains-mono-800 {
  font-family: "JetBrains Mono", monospace;
  font-optical-sizing: auto;
  font-weight: 800;
  font-style: normal;
}
</style>