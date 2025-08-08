<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { useUserStore } from '../../../store/user'
import { definePageMeta } from '../../../.nuxt/imports'
import SpecificationList from '../../../components/specification/SpecificationList.vue'
import ClientList from '../../../components/client/ClientList.vue'

definePageMeta({
  middleware: 'auth',
})

onMounted(() => {
  const userStore = useUserStore()
  userStore.loadToken()
})

// Active menu item tracking
const activeMenuItem = ref('specification')

// Menu items
const menuItems = [
  { id: 'specification', label: 'Cahier des charges', icon: '📝' },
  { id: 'client', label: 'Client', icon: '📝' },
  { id: 'service', label: 'Service', icon: '🛠️' },
]

// Function to set active menu item
function setActiveMenuItem(id: string) {
  activeMenuItem.value = id
}
</script>

<template>
  <div class="admin-dashboard dark:bg-gray-900 dark:text-white">
    <!-- Admin header -->
    <header class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white p-4 transition-colors">
      <h1 class="text-xl font-bold">Panneau d'administration</h1>
    </header>

    <div class="flex min-h-screen">
      <!-- Sidebar menu -->
      <aside class="w-64 border-r border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 transition-colors">
        <nav class="p-4">
          <ul class="space-y-2">
            <li v-for="item in menuItems" :key="item.id">
              <button 
                @click="setActiveMenuItem(item.id)"
                class="w-full text-left px-4 py-2 rounded transition-colors"
                :class="activeMenuItem === item.id 
                  ? 'bg-blue-600 text-white' 
                  : 'text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700'"
              >
                <span class="mr-2">{{ item.icon }}</span>
                {{ item.label }}
              </button>
            </li>
          </ul>
        </nav>
      </aside>

      <!-- Main content area -->
      <main class="flex-1 p-6 bg-gray-50 dark:bg-gray-900/50 transition-colors">
        <!-- Dynamic content based on active menu item -->
        <div v-if="activeMenuItem === 'specification'" class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow dark:shadow-gray-800/20 transition-colors">
          <SpecificationList />
        </div>
        <div v-if="activeMenuItem === 'client'" class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow dark:shadow-gray-800/20 transition-colors">
          <ClientList />
        </div>
        <div v-if="activeMenuItem === 'service'" class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow dark:shadow-gray-800/20 transition-colors">
          <ServiceList />
        </div>
      </main>
    </div>
  </div>
</template>

<style scoped>
.admin-dashboard {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
</style>
