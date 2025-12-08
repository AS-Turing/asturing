<template>
  <div 
    ref="containerRef"
    class="relative h-80 lg:h-96 rounded-3xl overflow-hidden shadow-xl"
  >
    <img 
      v-if="imageSrc"
      ref="imageRef"
      :src="imageSrc"
      :alt="altText || ''"
      class="absolute inset-0 w-full"
      :class="[
        !isMobile && isFullPage ? 'h-auto object-top' : 'h-full object-cover'
      ]"
      :style="!isMobile && isFullPage ? { 
        transform: `translateY(-${scrollProgress}%)`,
        transition: 'transform 0.1s linear'
      } : {}"
      loading="lazy"
      @load="onImageLoad"
    />
    <div 
      v-else
      class="absolute inset-0 flex items-center justify-center text-white text-lg font-semibold gradient-hero"
      :class="fallbackGradient"
    >
      <span>{{ fallbackText }}</span>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted, computed } from 'vue'

const props = defineProps<{
  imageSrc?: string | null
  altText?: string
  fallbackText?: string
  fallbackGradient?: string
}>()

const containerRef = ref<HTMLElement | null>(null)
const imageRef = ref<HTMLImageElement | null>(null)
const scrollProgress = ref(0)
const isMobile = ref(false)
const maxScrollPixels = ref(0) // Distance max en pixels que l'image peut scroller

// Détection si l'image est en mode full-page (avec -fullpage dans le nom)
const isFullPage = computed(() => {
  return props.imageSrc?.includes('-fullpage') || false
})

// Détection mobile
const checkMobile = () => {
  isMobile.value = window.innerWidth < 1024
}

// Calculer la distance max que l'image peut scroller
const onImageLoad = () => {
  if (!imageRef.value || !containerRef.value || !isFullPage.value) return
  
  const imageHeight = imageRef.value.naturalHeight
  const containerHeight = containerRef.value.offsetHeight
  
  // Combien l'image dépasse du container
  // Si image = 3000px et container = 400px, elle dépasse de 2600px
  maxScrollPixels.value = imageHeight - containerHeight
  
  // Si l'image ne dépasse pas, pas de scroll
  if (maxScrollPixels.value <= 0) {
    maxScrollPixels.value = 0
    scrollProgress.value = 0
  } else {
    updateScrollProgress()
  }
}

// Vérifier si l'image est déjà chargée (en cache)
const checkIfImageAlreadyLoaded = () => {
  if (imageRef.value && imageRef.value.complete && imageRef.value.naturalHeight > 0) {
    onImageLoad()
  }
}

// Calcul du scroll progress
const updateScrollProgress = () => {
  if (!containerRef.value || !imageRef.value || isMobile.value || !isFullPage.value || maxScrollPixels.value === 0) {
    return
  }

  const rect = containerRef.value.getBoundingClientRect()
  const viewportHeight = window.innerHeight
  const containerTop = rect.top
  const containerBottom = rect.bottom
  const containerHeight = rect.height
  const imageHeight = imageRef.value.naturalHeight

  // On veut que le scroll s'arrête quand le bas de l'image est aligné avec le bas du container
  // imageBottom = containerTop + imageHeight - translatePixels
  // containerBottom = containerTop + containerHeight
  // On veut : imageBottom = containerBottom
  // Donc : containerTop + imageHeight - translatePixels = containerTop + containerHeight
  // Donc : translatePixels = imageHeight - containerHeight = maxScrollPixels ✓
  
  // ZONE DE SCROLL FIXE POUR TOUTES LES IMAGES :
  // Toutes les images scrollent dans la MÊME zone de hauteur fixe
  // Les grandes images scrollent plus vite que les petites
  
  const navbarHeight = 65 // Hauteur de la navbar
  
  // Position de début du scroll (container complètement visible en bas)
  const scrollStartPosition = viewportHeight - containerHeight
  
  // Position de fin du scroll (haut du container atteint la navbar)
  const scrollEndPosition = navbarHeight
  
  // Hauteur de la zone de scroll (FIXE pour toutes les images)
  const scrollZoneHeight = scrollStartPosition - scrollEndPosition
  
  // Position actuelle dans la zone (0 au début, scrollZoneHeight à la fin)
  const positionInZone = Math.max(0, Math.min(scrollZoneHeight, scrollStartPosition - containerTop))
  
  // Progress de 0 à 1 dans la zone
  const scrollRatio = scrollZoneHeight > 0 ? positionInZone / scrollZoneHeight : 0
  
  // Calculer translatePixels
  // On scroll TOUTE l'image (maxScrollPixels) mais à une vitesse adaptée
  // Vitesse = maxScrollPixels / scrollZoneHeight
  // Plus l'image est grande, plus elle scroll vite pour montrer tout son contenu
  const translatePixels = scrollRatio * maxScrollPixels.value
  
  // Position du bas de l'image VISIBLE dans le container
  // L'image commence à containerTop et on la translate vers le haut de translatePixels
  // Donc le bas visible est à : containerTop + containerHeight (le bas du container)
  // Et le vrai bas de l'image (si on pouvait tout voir) serait à : containerTop + imageHeight - translatePixels
  
  // Position du bas de l'image réelle
  const imageActualBottom = containerTop + imageHeight - translatePixels
  
  // Debug
  if (props.imageSrc?.includes('lighthouse-score-fullpage')) {
    console.log('📊 Scroll Zone:', {
      containerTop: containerTop.toFixed(0),
      scrollStartPosition: scrollStartPosition.toFixed(0),
      scrollEndPosition,
      scrollZoneHeight,
      positionInZone: positionInZone.toFixed(0),
      scrollRatio: scrollRatio.toFixed(2),
      translatePixels: translatePixels.toFixed(0),
      percentDone: ((translatePixels / maxScrollPixels.value) * 100).toFixed(0) + '%'
    })
  }
  
  // PAS DE CONDITION D'ARRÊT - on laisse scroller naturellement
  // jusqu'à maxScrollPixels
  
  // Convertir en pourcentage pour translateY
  scrollProgress.value = (translatePixels / imageHeight) * 100
}

onMounted(() => {
  checkMobile()
  window.addEventListener('scroll', updateScrollProgress, { passive: true })
  window.addEventListener('resize', checkMobile)
  updateScrollProgress()
  
  // Vérifier si l'image est déjà en cache
  checkIfImageAlreadyLoaded()
})

onUnmounted(() => {
  window.removeEventListener('scroll', updateScrollProgress)
  window.removeEventListener('resize', checkMobile)
})
</script>
