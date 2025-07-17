<script setup lang="ts">
import { ref } from 'vue';
import FormSpecification from '@/components/form/FormSpecification.vue';
import CdcList from '@/components/CdcList.vue';
import {useUserStore} from "../../../store/user";
import {definePageMeta} from "../../../.nuxt/imports";

definePageMeta({
  middleware: 'auth'
})

onMounted(() => {
  const userStore = useUserStore()
  userStore.loadToken()
})

// Active menu item tracking
const activeMenuItem = ref('cahier-des-charges');

// Menu items
const menuItems = [
  { id: 'cahier-des-charges', label: 'Cahier des charges', icon: '📝' }
];

// Function to set active menu item
function setActiveMenuItem(id) {
  activeMenuItem.value = id;
}
</script>

<template>
  <div class="admin-dashboard">
    <!-- Admin header -->
    <header class="bg-gray-800 text-white p-4">
      <h1 class="text-xl font-bold">Panneau d'administration</h1>
    </header>

    <div class="flex min-h-screen">
      <!-- Sidebar menu -->
      <aside class="w-64 bg-gray-100 border-r">
        <nav class="p-4">
          <ul class="space-y-2">
            <li v-for="item in menuItems" :key="item.id">
              <button 
                @click="setActiveMenuItem(item.id)"
                class="w-full text-left px-4 py-2 rounded transition-colors"
                :class="activeMenuItem === item.id ? 'bg-blue-600 text-white' : 'hover:bg-gray-200'"
              >
                <span class="mr-2">{{ item.icon }}</span>
                {{ item.label }}
              </button>
            </li>
          </ul>
        </nav>
      </aside>

      <!-- Main content area -->
      <main class="flex-1 p-6 bg-gray-50">
        <!-- Dynamic content based on active menu item -->
        <div v-if="activeMenuItem === 'cahier-des-charges'">
          <CdcList />
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
