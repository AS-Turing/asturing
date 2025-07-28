<script setup lang="ts">
import FormAdminLogin from '../../components/form/FormAdminLogin.vue'
import { definePageMeta } from '../../.nuxt/imports'
import { useUserStore } from '../../store/user'

definePageMeta({
  middleware: 'auth',
})

onMounted(()=>{
  const userStore = useUserStore()
  userStore.loadToken()
})
</script>

<template>
  <div class="container mx-auto px-4 py-8 dark:text-white">
    <h1 class="text-3xl font-bold mb-8 text-center">Panneau d'administration</h1>
    <FormAdminLogin />
  </div>
</template>

<style scoped>

</style>
