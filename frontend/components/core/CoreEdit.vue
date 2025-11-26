<script setup lang="ts">
defineProps<{
  item: any;
  itemType: string;
  formComponent: any;
  formProps?: Record<string, any>;
}>()

defineEmits(['update:item'])
const showModal = ref(false)
const error = ref<string | null>(null)

function openModal() {
  showModal.value = true
}

function closeModal() {
  showModal.value = false
  error.value = null
}
</script>

<template>
  <div>
    <button
      type="button"
      @click.stop="openModal"
      class="text-gray-500 dark:text-gray-300 transition-colors"
      :title="`Modifier le ${itemType}`"
    >
      <Icon
        class="size-5 hover:cursor-pointer md:size-5"
        name="lucide:pen"
      />
    </button>
    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-3xl w-full max-h-[90vh] overflow-y-auto transition-colors">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-full">
          <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 px-6 py-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Modifier le {{ itemType }}</h3>
            <button @click="closeModal"
                    class="text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 transition-colors">
              <span class="text-2xl">&times;</span>
            </button>
          </div>
          <component :is="formComponent" v-bind="{ ...formProps, [itemType.toLowerCase()]: item }" />
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Any additional scoped styles can go here */
</style>