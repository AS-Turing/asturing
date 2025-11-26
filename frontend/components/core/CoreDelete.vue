<script setup lang="ts">
const props = defineProps<{
  item: any;
  itemType: string;
  itemName: string;
  apiEndpoint: string;
  displayFields?: Array<{label: string, key: string}>;
}>()

const emit = defineEmits(['delete-confirmed'])
const showModal = ref(false)
const isDeleting = ref(false)
const error = ref<string | null>(null)

function openModal() {
  showModal.value = true
}

function closeModal() {
  showModal.value = false
  error.value = null
}

async function confirmDelete() {
  if (!props.item) {
    error.value = `Impossible de supprimer le ${props.itemType}: informations manquantes`
    return
  }
  
  isDeleting.value = true
  error.value = null
  
  try {
    await useApiFetch(props.apiEndpoint, {
      method: 'DELETE',
    })
    
    emit('delete-confirmed', props.item.id)
    closeModal()
  } catch (err) {
    error.value = `Une erreur est survenue lors de la suppression du ${props.itemType}`
    console.error(`Error deleting ${props.itemType}:`, err)
  } finally {
    isDeleting.value = false
  }
}
</script>

<template>
  <div>
    <!-- Delete button -->
    <button
      type="button"
      @click.stop="openModal"
      class="text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 transition-colors"
      :title="`Supprimer le ${itemType}`"
    >
      <Icon
        class="size-5 hover:cursor-pointer md:size-5"
        name="lucide:trash-2"
      />
    </button>
    
    <!-- Modal overlay -->
    <div v-if="showModal" 
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full transition-colors">
        <!-- Modal header -->
        <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 px-6 py-4">
          <h3 class="text-lg font-medium text-gray-900 dark:text-white">Confirmation de suppression</h3>
          <button @click="closeModal" 
                  class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 transition-colors">
            <span class="text-2xl">&times;</span>
          </button>
        </div>
        
        <!-- Modal content -->
        <div class="p-6">
          <div v-if="item" class="mb-6">
            <p class="text-gray-700 dark:text-gray-300 mb-4">
              Êtes-vous sûr de vouloir supprimer définitivement ce {{ itemType }} ?
            </p>
            
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-4">
              <div class="grid grid-cols-1 gap-2">
                <div class="flex">
                  <span class="font-medium text-gray-600 dark:text-gray-400 w-24">Nom:</span>
                  <span class="text-gray-900 dark:text-white">{{ itemName }}</span>
                </div>
                <div v-for="(field, index) in displayFields" :key="index" class="flex">
                  <span class="font-medium text-gray-600 dark:text-gray-400 w-24">{{ field.label }}:</span>
                  <span class="text-gray-900 dark:text-white">{{ item[field.key] }}</span>
                </div>
              </div>
            </div>
            
            <p class="text-red-600 dark:text-red-400 text-sm">
              Cette action ne peut pas être annulée.
            </p>
          </div>
          
          <div v-else class="mb-6">
            <p class="text-gray-700 dark:text-gray-300">
              Impossible de charger les informations du {{ itemType }}.
            </p>
          </div>
          
          <!-- Error message -->
          <div v-if="error" 
               class="bg-red-100 dark:bg-red-900/20 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded mb-4">
            {{ error }}
          </div>
          
          <!-- Action buttons -->
          <div class="flex justify-end space-x-3">
            <button @click="closeModal"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded font-medium transition-colors">
              Annuler
            </button>
            <button @click="confirmDelete"
                    :disabled="isDeleting || !item"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
              <span v-if="isDeleting">Suppression...</span>
              <span v-else>Supprimer</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Any additional scoped styles can go here */
</style>