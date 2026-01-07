<template>
  <section class="pt-24 pb-16 gradient-hero text-white overflow-hidden relative min-h-[90vh] flex items-center dark:opacity-95">
    <!-- Background decorations animées avec parallax (desktop only for performance) -->
    <div class="hidden md:block absolute inset-0 opacity-10 parallax-container">
      <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl animate-blob parallax-slow"></div>
      <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl animate-blob animation-delay-2000 parallax-medium"></div>
      <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-white rounded-full blur-3xl animate-blob animation-delay-4000 parallax-fast"></div>
    </div>
    
    <!-- Particules flottantes -->
    <!-- <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div v-for="i in 8" :key="i" class="floating-particle" :style="{ 
        left: `${Math.random() * 100}%`, 
        top: `${Math.random() * 100}%`,
        animationDelay: `${i * 0.5}s`,
        animationDuration: `${3 + Math.random() * 2}s`
      }"></div>
    </div> -->
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <!-- Contenu texte -->
        <div class="space-y-8 hero-content">
          <div class="inline-block fade-in-up" style="animation-delay: 0.1s">
            <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-semibold border border-white/30 hover:bg-white/30 transition-all duration-300">
              Agence Web & Digital
            </span>
          </div>
          
          <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight fade-in-up" style="animation-delay: 0.2s">
            Création de site internet à 
            <span class="relative inline-block">
              <span class="relative z-10 text-gradient-animated typing-effect">Libourne</span>
              <span class="absolute bottom-2 left-0 w-full h-3 bg-yellow-300/30 -rotate-1 highlight-underline"></span>
            </span>
          </h1>
          
          <h2 class="text-2xl md:text-3xl font-semibold text-white/95 leading-relaxed fade-in-up" style="animation-delay: 0.25s">
            Votre agence web de proximité dans l'Entre-deux-Mers
          </h2>
          
          <p class="text-xl md:text-2xl text-white/90 leading-relaxed fade-in-up" style="animation-delay: 0.3s">
            <strong class="font-bold">Sites vitrines, e-commerce et applications métier</strong> pour commerces et PME de Gironde.
          </p>
          
          <p class="text-lg text-white/85 leading-relaxed fade-in-up" style="animation-delay: 0.35s">
            Depuis 2 ans, nous accompagnons les entreprises locales dans leur transformation digitale avec des solutions sur mesure.
            <strong class="font-semibold">Qualité professionnelle, tarifs transparents, accompagnement personnalisé et maintenance incluse.</strong>
          </p>
          
          <p class="text-base text-white/75 italic fade-in-up" style="animation-delay: 0.37s">
            Développement web moderne avec WordPress, PrestaShop, Shopify ou solutions sur mesure en Symfony et Vue.js.
            Hébergement sécurisé, optimisation SEO, design responsive et accessibilité garantis.
          </p>
          
          <p class="text-lg text-white/80 mb-4 fade-in-up" style="animation-delay: 0.4s">
            Libourne • Saint-Émilion • Créon • Bordeaux Est
          </p>
          
          <div class="flex flex-col sm:flex-row gap-4 fade-in-up" style="animation-delay: 0.5s">
            <NuxtLink
              to="/contact"
              class="group px-8 py-4 bg-white text-primary rounded-full font-semibold hover:bg-gray-100 transition-all text-center shadow-xl hover:shadow-2xl hover:-translate-y-1 duration-200"
            >
              <span class="inline-flex items-center gap-2">
                Démarrer un projet
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
              </span>
            </NuxtLink>
            
            <NuxtLink
              to="/projets"
              class="group px-8 py-4 border-2 border-white text-white rounded-full font-semibold hover:bg-white/10 transition-all text-center backdrop-blur-sm hover:-translate-y-1 duration-200"
            >
              <span class="inline-flex items-center gap-2">
                Voir les réalisations
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
              </span>
            </NuxtLink>
          </div>
          
          <!-- Stats rapides avec animation stagger -->
          <div class="grid grid-cols-3 gap-6 pt-8 border-t border-white/20">
            <div v-for="(stat, index) in stats" :key="stat.label" class="text-center hover:scale-110 transition-transform duration-200 stat-item" :style="{ animationDelay: `${0.6 + index * 0.1}s` }">
              <div class="text-3xl md:text-4xl font-bold mb-1 stat-glow">{{ stat.value }}</div>
              <div class="text-white/80 text-sm md:text-base">{{ stat.label }}</div>
            </div>
          </div>
        </div>
        
        <!-- Illustration / Card visuelle avec code animé -->
        <div class="hidden md:block fade-in-up" style="animation-delay: 0.4s">
          <div class="glass p-8 rounded-3xl hover:scale-105 transition-transform duration-300 will-change-transform">
            <div class="bg-white/20 backdrop-blur-md rounded-2xl overflow-hidden shadow-2xl">
              <!-- Mockup de code avec animation -->
              <div class="bg-gray-900 p-6 space-y-3">
                <div class="flex items-center gap-2 mb-4">
                  <div class="w-3 h-3 rounded-full bg-red-400 pulse-dot"></div>
                  <div class="w-3 h-3 rounded-full bg-yellow-400 pulse-dot" style="animation-delay: 0.2s"></div>
                  <div class="w-3 h-3 rounded-full bg-green-400 pulse-dot" style="animation-delay: 0.4s"></div>
                </div>
                <div class="space-y-2 font-mono text-sm code-snippet">
                  <div class="flex gap-2 code-line" style="animation-delay: 0.1s">
                    <span class="text-purple-400">const</span>
                    <span class="text-blue-300">projet</span>
                    <span class="text-white">=</span>
                    <span class="text-green-300">{</span>
                  </div>
                  <div class="pl-4 flex gap-2 code-line" style="animation-delay: 0.2s">
                    <span class="text-blue-300">client:</span>
                    <span class="text-orange-300">"Votre entreprise"</span>
                    <span class="text-white">,</span>
                  </div>
                  <div class="pl-4 flex gap-2 code-line" style="animation-delay: 0.3s">
                    <span class="text-blue-300">stack:</span>
                    <span class="text-white">[</span>
                  </div>
                  <div class="pl-8 space-y-1">
                    <div v-for="(tech, i) in techStack" :key="tech" class="text-orange-300 code-line" :style="{ animationDelay: `${0.4 + i * 0.05}s` }">"{{ tech }}",</div>
                  </div>
                  <div class="pl-4 text-white code-line" style="animation-delay: 0.8s">],</div>
                  <div class="pl-4 flex gap-2 code-line" style="animation-delay: 0.9s">
                    <span class="text-blue-300">qualité:</span>
                    <span class="text-orange-300">"Premium ✨"</span>
                  </div>
                  <div class="text-green-300 code-line" style="animation-delay: 1s">}</div>
                </div>
              </div>
              
              <!-- Technologies badges avec glow -->
              <div class="bg-white/10 backdrop-blur-sm p-4">
                <div class="flex flex-wrap gap-2">
                  <span v-for="tech in techStack.slice(0, 6)" :key="tech" class="tech-badge px-3 py-1 bg-white/20 rounded-full text-xs font-semibold hover:bg-white/30 transition-all duration-300">
                    {{ tech }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 scroll-indicator">
      <div class="flex flex-col items-center gap-2 animate-bounce">
        <span class="text-white/60 text-sm">Découvrir</span>
        <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
const stats = [
  { value: '2 ans', label: 'Expérience pro' },
  { value: '100%', label: 'Clients satisfaits' },
  { value: '<24h', label: 'Réponse moyenne' },
]

const techStack = [
  'WordPress',
  'PrestaShop',
  'Shopify',
  'Magento',
  'Symfony',
  'Vue.js',
  'PHP',
  'Docker'
]

onMounted(() => {
  console.log('✅ [IMMÉDIAT] SectionHero montée (not lazy)')
})
</script>

<style scoped>
/* Animations fade-in avec stagger */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.fade-in-up {
  animation: fadeInUp 0.8s ease-out both;
}

/* Gradient animé sur le texte */
.text-gradient-animated {
  background: linear-gradient(90deg, #fef08a, #fde047, #facc15, #fef08a);
  background-size: 200% auto;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  animation: gradientShift 3s ease infinite;
}

@keyframes gradientShift {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

/* Effet typing subtle */
.typing-effect {
  display: inline-block;
  animation: typing 2s steps(8) 1s both;
}

@keyframes typing {
  from { max-width: 0; overflow: hidden; }
  to { max-width: 100%; }
}

/* Underline highlight animation */
.highlight-underline {
  animation: highlightGrow 0.6s ease-out 1.5s both;
}

@keyframes highlightGrow {
  from { width: 0; }
  to { width: 100%; }
}

/* Glow sur les CTAs */
.cta-glow:hover {
  box-shadow: 0 0 30px rgba(255, 255, 255, 0.4), 0 0 60px rgba(255, 255, 255, 0.2);
}

/* Stats avec glow */
.stat-item {
  animation: fadeInUp 0.6s ease-out both;
}

.stat-glow {
  text-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
}

/* Particules flottantes */
.floating-particle {
  position: absolute;
  width: 4px;
  height: 4px;
  background: radial-gradient(circle, rgba(255,255,255,0.8), transparent);
  border-radius: 50%;
  animation: floatParticle 4s ease-in-out infinite;
  pointer-events: none;
}

@keyframes floatParticle {
  0%, 100% {
    transform: translate(0, 0) scale(0);
    opacity: 0;
  }
  25% {
    transform: translate(20px, -20px) scale(1);
    opacity: 0.6;
  }
  50% {
    transform: translate(-10px, -40px) scale(1.2);
    opacity: 0.8;
  }
  75% {
    transform: translate(15px, -60px) scale(0.8);
    opacity: 0.4;
  }
}

/* Parallax subtil sur les blobs */
.parallax-slow {
  transform: translateZ(0);
  will-change: transform;
}

.parallax-medium {
  transform: translateZ(0);
  will-change: transform;
}

.parallax-fast {
  transform: translateZ(0);
  will-change: transform;
}

/* Animation des lignes de code */
.code-line {
  opacity: 0;
  animation: codeFadeIn 0.3s ease-out both;
}

@keyframes codeFadeIn {
  from {
    opacity: 0;
    transform: translateX(-10px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

/* Pulse sur les dots du code */
.pulse-dot {
  animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50% { opacity: 0.6; transform: scale(0.95); }
}

/* Tech badges avec glow */
.tech-badge {
  position: relative;
  transition: all 0.3s ease;
}

.tech-badge:hover {
  box-shadow: 0 0 15px rgba(255, 255, 255, 0.4);
  transform: translateY(-2px);
}

/* Scroll indicator */
.scroll-indicator {
  animation: fadeIn 1s ease-out 2s both;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
</style>
