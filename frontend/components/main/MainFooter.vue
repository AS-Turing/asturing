<script setup lang="ts">
import { useRuntimeConfig } from 'nuxt/app'

interface NavItem {
  label: string
  to: string
  title?: string
}

const config = useRuntimeConfig()
const baseUrl = config.public.apiBaseUrl

const { data: footerResponse } = await useFetch(`${baseUrl}/navigation/footer`)

const services: NavItem[] = footerResponse.value?.data?.services ?? []
const mainLinks: NavItem[] = footerResponse.value?.data?.main ?? []
const legalLinks: NavItem[] = footerResponse.value?.data?.legal ?? []
const locationLinks: NavItem[] = footerResponse.value?.data?.locations ?? []
</script>

<template>
  <footer class="pt-16 px-4 md:px-8 bg-white dark:bg-primary text-primary dark:text-white border-t">
    <!-- Conteneur principal -->
    <div class="max-w-7xl mx-auto flex flex-col items-center md:items-start md:justify-between md:flex-row gap-12 md:gap-8">

      <!-- Logo -->
      <div class=" flex md:justify-start">
        <NuxtLink
          to="/"
          class="inline-flex items-center gap-2 dark:text-white hover:dark:text-secondary hover:scale-110 transition ease-in-out duration-700"
          aria-label="Accueil - AS-Turing"
        >
          <img src="/images/logo2.png" width="200" height="50" class="fill-current" alt="Logo">
        </NuxtLink>
      </div>

      <!-- Navigation -->
      <div class="w-3/4 flex flex-col items-center md:items-start text-center md:text-left space-y-4">
        <ul class="space-y-2 flex flex-col md:flex-row  w-full">
          <li class="relative group mt-2 lg:w-4/12">
            <NuxtLink to="/services" class="hover:underline font-medium block pl-2 hover:dark:text-secondary" title="Services">
              Services
            </NuxtLink>
            <ul class="mt-1 space-y-1 text-sm ggroup-hover:block">
              <li v-for="(s, i) in services" :key="i">
                <NuxtLink :to="s.to"
                          class="block px-2 py-1 rounded hover:underline hover:dark:text-secondary" :title="s.title || s.label">
                  {{ s.label }}
                </NuxtLink>
              </li>
            </ul>
          </li>
          <li class="lg:w-4/12 text-center flex flex-col">
            <template v-for="(item, idx) in mainLinks" :key="idx">
              <NuxtLink :to="item.to" class="hover:underline font-medium hover:dark:text-secondary" :title="item.title || item.label">
                {{ item.label }}
              </NuxtLink>
            </template>
          </li>
          <li class="lg:w-4/12 text-center">
            <ul>
              <li v-for="(item, idx) in legalLinks" :key="idx">
                <NuxtLink :to="item.to" class="hover:underline font-medium hover:dark:text-secondary">
                  {{ item.label }}
                </NuxtLink>
              </li>
            </ul>
          </li>
          <li class="lg:w-4/12 text-center">
            <ul>
              <li v-for="(item, idx) in locationLinks" :key="idx">
                <NuxtLink :to="item.to"
                          class="hover:underline font-medium hover:dark:text-secondary"
                          :title="item.title || item.label">
                  {{ item.label }}
                </NuxtLink>
              </li>
            </ul>
          </li>
        </ul>
      </div>

      <!-- Réseaux sociaux -->
      <div class="flex flex-col items-center md:items-end space-y-4 text-center md:text-right">
        <h2 class="text-xl font-semibold">Suivez-moi</h2>
        <div class="flex gap-6 justify-center md:justify-end">
          <NuxtLink to="https://github.com/Chadowww" aria-label="GitHub" class="hover:text-secondary">
            <Icon name="mdi:github" class="w-12 h-12" />
          </NuxtLink>
          <NuxtLink to="https://www.linkedin.com/in/alexandresale/" aria-label="LinkedIn" class="hover:text-secondary">
            <Icon name="mdi:linkedin" class="w-12 h-12" />
          </NuxtLink>
        </div>
      </div>
    </div>

    <!-- Bas de page -->
    <div class="mt-12 text-center text-sm text-gray-500 dark:text-gray-400">
      © 2024 AS-Turing. Tous droits réservés.
    </div>
  </footer>
</template>
