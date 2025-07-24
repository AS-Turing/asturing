<script setup lang="ts">
import { ref, onMounted } from 'vue';
import FormSpecification from '@/components/form/FormSpecification.vue';
import FileUploadForm from '@/components/FileUploadForm.vue';
import {SpecificationBook} from "../types/specificationBook";
import {ApiResponse} from "../types/apiResponse";

// Interface for file information


// State
const specificationBooks = ref<SpecificationBook[]>([]);
const loading = ref(true);
const error = ref<string | null>(null);
const showModal = ref(false);
const activeTab = ref<'form' | 'upload'>('form');

// Format date to human-readable format
function formatDate(timestamp: number): string {
  return new Date(timestamp * 1000).toLocaleDateString('fr-FR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });
}

// Fetch files from API
async function fetchFiles() {
  loading.value = true;
  error.value = null;
  
  try {
    const response: ApiResponse<SpecificationBook[]> = await useApiFetch('/api/specifications')

    if (response.success) {
      specificationBooks.value = response.data
    } else {
      error.value = response.message || 'Une erreur est survenue lors du chargement des fichiers';
    }
  } catch (err) {
    error.value = 'Erreur de connexion au serveur';
    console.error('Error fetching files:', err);
  } finally {
    loading.value = false;
  }
}

// Open file in new tab
function openFile(path: string) {
  window.open(path, '_blank');
}

// Toggle modal
function toggleModal() {
  showModal.value = !showModal.value;
  // Reset to default tab when opening modal
  if (showModal.value) {
    activeTab.value = 'form';
  }
}

// Switch tabs
function setActiveTab(tab: 'form' | 'upload') {
  activeTab.value = tab;
}

// Handle file upload success
function handleUploadSuccess(fileInfo: FileInfo) {
  fetchFiles();
  toggleModal();
}

// Fetch files on component mount
onMounted(() => {
  fetchFiles();
});
</script>

<template>
  <div class="cdc-list">
    <!-- Header with title and add button -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold">Liste des cahiers des charges</h2>
      <button 
        @click="toggleModal"
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded flex items-center"
      >
        <span class="mr-2">+</span>
        Nouveau cahier des charges
      </button>
    </div>
    
    <!-- Loading state -->
    <div v-if="loading" class="text-center py-8">
      <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-600"></div>
      <p class="mt-2 text-gray-600">Chargement des fichiers...</p>
    </div>
    
    <!-- Error state -->
    <div v-else-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
      <p>{{ error }}</p>
      <button 
        @click="fetchFiles" 
        class="mt-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded text-sm"
      >
        Réessayer
      </button>
    </div>
    
    <!-- Empty state -->
    <div v-else-if="specificationBooks.length === 0" class="text-center py-8 bg-gray-50 rounded border">
      <p class="text-gray-600">Aucun cahier des charges disponible</p>
      <button 
        @click="toggleModal" 
        class="mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"
      >
        Créer un cahier des charges
      </button>
    </div>
    
    <!-- File list -->
    <div v-else class="bg-white shadow rounded-lg overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Decription</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de modification</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="specificationBook in specificationBooks" :key="specificationBook.id" class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">{{ specificationBook.client.company }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500">{{ specificationBook?.description }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500">{{ specificationBook?.file[0]?.uploadedAt }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-500">{{ }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <button
                @click="openFile('http://localhost:8000/api/file/' + specificationBook?.file[0]?.path)"
                class="text-blue-600 hover:text-blue-900 mr-3"
              >
                Consulter
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    
    <!-- Modal for creating new specification -->
    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg shadow-xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center border-b px-6 py-4">
          <h3 class="text-lg font-medium">Nouveau cahier des charges</h3>
          <button @click="toggleModal" class="text-gray-400 hover:text-gray-500">
            <span class="text-2xl">&times;</span>
          </button>
        </div>
        
        <!-- Tabs -->
        <div class="border-b">
          <div class="flex">
            <button 
              @click="setActiveTab('form')" 
              class="px-6 py-3 font-medium text-sm focus:outline-none"
              :class="activeTab === 'form' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500 hover:text-gray-700'"
            >
              Créer un formulaire
            </button>
            <button 
              @click="setActiveTab('upload')" 
              class="px-6 py-3 font-medium text-sm focus:outline-none"
              :class="activeTab === 'upload' ? 'border-b-2 border-blue-600 text-blue-600' : 'text-gray-500 hover:text-gray-700'"
            >
              Télécharger un fichier
            </button>
          </div>
        </div>
        
        <!-- Tab content -->
        <div class="p-6">
          <!-- Form tab -->
          <div v-if="activeTab === 'form'">
            <FormSpecification />
          </div>
          
          <!-- Upload tab -->
          <div v-if="activeTab === 'upload'">
            <FileUploadForm @upload-success="handleUploadSuccess" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.cdc-list {
  width: 100%;
}
</style>