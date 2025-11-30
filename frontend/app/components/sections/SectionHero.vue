<template>
  <section class="pt-32 pb-20 gradient-hero text-white overflow-hidden relative min-h-screen flex items-center dark:opacity-95">
    <!-- Background decorations animées -->
    <div class="absolute inset-0 opacity-10">
      <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl animate-blob"></div>
      <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl animate-blob animation-delay-2000"></div>
      <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-white rounded-full blur-3xl animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <!-- Contenu texte -->
        <div class="space-y-8">
          <div class="inline-block">
            <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-semibold border border-white/30">
              🚀 Agence Web & Digital
            </span>
          </div>
          
          <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight">
            Votre partenaire digital pour des projets qui 
            <span class="relative inline-block">
              <span class="relative z-10 text-yellow-300 animate-pulse">performent</span>
              <span class="absolute bottom-2 left-0 w-full h-3 bg-yellow-300/30 -rotate-1"></span>
            </span>
          </h1>
          
          <p class="text-xl md:text-2xl text-white/90 leading-relaxed">
            Agence web spécialisée en création de sites haute performance et applications métier. 
            Basée à Libourne, nous accompagnons TPE, PME et grands comptes dans leur transformation 
            digitale avec des solutions sur-mesure et pérennes.
          </p>
          
          <div class="flex flex-col sm:flex-row gap-4">
            <NuxtLink
              to="/contact"
              class="group px-8 py-4 bg-white text-primary rounded-full font-semibold hover:bg-gray-100 transition-all text-center shadow-2xl hover:shadow-white/20 hover:scale-105 transform duration-300"
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
              class="group px-8 py-4 border-2 border-white text-white rounded-full font-semibold hover:bg-white/10 transition-all text-center backdrop-blur-sm hover:scale-105 transform duration-300"
            >
              <span class="inline-flex items-center gap-2">
                Voir les réalisations
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
              </span>
            </NuxtLink>
          </div>
          
          <!-- Stats rapides -->
          <div class="grid grid-cols-3 gap-6 pt-8 border-t border-white/20">
            <div v-for="stat in stats" :key="stat.label" class="text-center transform hover:scale-110 transition-transform duration-300">
              <div class="text-3xl md:text-4xl font-bold mb-1">{{ stat.value }}</div>
              <div class="text-white/80 text-sm md:text-base">{{ stat.label }}</div>
            </div>
          </div>
        </div>
        
        <!-- Illustration / Card visuelle -->
        <div class="hidden md:block">
          <div class="glass p-8 rounded-3xl transform hover:scale-105 transition-all duration-500 hover:rotate-1">
            <div class="bg-white/20 backdrop-blur-md rounded-2xl overflow-hidden shadow-2xl">
              <!-- Mockup de code ou design -->
              <div class="bg-gray-900 p-6 space-y-3">
                <div class="flex items-center gap-2 mb-4">
                  <div class="w-3 h-3 rounded-full bg-red-400"></div>
                  <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                  <div class="w-3 h-3 rounded-full bg-green-400"></div>
                </div>
                <div class="space-y-2 font-mono text-sm">
                  <div class="flex gap-2">
                    <span class="text-purple-400">const</span>
                    <span class="text-blue-300">projet</span>
                    <span class="text-white">=</span>
                    <span class="text-green-300">{</span>
                  </div>
                  <div class="pl-4 flex gap-2">
                    <span class="text-blue-300">client:</span>
                    <span class="text-orange-300">"Votre entreprise"</span>
                    <span class="text-white">,</span>
                  </div>
                  <div class="pl-4 flex gap-2">
                    <span class="text-blue-300">stack:</span>
                    <span class="text-white">[</span>
                  </div>
                  <div class="pl-8 space-y-1">
                    <div v-for="tech in techStack" :key="tech" class="text-orange-300">"{{ tech }}",</div>
                  </div>
                  <div class="pl-4 text-white">],</div>
                  <div class="pl-4 flex gap-2">
                    <span class="text-blue-300">qualité:</span>
                    <span class="text-orange-300">"Premium ✨"</span>
                  </div>
                  <div class="text-green-300">}</div>
                </div>
              </div>
              
              <!-- Technologies badges -->
              <div class="bg-white/10 backdrop-blur-sm p-4">
                <div class="flex flex-wrap gap-2">
                  <span v-for="tech in techStack.slice(0, 6)" :key="tech" class="px-3 py-1 bg-white/20 rounded-full text-xs font-semibold">
                    {{ tech }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
const stats = [
  { value: '15+', label: 'Projets livrés' },
  { value: '100%', label: 'Clients satisfaits' },
  { value: '<24h', label: 'Réponse moyenne' },
]

const techStack = [
  'WordPress',
  'PrestaShop',
  'Vue.js 3',
  'Nuxt',
  'Symfony',
  'Node.js',
  'React',
  'Docker'
]
</script>
