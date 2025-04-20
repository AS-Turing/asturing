<script setup lang="ts">

</script>

<!-- ContactEntreprise.vue (ou dans ton fichier page directement) -->
<template>
  <section class="bg-white dark:bg-primary py-16 px-4 sm:px-8">
    <div class="max-w-4xl p-12 rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 mx-auto relative z-10">
      <div class="text-center mb-8">
        <h2 class="text-4xl sm:text-5xl font-bold text-primary dark:text-white mb-4 underline underline-offset-8">Informations d’entreprise</h2>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-xl mx-auto">
          Retrouvez ici toutes les informations légales et de contact de AS-Turing.
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-base text-gray-800 dark:text-white">
        <p><strong>Nom :</strong><br> AS-Turing</p>
        <p><strong>Mail :</strong><br> alexandre@as-turing.fr</p>
        <p><strong>Téléphone :</strong><br> <a href="tel:0783070052">07-83-07-00-52</a></p>
        <p><strong>SIRET :</strong><br> 978 977 585 00014</p>
        <p><strong>Ville :</strong><br> 33500 Libourne</p>
        <p><strong>Responsable :</strong><br> Alexandre Salé</p>
        <p><strong>Statut :</strong><br> Auto-entrepreneur</p>
        <p><strong>N° TVA intracommunautaire :</strong><br> FR38978977585</p>
        <p><strong>Code APE / NAF :</strong><br> 6201Z</p>
        <p><strong>Zone d'intervention :</strong><br> Bordeaux, et ses environs</p>
        <p><strong>Domaine et activités :</strong><br> Programmation, conseil et autres activités informatiques</p>
      </div>
      <div
          class="flex flex-col items-center md:items-center space-y-4 text-center md:text-right text-gray-800 dark:text-white mt-20">
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
  </section>

</template>


<style scoped>

</style>