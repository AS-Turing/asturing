<script setup lang="ts">
import { useColorMode } from '../../.nuxt/imports'
import { ref } from '../../.nuxt/imports'
import { useRuntimeConfig } from 'nuxt/app'

interface ServiceItem {
  label: string;
  href: string;
}

type TransitionCallback = () => void;

// Component data with proper typing
const colorMode = useColorMode()
const mobileMenuOpen = ref<boolean>(false)
const isOpen = ref<boolean>(false)

// Fetch dynamic services for menu
const config = useRuntimeConfig()
const baseUrl = config.public.apiBaseUrl

const { data: servicesResponse } = await useFetch(`${baseUrl}/services/menu`)
const subServices: ServiceItem[] = (servicesResponse.value?.success ? servicesResponse.value.data : []).map((s: { title: string; slug: string }) => ({
  label: s.title,
  href: `/services/${s.slug}`,
}))

const toggleMenu = (): void => {
  isOpen.value = !isOpen.value
}

const closeMenu = (): void => {
  isOpen.value = false
}

const beforeEnter = (el: HTMLElement): void => {
  el.style.opacity = '0'
  el.style.transform = 'translateY(-10px)'
}

const enter = (el: HTMLElement, done: TransitionCallback): void => {
  el.style.transition = 'all 0.3s ease'
  el.style.opacity = '1'
  el.style.transform = 'translateY(0)'
  setTimeout(done, 300)
}

const leave = (el: HTMLElement, done: TransitionCallback): void => {
  el.style.transition = 'all 0.2s ease'
  el.style.opacity = '0'
  el.style.transform = 'translateY(-10px)'
  setTimeout(done, 200)
}
</script>

<template>
  <header class="flex text-primary items-center justify-between px-6 py-4 border-b bg-white dark:bg-primary dark:text-white sticky top-0 shadow z-50 w-full">
    <button class="md:hidden p-2" @click="mobileMenuOpen = !mobileMenuOpen">
      <span class="sr-only">Ouvrir le menu</span>
      <span v-if="!mobileMenuOpen" class="text-3xl">☰</span>
      <span v-else  class="text-2xl">✕</span>
    </button>
    <!-- Menu mobile -->
    <Transition
      name="slide-fade"
      @before-enter="beforeEnter"
      @enter="enter"
      @leave="leave"
    >
      <nav
        v-if="mobileMenuOpen"
        class="md:hidden flex flex-col gap-3 absolute top-full left-0 w-full bg-white dark:bg-primary text-primary dark:text-white shadow-lg z-40 px-6 py-6 rounded-b-2xl"
      >
        <NuxtLink to="/services" class="font-bold text-lg hover:text-secondary transition">Services</NuxtLink>

        <div class="ml-2 pl-2 border-l border-primary/30 dark:border-white/20 space-y-2 text-sm">
          <NuxtLink
            v-for="(item, index) in subServices"
            :key="index"
            @click="mobileMenuOpen = false"
            :to="item.href"
            class="block hover:text-secondary transition"
          >
            {{ item.label }}
          </NuxtLink>
        </div>

        <hr class="border-t border-primary/10 dark:border-white/10 my-3" />

        <NuxtLink
          to="/about"
          @click="mobileMenuOpen = false"
          class="hover:text-secondary transition">À propos</NuxtLink>
        <NuxtLink
          to="/contact"
          @click="mobileMenuOpen = false"
          class="hover:text-secondary transition">Contact</NuxtLink>
      </nav>
    </Transition>
    <!-- Logo -->
    <NuxtLink
      to="/"
      class="inline-flex items-center gap-2 dark:text-white hover:dark:text-secondary hover:scale-110 transition ease-in-out duration-700"
      aria-label="Accueil - AS-Turing"
    >
      <img src="/images/logo2.png" width="200" height="50" class="fill-current" alt="Logo">
