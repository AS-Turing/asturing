<script setup lang="ts">
import { ref } from 'vue'
import { Client } from '../../types/Client'
import { useApiFetch } from '../../utils/useApiFetch'
import CoreFileUploadForm from '../core/CoreFileUploadForm.vue'
import ClientDelete from './ClientDelete.vue'
import ClientEdit from './ClientEdit.vue'
import { ApiResponse } from 'types/apiResponse.js'

const clients = ref<Client[]>()
const loading = ref(true)
const error = ref<string | null>(null)
const showModal = ref(false)
const activeTab = ref<'form' | 'upload'>('form')

async function fetchData() {
  loading.value = true
  error.value = null

  try {
    const response: ApiResponse<Client[]> = await useApiFetch('/api/clients')
    
    if (response.success) {
      clients.value = response.data
    } else {
      error.value = response.data || 'Une erreur est survenue lors du chargement des clients'
    }
  } catch (err) {
    error.value = 'Erreur de connexion au serveur'
    console.error('Error fetching Clients:', err)
  } finally {
    loading.value = false
  }
}
function toggleModal() {
  showModal.value = !showModal.value
}

function setActiveTab(tab: 'form' | 'upload') {
  activeTab.value = tab
}

function handleUploadSuccess() {
  toggleModal()
  fetchData()
}

onMounted(() => {
  fetchData()
})
</script>

<template>
  <div class="client-list text-gray-900 dark:text-white transition-colors">
    <!-- Header with title and add button -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold">Liste des clients</h2>
      <button
        @click="toggleModal"
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded flex items-center transition-colors"
      >
        <span class="mr-2">+</span>
        Nouveau client
      </button>
    </div>

    <!-- Loading state -->
    <div v-if="loading" class="text-center py-8">
      <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-600 dark:border-blue-500"></div>
      <p class="mt-2 text-gray-600 dark:text-gray-400">Chargement des clients...</p>
    </div>

    <!-- Error state -->
    <div v-else-if="error" class="bg-red-100 dark:bg-red-900/20 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded transition-colors">
      <p>{{ error }}</p>
      <button
        @click="fetchData"
        class="mt-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded text-sm transition-colors"
      >
        Réessayer
      </button>
    </div>

    <!-- Empty state -->
    <div v-else-if="clients.length === 0" 
         class="text-center py-8 bg-gray-50 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 transition-colors">
      <p class="text-gray-600 dark:text-gray-400">Aucun client disponible</p>
      <button
        @click="toggleModal"
        class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition-colors"
      >
        Créer un nouveau client
      </button>
    </div>

    <!-- File list -->
    <div v-else class="bg-white dark:bg-gray-800 shadow dark:shadow-gray-700/10 rounded-lg overflow-hidden transition-colors">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Id</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Mail</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Prénom</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nom</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Téléphone</th>
            <th 
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Entreprise</th>
            <th 
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Adresse</th>
            <th 
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Code postal</th>
            <th 
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Site internet</th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"></th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"></th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
          <tr v-for="client in clients" :key="client.id" 
              class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900 dark:text-white">{{ client.id }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500 dark:text-gray-400">{{ client.email }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500 dark:text-gray-400">{{ client.firstname }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500 dark:text-gray-400">{{ client.lastname }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500 dark:text-gray-400">{{ client.phone }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500 dark:text-gray-400">{{ client.company }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500 dark:text-gray-400">{{ client.address }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500 dark:text-gray-400">{{ client.zipCode }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500 dark:text-gray-400">{{ client.webSite }}</div>
            </td>
            <td class="px-3 py-2 whitespace-nowrap">
              <ClientEdit  :client="client" />
            </td>
            <td class="px-3 py-2 whitespace-nowrap">
              <ClientDelete  :client="client" />
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal for creating new client -->
    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-3xl w-full max-h-[90vh] overflow-y-auto transition-colors">
        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 px-6 py-4">
          <h3 class="text-lg font-medium text-gray-900 dark:text-white">Nouveau client</h3>
          <button @click="toggleModal" class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 transition-colors">
            <span class="text-2xl">&times;</span>
          </button>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200 dark:border-gray-700">
          <div class="flex">
            <button
              @click="setActiveTab('form')"
              class="px-6 py-3 font-medium text-sm focus:outline-none transition-colors"
              :class="activeTab === 'form' 
                ? 'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400' 
                : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'"
            >
              Créer un client
            </button>
            <button
              @click="setActiveTab('upload')"
              class="px-6 py-3 font-medium text-sm focus:outline-none transition-colors"
              :class="activeTab === 'upload' 
                ? 'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400' 
                : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'"
            >
              Importer des clients
            </button>
          </div>
        </div>

        <!-- Tab content -->
        <div class="p-6">
          <!-- Form tab -->
          <div v-if="activeTab === 'form'">
            <ClientForm @submit-success="handleUploadSuccess" />
          </div>

          <!-- Upload tab -->
          <div v-if="activeTab === 'upload'">
            <CoreFileUploadForm @upload-success="handleUploadSuccess" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<style scoped>

</style>