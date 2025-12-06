<template>
  <div v-if="company" class="company-contact-button">
    <a 
      v-if="company.phone" 
      :href="`tel:${company.phone.replace(/\s/g, '')}`"
      class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300"
    >
      <Icon name="mdi:phone" class="w-5 h-5" />
      <span>{{ company.phone }}</span>
    </a>
  </div>
</template>

<script setup lang="ts">
const { companyInfo: company } = useCompany()
</script>
