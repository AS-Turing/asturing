<template>
  <header 
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/80 dark:bg-dark/80 backdrop-blur-md"
    :class="[
      scrolled 
        ? 'shadow-lg border-b border-gray-200/50 dark:border-white/10 bg-white/95 dark:bg-dark/95' 
        : ''
    ]"
  >
    <!-- Barre de progression du scroll (très subtile) -->
    <div 
      class="absolute top-0 left-0 h-0.5 gradient-hero transition-all duration-150"
      :style="{ width: `${scrollProgress}%` }"
    ></div>
    
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo avec animation au scroll -->
        <NuxtLink 
          to="/" 
          class="flex items-center gap-2 group"
          @click="mobileMenuOpen = false"
        >
          <div 
            class="w-1 gradient-bar rounded-full group-hover:scale-110 transition-all duration-300"
            :style="{
              height: `${Math.max(0, 48 - (scrollY / 2))}px`
            }"
          ></div>
          
          <span class="text-2xl font-bold inline-flex items-center">
            <span class="code-brackets">&lt;</span>
            
            <!-- Texte qui disparaît au scroll -->
            <span 
              class="inline-block overflow-hidden transition-opacity duration-300 align-bottom"
              :style="{
                width: `${Math.max(0, logoTextWidth - (scrollY / 2))}px`,
                opacity: scrollY > logoTextWidth * 2 ? 0 : 1
              }"
            >
              <span class="inline-block whitespace-nowrap">
                <span class="text-primary group-hover:scale-105 inline-block transition-transform duration-300">AS</span>
                <span class="text-coral">-</span>
                <span class="text-secondary group-hover:scale-105 inline-block transition-transform duration-300">Turing</span>
              </span>
            </span>
            
            <span class="code-brackets">/&gt;</span>
          </span>
        </NuxtLink>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-1">
          <NuxtLink
            v-for="link in navLinks"
            :key="link.to"
            :to="link.to"
            class="relative px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors font-medium group"
            :class="{ 'text-primary dark:text-primary': $route.path === link.to }"
          >
            {{ link.label }}
            <span 
              class="absolute bottom-0 left-0 h-0.5 gradient-hero transition-all duration-300"
              :class="$route.path === link.to ? 'w-full' : 'w-0 group-hover:w-full'"
            ></span>
          </NuxtLink>
          
          <NuxtLink
            to="/blog"
            class="relative px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition-colors font-medium group"
            :class="{ 'text-primary dark:text-primary': $route.path === '/blog' }"
          >
            Blog
            <span 
              class="absolute bottom-0 left-0 h-0.5 gradient-hero transition-all duration-300"
              :class="$route.path === '/blog' ? 'w-full' : 'w-0 group-hover:w-full'"
            ></span>
          </NuxtLink>

          <!-- Dark Mode Toggle -->
          <button
            @click="toggleDark"
            class="ml-4 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/10 transition-all duration-300 group"
            aria-label="Toggle dark mode"
          >
            <svg 
              v-if="isDark" 
              class="w-5 h-5 text-yellow-400 group-hover:rotate-180 transition-transform duration-500" 
              fill="currentColor" 
              viewBox="0 0 20 20"
            >
              <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" />
            </svg>
            <svg 
              v-else 
              class="w-5 h-5 text-gray-700 dark:text-gray-300 group-hover:-rotate-12 transition-transform duration-500" 
              fill="currentColor" 
              viewBox="0 0 20 20"
            >
              <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
            </svg>
          </button>

          <!-- CTA Button avec effet shimmer -->
          <NuxtLink
            to="/contact"
            class="ml-2 px-6 py-2 gradient-hero text-white rounded-full font-semibold hover:shadow-xl hover:scale-105 transition-all duration-300 animate-gradient relative overflow-hidden group/cta"
          >
            <span class="relative z-10">Contact</span>
            <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent translate-x-[-200%] group-hover/cta:translate-x-[200%] transition-transform duration-1000"></span>
          </NuxtLink>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden flex items-center gap-2">
          <button
            @click="toggleDark"
            class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-white/10 transition-all"
            aria-label="Toggle dark mode"
          >
            <svg v-if="isDark" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" />
            </svg>
            <svg v-else class="w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
              <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
            </svg>
          </button>
          
          <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="p-2 text-gray-700 dark:text-gray-300 hover:text-primary transition-colors"
            aria-label="Toggle menu"
          >
            <svg class="w-6 h-6 transition-transform duration-300" :class="{ 'rotate-90': mobileMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                v-if="!mobileMenuOpen"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
              <path
                v-else
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
      </div>
    </nav>

    <!-- Mobile Menu avec animation -->
    <Transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="opacity-0 -translate-y-4"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 -translate-y-4"
    >
      <div
        v-if="mobileMenuOpen"
        class="md:hidden bg-white/95 dark:bg-dark/95 backdrop-blur-lg border-t border-gray-200/50 dark:border-white/10"
      >
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-2">
          <NuxtLink
            v-for="link in navLinks"
            :key="link.to"
            :to="link.to"
            class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:text-primary hover:bg-gray-50 dark:hover:bg-white/5 rounded-lg transition-all font-medium"
            @click="mobileMenuOpen = false"
          >
            {{ link.label }}
          </NuxtLink>
          
          <NuxtLink
            to="/blog"
            class="block px-4 py-3 text-gray-700 dark:text-gray-300 hover:text-primary hover:bg-gray-50 dark:hover:bg-white/5 rounded-lg transition-all font-medium"
            @click="mobileMenuOpen = false"
          >
            Blog
          </NuxtLink>
          
          <NuxtLink
            to="/contact"
            class="block px-4 py-3 gradient-hero text-white rounded-lg text-center font-semibold hover:shadow-lg transition-all"
            @click="mobileMenuOpen = false"
          >
            Contact
          </NuxtLink>
        </div>
      </div>
    </Transition>
  </header>
</template>

<script setup lang="ts">
const mobileMenuOpen = ref(false)
const scrolled = ref(false)
const scrollY = ref(0)
const scrollProgress = ref(0)
const logoTextWidth = 120 // Largeur approximative du texte "AS-Turing" en pixels

const { isDark, toggleDark, initDarkMode } = useDarkMode()

const navLinks = [
  { to: '/services', label: 'Services' },
  { to: '/processus', label: 'Processus' },
  { to: '/projets', label: 'Projets' },
]

onMounted(() => {
  // Initialiser le dark mode
  initDarkMode()
  
  // Gérer le scroll
  const handleScroll = () => {
    scrollY.value = window.scrollY
    scrolled.value = window.scrollY > 20
    
    // Calculer la progression du scroll
    const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight
    scrollProgress.value = (window.scrollY / windowHeight) * 100
  }
  window.addEventListener('scroll', handleScroll)
  
  onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
  })
})
</script>

<style scoped>
@keyframes gradient {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

.animate-gradient {
  background-size: 200% 200%;
  animation: gradient 3s ease infinite;
}
</style>
