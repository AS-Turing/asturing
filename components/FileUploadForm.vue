<script setup lang="ts">
import { ref } from 'vue';

const emit = defineEmits(['upload-success', 'upload-error']);

const file = ref<File | null>(null);
const uploading = ref(false);
const error = ref<string | null>(null);
const dragActive = ref(false);

// Handle file selection
function handleFileChange(event: Event) {
  const input = event.target as HTMLInputElement;
  if (input.files && input.files.length > 0) {
    file.value = input.files[0];
    error.value = null;
  }
}

// Handle file drop
function handleDrop(event: DragEvent) {
  event.preventDefault();
  dragActive.value = false;
  
  if (event.dataTransfer?.files && event.dataTransfer.files.length > 0) {
    file.value = event.dataTransfer.files[0];
    error.value = null;
  }
}

// Handle drag events
function handleDragOver(event: DragEvent) {
  event.preventDefault();
  dragActive.value = true;
}

function handleDragLeave() {
  dragActive.value = false;
}

// Upload file
async function uploadFile() {
  if (!file.value) {
    error.value = 'Veuillez sélectionner un fichier';
    return;
  }
  
  // Check file type
  const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
  if (!allowedTypes.includes(file.value.type)) {
    error.value = 'Type de fichier non autorisé. Types autorisés: PDF, DOC, DOCX';
    return;
  }
  
  // Check file size (10MB max)
  const maxSize = 10 * 1024 * 1024;
  if (file.value.size > maxSize) {
    error.value = 'La taille du fichier dépasse la limite de 10MB';
    return;
  }
  
  uploading.value = true;
  error.value = null;
  
  try {
    const formData = new FormData();
    formData.append('file', file.value);
    
    const response = await fetch('/php-api/upload-cdc.php', {
      method: 'POST',
      body: formData
    });
    
    const result = await response.json();
    
    if (result.success) {
      file.value = null;
      emit('upload-success', result.file);
    } else {
      error.value = result.message || 'Erreur lors de l\'upload';
      emit('upload-error', error.value);
    }
  } catch (err) {
    error.value = 'Erreur de connexion au serveur';
    emit('upload-error', error.value);
    console.error('Error uploading file:', err);
  } finally {
    uploading.value = false;
  }
}
</script>

<template>
  <div class="file-upload">
    <h3 class="text-lg font-medium mb-4">Télécharger un cahier des charges</h3>
    
    <!-- Drag and drop area -->
    <div 
      @dragover="handleDragOver"
      @dragleave="handleDragLeave"
      @drop="handleDrop"
      class="border-2 border-dashed rounded-lg p-8 text-center cursor-pointer transition-colors"
      :class="dragActive ? 'border-blue-500 bg-blue-50' : 'border-gray-300 hover:border-blue-400'"
    >
      <div v-if="!file">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
        </svg>
        <p class="mt-2 text-sm text-gray-600">Glissez-déposez un fichier ici ou</p>
        <label class="mt-2 inline-block px-4 py-2 bg-blue-600 text-white rounded cursor-pointer hover:bg-blue-700">
          Parcourir
          <input type="file" class="hidden" @change="handleFileChange" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
        </label>
        <p class="mt-2 text-xs text-gray-500">Formats acceptés: PDF, DOC, DOCX (max 10MB)</p>
      </div>
      
      <div v-else class="flex items-center justify-between">
        <div class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <div class="ml-3">
            <p class="text-sm font-medium text-gray-900">{{ file.name }}</p>
            <p class="text-xs text-gray-500">{{ (file.size / 1024 / 1024).toFixed(2) }} MB</p>
          </div>
        </div>
        <button 
          @click="file = null" 
          class="text-red-600 hover:text-red-800"
          type="button"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
    
    <!-- Error message -->
    <div v-if="error" class="mt-3 text-sm text-red-600">
      {{ error }}
    </div>
    
    <!-- Upload button -->
    <div class="mt-4 flex justify-end">
      <button 
        @click="uploadFile" 
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded flex items-center"
        :disabled="uploading || !file"
        :class="{ 'opacity-50 cursor-not-allowed': uploading || !file }"
      >
        <span v-if="uploading" class="mr-2">
          <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
        </span>
        {{ uploading ? 'Téléchargement...' : 'Télécharger' }}
      </button>
    </div>
  </div>
</template>

<style scoped>
.file-upload {
  width: 100%;
}
</style>