<!--      <svg xmlns="http://www.w3.org/2000/svg" width="200" height="50" class="fill-current" version="1.0" viewBox="0 0 1088 241"><path d="M101.5 2C79 5.1 55.2 17.1 37.9 34.2 20 51.9 9.4 71.4 3.6 97c-4.7 20.6-2.1 48.9 6.4 69.2 16 38.5 49.9 65.8 90 72.3 12.7 2 22.5 1.9 36.3-.5 29.2-5 54.9-21.2 74.4-47.1 20-26.6 27.7-62.3 20.4-94.9-3.8-16.7-11.1-33.5-19.7-45-19-25.2-43.5-41.8-70.8-47.6-8.8-1.9-29.7-2.6-39.1-1.4m10.3 34.9c.2 15.6-.1 22.8-.9 23.7-.9 1.1-4.8 1.4-17.4 1.4-19.1 0-19.5-.2-17.5-7.8 1.8-6.5 6.2-16.2 9.8-21.4 6.8-9.9 18.3-19.2 23.2-18.6l2.5.3zm22.6-19c9.7 6.7 18.1 18.5 22.7 32 2.3 6.7 2.4 10.7.3 11.5-3.1 1.2-30.9.7-32.2-.6s-1.8-43.9-.5-45.1c1.5-1.5 5.7-.5 9.7 2.2m-54.7 4.3c-.7 1.3-3.1 5.4-5.4 9.3-2.3 3.8-5.8 11.9-7.7 17.9-2 6-4.1 11.3-4.8 11.8-1.7 1-27.9 1-29.6 0-2.2-1.4 0-5.1 8.2-13.9 13.2-14.2 31.2-26.6 39.3-27.2.9-.1.9.4 0 2.1m88.3 3.6c10.5 6.2 18.6 12.9 26.4 21.6s10.1 12.6 8.3 13.8c-2.1 1.4-29.3 1-30.5-.5-.6-.6-2.8-6.8-5.1-13.7-2.2-6.9-5.2-14.1-6.5-16.1-1.4-2-3.4-5.2-4.5-7.2l-2-3.6 3.2.6c1.8.3 6.6 2.6 10.7 5.1M59 74.6c1.1 1.2 1 3.8-.3 14.3-.9 7-1.7 14.6-1.7 16.8 0 2.3-.4 5.3-1 6.7l-1 2.6H35.2c-21.4 0-22.2-.2-22.2-5.2 0-7.7 6.5-31.5 9.6-34.9C24.2 73.2 25.8 73 41 73c13.9 0 17 .3 18 1.6m51.8-.4c1.7 1.7 1.7 37.9 0 39.6-1.3 1.3-38.1 1.8-41.2.6-2-.8-2.1-9.3-.1-25.8 1-8.2 1.9-12.4 3.1-13.7C74.2 73.2 75.9 73 92 73c12.3 0 18 .4 18.8 1.2m51.6 1.1c1.7 2.5 4.6 22.7 4.6 31.6 0 3.1-.5 6.2-1.2 6.9-1.7 1.7-38.9 1.7-40.6 0s-1.7-37.9 0-39.6c.8-.8 6.4-1.2 18.5-1.2 16.8 0 17.3.1 18.7 2.3m52 4.2c3.7 7.7 8.6 30.7 7 33.3-1 1.5-3.3 1.7-20.9 2-12.6.1-20.2-.1-21-.8-.8-.6-1.5-4.6-1.8-9.8-.2-4.8-1.1-13-1.8-18.4-1.8-13.5-2.7-12.9 18.5-12.6l17.1.3zM55.8 127.2c.5.7 1.2 6.7 1.6 13.3s1.2 14.7 1.7 17.9c.6 3.2.8 7 .5 8.2L59 169H41.6c-15.5 0-17.5-.2-18.9-1.8-5.3-5.9-12.2-39-8.4-40.5.6-.3 10-.6 20.8-.6 14.6-.1 19.9.2 20.7 1.1m55 0c1.4 1.4 1.7 38.4.4 40.6-.7.9-5.3 1.2-19.8 1l-18.9-.3-1.3-4c-.7-2.1-1.8-11.3-2.4-20.3-1-14-1-16.5.3-17.3 2.2-1.4 40.3-1.1 41.7.3m54.6-.6c1.9.7 2.1 8.1.6 23.5-1.3 12.7-2.5 17.5-4.6 18.3-3.1 1.2-34.9.7-36.2-.6-1.7-1.7-1.7-38.9 0-40.6 1.3-1.3 37.1-1.8 40.2-.6m55.6.9c2.4 2.9-1.9 25.5-6.8 35.5l-2.7 5.5h-36l.1-4.5c.1-2.5.8-11.6 1.6-20.3 1-11.5 1.8-16.1 2.9-16.8.7-.5 10-.9 20.5-.9 15.9 0 19.4.3 20.4 1.5M62.7 181.2c.6.7 2.7 6.3 4.7 12.5 2.1 6.2 5.4 13.9 7.6 17.1 2.1 3.3 4.1 6.9 4.4 8 .6 1.9.4 2-2.1 1.3-9.7-2.8-24.1-13-35.8-25.4-8.7-9.1-10.7-12.2-8.8-14 1.3-1.3 29-.8 30 .5m48.1 0c1.3 1.3 1.8 41.1.6 44.2-1.3 3.4-7.5 1.2-15.7-5.7-7.8-6.4-16.4-20.4-19.1-31-2.3-8.7-2.2-8.7 16.7-8.7 11.4 0 16.7.4 17.5 1.2m47.1-.3c2.3 1.4.5 8.6-4.5 18.9-6.9 13.9-20.3 26.9-26.7 26-2.2-.3-2.2-.6-2.5-21.7-.2-14.9.1-21.8.9-22.7.9-1.1 4.6-1.4 16.3-1.4 8.3 0 15.7.4 16.5.9m43.8-.1c2.2 1.4-1.6 7.3-10.9 16.6-11.7 11.6-25.9 21.3-34 23-2.6.6-2.6.6-1.1-2.4.8-1.7 2.9-5.5 4.8-8.5 1.8-3.1 5-10.4 7.1-16.3 2-5.9 4.2-11.3 4.7-12 1.1-1.3 27.3-1.8 29.4-.4M778.3 59.2c-4.6 2.2-4.8 11.4-.3 13.8 3.6 2 8.7 1.2 10.9-1.6 2.5-3.1 2.6-5.5.6-9.3-2.1-4.2-6.4-5.2-11.2-2.9M471 60.5c-10.5 3-16.4 7.7-20.1 16-3.2 7-2.9 14.2.8 21.4s9.6 10.9 25.3 15.7c25.4 7.9 28 9.7 28 20 0 5.7-.3 6.7-3.2 10-4.5 5.1-8.2 6.4-18.5 6.4-11.1 0-15.2-1.8-22-9.5-4.8-5.4-5.4-5.7-8.6-5.1-8.2 1.5-8.6 5.2-1.1 13.4 13.8 15.4 43.6 17.5 58.8 4 9.1-7.9 11.5-19.7 6.4-30.9-4.1-8.9-10.4-12.8-30.2-18.4-7-1.9-14.6-4.5-16.7-5.6-10.1-5.1-10.3-17-.6-24.3 2-1.5 4.7-2.2 9.8-2.4 9.3-.6 14.7 1.6 22.1 8.6l5.8 5.5 4.5-1.7c2.7-1.1 4.5-2.4 4.5-3.3 0-5.1-10.4-15.2-18.9-18.4-7.4-2.8-18.9-3.4-26.1-1.4M387.7 62.2c-1.7 1.4-2.5 3.3-12.7 30.3-21 55.7-24 63.8-24 65 0 2.9 8.6 3.5 11.9.7 1.1-.9 3.4-5.5 5.1-10.2 5.2-14.2 2.7-13 26.5-13 16.1 0 20.6.3 21.8 1.4.7.8 2.8 5.6 4.6 10.7 1.8 5.2 4.2 10.2 5.3 11.1 2.4 2.2 10 2.4 11.7.4.9-1-3-11.9-16.9-48.2-10-25.8-18.8-47.5-19.7-48.2-.9-.6-4-1.2-6.8-1.2s-5.9.6-6.8 1.2m16 38.4c3.4 8.9 6.3 17.5 6.5 19l.3 2.9-15.7.3-15.8.3v-2.7c0-3.1 10.2-32.2 13.3-37.6l2-3.8 1.7 2.8c.9 1.5 4.4 10 7.7 18.8M571.6 62.6c-.9.8-1.6 2.8-1.6 4.4 0 5.2 1.9 6 15 6 6.5 0 12.5.3 13.4.6 1.4.5 1.6 5.2 1.6 41.9 0 46.2-.3 44.5 7 44.5s7 1.7 7-43.9c0-30.3.3-41 1.2-41.9.8-.8 5.4-1.2 13.9-1.2 14.1 0 15.9-.7 15.9-6 0-6 .2-6-37.5-6-29.9 0-34.6.2-35.9 1.6M1013.2 62.7c-1.2 1.1-6.4 13.3-12.7 29.8-5.9 15.4-13.8 36-17.6 45.8s-6.9 18.5-6.9 19.3c0 1.9 4.7 2.9 7.6 1.5 3-1.3 2 .9 20.9-48.6 19.7-51.8 18.3-47.4 16.5-48.5-2.3-1.5-5.6-1.2-7.8.7M281 93.3c-20.8 10.4-24.6 12.6-25.4 14.9-2.2 6.4-1.1 7.3 26.3 21 19.3 9.7 25.8 12.5 26.8 11.6 1.7-1.4 1.7-6.9 0-9.3-.8-1-9-5.7-18.3-10.4-10.5-5.4-16.9-9.2-16.9-10.1s6.3-4.7 16.8-10c9.2-4.7 17.2-9.2 17.7-10 1.9-3 .9-10-1.4-10-.6 0-12.1 5.5-25.6 12.3M1031.6 82.6c-1.2 3.1-.6 6.3 1.7 8.7 1.2 1.3 8.7 5.5 16.7 9.2 16 7.5 19.2 9.7 17.2 11.7-.7.7-8.8 5.1-18 9.8-14 7.1-16.8 8.9-17.5 11.3-1.1 3.5-.1 7.7 1.8 7.7.8 0 12.9-5.6 26.9-12.4 25.4-12.4 25.5-12.4 26.1-16 .5-2.5.3-4.3-.8-5.9-1.5-2.3-48.9-25.7-52-25.7-.8 0-1.8.7-2.1 1.6M751 89.2c-1.9.5-6.3 2.9-9.6 5.3l-6.1 4.4-.9-4.2c-1.1-4.9-4.5-6.9-8.9-4.9L723 91v32.9c0 36.8-.1 36.1 6.8 36.1 6.8 0 6.6.3 7.2-23.2.5-20.5.6-21.6 3.1-26.3 3.4-6.6 7.7-9.5 14.3-9.5 2.8 0 5.7-.4 6.5-.9 1.5-1 2.8-9.6 1.5-10.4-2-1.2-8.1-1.5-11.4-.5M835.8 90c-3.1.9-6.9 2.6-8.5 3.8-4.5 3.2-6.5 3.2-7.4-.2-1-3.6-2.4-4.6-6.6-4.6-6.3 0-6.3-.3-6.3 35.5 0 36.2-.1 35.5 7 35.5 6.8 0 7-.6 7-23.3.1-18.5.2-20.7 2.3-25.7 3-7.4 6.9-10 15.1-10 4.4 0 7 .6 9.4 2 5.7 3.5 6.5 6.8 7 31.8.5 24.9.6 25.2 7.2 25.2s7-1 7-18.8c0-17.9-1.4-32.7-3.4-37.5-2.3-5.6-7.3-10.5-12.9-12.5-8-3-10.7-3.2-16.9-1.2M906.7 89c-5.3 1.4-9.2 3.5-13.8 7.7-5.1 4.6-7.7 9.6-9.5 18.7-4.7 22.4 8.5 41 29.2 41.1 6.1 0 7.9-.5 13.4-3.3 7.3-3.9 8-3.5 8 4.6 0 17.6-18.7 25.4-33.4 13.9-4.7-3.7-12.4-4.9-14.5-2.3-1.2 1.4-1 2.2 1.3 5.6 5.8 8.7 14.7 12.5 29.6 12.4 12.9 0 21.4-4.6 26.2-13.8 4-7.9 4.8-15.3 4.8-49.3 0-27.9-.2-32.4-1.6-33.7-3.1-3.2-7.8-1.5-10.9 3.8-.9 1.7-1.6 1.5-8-1.8-7.6-3.9-14.6-5.1-20.8-3.6m20.5 14.2c4.6 3.5 6.8 9.8 6.8 19.3 0 10.9-3.5 18.6-10 22-6.2 3.2-17.6 1.1-22.1-4.1-4-4.6-5.3-8.8-5.4-17.4 0-7.3.4-9.3 2.6-13.5 1.4-2.8 4.1-6.1 6-7.3 3-2.1 4.4-2.3 11-2 6.4.2 8.1.7 11.1 3M645.4 90.7c-1.5 1.5-1.6 4-1.1 25.3.4 18.2.9 24.7 2.2 29 3.6 11.5 15.4 18.5 27.3 16.1 5.2-1 6.5-1.6 13.7-5.4 2.9-1.6 3-1.6 5.7 1.3 1.8 2.1 3.6 3 5.7 3 6.1 0 6.1.1 6.1-35.5 0-36.2.1-35.5-6.9-35.5-6.9 0-7.1.7-7.1 25.6 0 20.8-.1 22.2-2.2 26.4-3.2 6.1-6.6 8.3-13.6 8.8-7.5.5-11.4-1.4-14.4-7.1-2.2-3.9-2.3-5.6-2.6-27.2-.3-19.3-.6-23.3-1.9-24.7-2.1-2.3-8.6-2.4-10.9-.1M777.6 90.6c-1.4 1.3-1.6 5.8-1.6 33.9 0 36.2-.1 35.5 6.9 35.5 7.2 0 7.1.4 7.1-35.8 0-35.9.1-35.2-7-35.2-2.2 0-4.5.7-5.4 1.6M534.6 118.6c-.9.8-1.6 2.6-1.6 3.9 0 5 1.8 5.5 20 5.5s20-.5 20-5.5-1.8-5.5-20-5.5c-14 0-17.1.3-18.4 1.6"/></svg>-->
<!--      <span class="sr-only">AS-Turing</span>-->
    </NuxtLink>
    <!-- Liens navigation -->
    <nav class="hidden md:flex gap-6">
      <!-- Menu déroulant -->
      <div class="relative">
        <button
          @click="toggleMenu"
          class=" focus:outline-none"
          aria-label="Ouvrir le menu"
        >
          Services
          <Icon name="lucide:chevron-down" class="w-5 h-5 transition-all duration-700 group-hover:scale-110 group-hover:rotate-12" />
        </button>

        <Transition
          name="dropdown"
          @after-leave="closeMenu"
        >
          <div
            v-if="isOpen"
            @mouseleave="closeMenu"
            class="absolute md:min-w-72 mt-2 bg-white dark:bg-gray-800 shadow-lg rounded p-4 z-50"
          >
            <NuxtLink
              v-for="(item, index) in subServices"
              :key="index"
              :to="item.href"
              class="block md:min-w-72 px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 hover:underline hover:dark:text-secondary focus:outline-none focus-visible:ring-2 focus-visible:ring-secondary"
            >
              {{ item.label }}
            </NuxtLink>
          </div>
        </Transition>
      </div>
      <NuxtLink to="/about" class="text-sm font-medium hover:underline hover:dark:text-secondary">À propos</NuxtLink>
      <NuxtLink to="/contact" class="text-sm font-medium hover:underline hover:dark:text-secondary">Contact</NuxtLink>
    </nav>
    <!-- Toggle thème -->
    <button
      @click="colorMode.preference = colorMode.preference === 'dark' ? 'light' : 'dark'"
      class="p-2 rounded  hover:bg-gray-100 dark:hover:bg-gray-800 transition"
      aria-label="Changer le thème"
    >
      <Icon :name="colorMode.preference === 'dark' ? 'heroicons:sun' : 'heroicons:moon'" class="w-5 h-5" />

    </button>
    <!-- Menu mobile (icône) -->

  </header>
</template>

<style scoped>
.dropdown-enter-active, .dropdown-leave-active {
  transition: all 0.3s ease;
}
.dropdown-enter-from {
  opacity: 0;
  transform: translateY(-10px);
}
.dropdown-enter-to {
  opacity: 1;
  transform: translateY(0);
}
.dropdown-leave-from {
  opacity: 1;
  transform: translateY(0);
}
.dropdown-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.3s ease;
}
.slide-fade-enter-from,
.slide-fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>