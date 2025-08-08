<script setup lang="ts">
import { ApiResponse } from 'types/apiResponse.js'
import { Service } from 'types/services.js'
import { useApiFetch } from '../../utils/useApiFetch'
import { onMounted, ref } from 'vue'
import ClientDelete from "../client/ClientDelete.vue";
import ClientEdit from "../client/ClientEdit.vue";
import CoreFileUploadForm from "../core/CoreFileUploadForm.vue";

const services = ref<Service[]>()
const loading = ref(true)
const error = ref<string | null>(null)
const showModal = ref(false)
const activeTab = ref<'form' | 'upload'>('form')

async function fetchServices() {
  loading.value = true
  error.value = null

  try {
    const response: ApiResponse<Service[]> = await useApiFetch('/api/services')

    if (response.success) {
      services.value = response.data
    } else {
      error.value = response.data || 'Une erreur est survenue lors du chargement des services'
    }
  } catch (err) {
    error.value = 'Erreur de connexion au serveur'
    console.error('Error fetching Services:', err)
  } finally {
    loading.value = false
  }
}

function toggleModal() {
  showModal.value = !showModal.value
}
function handleUploadSuccess() {
  toggleModal()
  fetchServices()
}
onMounted(() => {
  fetchServices()
})
</script>

<template>
  <div class="service-list text-gray-900 dark:text-white transition-colors">
    <!-- Header with title -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold">Liste des services</h2>
      <button
        @click="toggleModal"
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded flex items-center transition-colors"
      >
        <span class="mr-2">+</span>
        Nouveau service
      </button>
    </div>

    <!-- Loading state -->
    <div v-if="loading" class="text-center py-8">
      <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-600 dark:border-blue-500"></div>
      <p class="mt-2 text-gray-600 dark:text-gray-400">Chargement des services...</p>
    </div>

    <!-- Error state -->
    <div v-else-if="error" class="bg-red-100 dark:bg-red-900/20 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded transition-colors">
      <p>{{ error }}</p>
      <button
        @click="fetchServices"
        class="mt-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded text-sm transition-colors"
      >
        Réessayer
      </button>
    </div>

    <!-- Empty state -->
    <div v-else-if="!services || services.length === 0" 
         class="text-center py-8 bg-gray-50 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700 transition-colors">
      <p class="text-gray-600 dark:text-gray-400">Aucun service disponible</p>
    </div>

    <!-- Services table -->
    <div v-else class="bg-white dark:bg-gray-800 shadow dark:shadow-gray-700/10 rounded-lg overflow-hidden transition-colors">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Id</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Titre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Slug</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Micro-services</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tarifs</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"></th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"></th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
          <tr v-for="service in services" :key="service.id" 
              class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900 dark:text-white">{{ service.id }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500 dark:text-gray-400">{{ service.title }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500 dark:text-gray-400">{{ service.slug }}</div>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-500 dark:text-gray-400 max-w-xs truncate">{{ service.description }}</div>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-500 dark:text-gray-400">
                <span v-if="service.microServices && service.microServices.length" class="inline-block bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs px-2 py-1 rounded mr-1 mb-1" v-for="(micro, index) in service.microServices" :key="index">
                  {{ micro }}
                </span>
                <span v-else class="text-gray-400 dark:text-gray-500 italic">Aucun</span>
              </div>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-gray-500 dark:text-gray-400">
                <span v-if="service.prices && service.prices.length" class="inline-block bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 text-xs px-2 py-1 rounded mr-1 mb-1" v-for="price in service.prices" :key="price.id">
                  {{ price.name }}: {{ price.price }}
                </span>
                <span v-else class="text-gray-400 dark:text-gray-500 italic">Aucun</span>
              </div>
            </td>
            <td class="px-3 py-2 whitespace-nowrap">
              <ServiceEdit  :service="service" />
            </td>
            <td class="px-3 py-2 whitespace-nowrap">
              <ServiceDelete  :service="service" />
            </td>
          </tr>
        </tbody>
      </table>
    </div>
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
            <ServiceForm @submit-success="handleUploadSuccess" />
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