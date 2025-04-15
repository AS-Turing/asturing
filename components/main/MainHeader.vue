<script setup lang="ts">
const colorMode = useColorMode()

</script>
<template>
  <header class="flex items-center justify-between px-6 py-4 border-b bg-white dark:bg-gray-900">
    <!-- Logo -->
    <div class="text-2xl font-bold text-primary jetbrains-mono-800">&lt; AS-Turing /&gt;</div>

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
            class="absolute left-0 mt-2 w-40 rounded-md bg-white dark:bg-gray-800 shadow-lg p-2 space-y-2 text-sm z-50
                 opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition"
        >
          <NuxtLink to="/services/audit" class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">Audit</NuxtLink>
          <NuxtLink to="/services/formation" class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">Formation</NuxtLink>
          <NuxtLink to="/services/dev" class="block px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">Développement</NuxtLink>
        </div>
      </div>
      <NuxtLink to="/about" class="text-sm font-medium hover:underline">À propos</NuxtLink>
      <NuxtLink to="/contact" class="text-sm font-medium hover:underline">Contact</NuxtLink>
    </nav>
    <!-- Toggle thème -->
    <button
        @click="colorMode.preference = colorMode.preference === 'dark' ? 'light' : 'dark'"
        class="p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800 transition"
        aria-label="Changer le thème"
    >
      <span v-if="colorMode.preference === 'dark'">🌞</span>
      <span v-else>🌙</span></button>
    <!-- Menu mobile (icône) -->
    <button class="md:hidden p-2">
      <span class="sr-only">Ouvrir le menu</span>
      <!-- Remplace par une icône si tu veux -->
      ☰
    </button>
  </header>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');
.jetbrains-mono-800 {
  font-family: "Fira Code", monospace;
}
</style>