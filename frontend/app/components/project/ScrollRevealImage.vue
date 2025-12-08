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
  
  maxScrollPixels.value = imageHeight - containerHeight
  
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
  
  const navbarHeight = 65 // Hauteur de la navbar
  
  // Position de début du scroll (container complètement visible en bas)
  const scrollStartPosition = viewportHeight - containerHeight
  
  // Position de fin du scroll (haut du container atteint la navbar)
  const scrollEndPosition = navbarHeight
  
  // Hauteur de la zone de scroll (FIXE pour toutes les images)
  const scrollZoneHeight = scrollStartPosition - scrollEndPosition
  
  // Position actuelle dans la zone (0 au début, scrollZoneHeight à la fin)
  const positionInZone = Math.max(0, Math.min(scrollZoneHeight, scrollStartPosition - containerTop))
  
  // NOUVELLE APPROCHE : Toutes les images s'arrêtent au même point visuel
  // Chaque taille d'image a sa propre stopPosition (valeurs calibrées empiriquement)
  // Table de correspondance basée sur maxScrollPixels
  let stopPosition;
  
  if (maxScrollPixels.value >= 4000) {
    // Très grandes images (4127px → 935, 3912px → 950)
    stopPosition = maxScrollPixels.value > 4050 ? 935 : 950;
  } else if (maxScrollPixels.value >= 2500) {
    // Grandes images (2627px → 1100)
    stopPosition = 1100;
  } else if (maxScrollPixels.value >= 1400) {
    // Petites images (1402px → 1900)
    stopPosition = 1900;
  } else {
    // Images très petites (fallback)
    stopPosition = 2000;
  }
  
  // Ou interpolation linéaire entre les points connus
  // Pour plus de précision entre les valeurs
  const knownPoints = [
    { maxScroll: 1402, stop: 1900 },
    { maxScroll: 2627, stop: 1100 },
    { maxScroll: 3912, stop: 950 },
    { maxScroll: 4127, stop: 935 }
  ];
  
  // Trouver les 2 points les plus proches pour interpoler
  const sorted = knownPoints.sort((a, b) => a.maxScroll - b.maxScroll);
  const current = maxScrollPixels.value;
  
  if (current <= sorted[0].maxScroll) {
    stopPosition = sorted[0].stop;
  } else if (current >= sorted[sorted.length - 1].maxScroll) {
    stopPosition = sorted[sorted.length - 1].stop;
  } else {
    // Interpolation entre 2 points
    for (let i = 0; i < sorted.length - 1; i++) {
      if (current >= sorted[i].maxScroll && current <= sorted[i + 1].maxScroll) {
        const p1 = sorted[i];
        const p2 = sorted[i + 1];
        const ratio = (current - p1.maxScroll) / (p2.maxScroll - p1.maxScroll);
        stopPosition = Math.round(p1.stop + ratio * (p2.stop - p1.stop));
        break;
      }
    }
  }
  
  // Progress de 0 à 1, mais sur la distance jusqu'à stopPosition (pas scrollZoneHeight)
  let scrollRatio = stopPosition > 0 ? Math.min(1, positionInZone / stopPosition) : 0

  // Calculer translatePixels
  // On scroll TOUTE l'image (maxScrollPixels) mais à une vitesse adaptée
  const translatePixels = scrollRatio * maxScrollPixels.value
  
  // Position du bas de l'image réelle (avec le translateY appliqué)
  const imageActualBottom = containerTop + imageHeight - translatePixels
  
  // CONDITION D'ARRÊT : Si le bas de l'image atteint le bas du container, on arrête
  if (imageActualBottom <= containerBottom) {

    // On garde la dernière valeur de scrollProgress, on ne calcule plus
    return
  }

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
