<script setup lang="ts">

import getFigerprint from '../../../utils/fingerprint'

const fingerprint = ref<string>('')
const requestStatus = ref<'idle' | 'loading' | 'success' | 'error'>('idle')
const statusMessage = ref<string>('')

async function postFingerprint(): Promise<void> {
  const config = useRuntimeConfig()
  const baseUrl = config.public.apiBaseUrl

  try {
    requestStatus.value = 'loading'
    statusMessage.value = 'Envoi de l\'empreinte en cours...'

    const response: Response = await fetch(`${baseUrl}/api/fingerprint`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ fingerprint: fingerprint.value }),
    })

    const data = await response.json()

    if (!response.ok || !data.success) {
      requestStatus.value = 'error'
      statusMessage.value = data.error || 'Une erreur est survenue lors de l\'envoi de l\'empreinte'
      console.error('Erreur de l\'API :', data)
    } else {
      requestStatus.value = 'success'
      statusMessage.value = data.message || 'Empreinte envoyée avec succès'
      console.log('Succès:', data)
    }
  } catch (error) {
    requestStatus.value = 'error'
    statusMessage.value = 'Erreur de connexion au serveur'
    console.error(error)
  }
}

onMounted(async () => {
  requestStatus.value = 'loading'
  statusMessage.value = 'Récupération de l\'empreinte...'
  fingerprint.value = await getFigerprint()

  if (fingerprint.value) {
    await postFingerprint()
  }
})
</script>

<template>
  <div class="p-4">
    <h1 class="text-xl font-bold">Statut de l'empreinte d'appareil</h1>

    <div class="mt-6">
      <!-- Loading state -->
      <div v-if="requestStatus === 'loading'" class="flex items-center">
        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-500 mr-3"></div>
        <p class="text-gray-700">{{ statusMessage }}</p>
      </div>

      <!-- Success state -->
      <div v-else-if="requestStatus === 'success'" class="flex items-center text-green-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <p>{{ statusMessage }}</p>
      </div>

      <!-- Error state -->
      <div v-else-if="requestStatus === 'error'" class="flex items-center text-red-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <p>{{ statusMessage }}</p>
      </div>

      <!-- Idle state -->
      <div v-else class="text-gray-500">
        <p>En attente de l'empreinte...</p>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>