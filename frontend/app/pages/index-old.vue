<template>
  <div>
    <!-- Hero Section -->
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
                Agence Web & Digital
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
              <div class="text-center transform hover:scale-110 transition-transform duration-300">
                <div class="text-3xl md:text-4xl font-bold mb-1">15+</div>
                <div class="text-white/80 text-sm md:text-base">Projets livrés</div>
              </div>
              <div class="text-center transform hover:scale-110 transition-transform duration-300">
                <div class="text-3xl md:text-4xl font-bold mb-1">100%</div>
                <div class="text-white/80 text-sm md:text-base">Clients satisfaits</div>
              </div>
              <div class="text-center transform hover:scale-110 transition-transform duration-300">
                <div class="text-3xl md:text-4xl font-bold mb-1">&lt;24h</div>
                <div class="text-white/80 text-sm md:text-base">Réponse moyenne</div>
              </div>
            </div>
          </div>
          
          <!-- Illustration / Card visuelle -->
          <div class="hidden md:block">
            <div class="glass p-8 rounded-3xl transform hover:scale-105 transition-all duration-500 hover:rotate-1">
              <div class="bg-white/20 backdrop-blur-md rounded-2xl overflow-hidden shadow-2xl">
                <!-- Mockup de code ou design -->
                <div class="bg-gradient-to-br from-gray-900 to-gray-800 p-6 space-y-3">
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
                      <span class="text-blue-300">objectif:</span>
                      <span class="text-orange-300">"Croissance digitale"</span>
                      <span class="text-white">,</span>
                    </div>
                    <div class="pl-4 flex gap-2">
                      <span class="text-blue-300">stack:</span>
                      <span class="text-white">[</span>
                    </div>
                    <div class="pl-8 flex gap-2">
                      <span class="text-yellow-300">"WordPress"</span>
                      <span class="text-white">,</span>
                    </div>
                    <div class="pl-8 flex gap-2">
                      <span class="text-yellow-300">"PrestaShop"</span>
                      <span class="text-white">,</span>
                    </div>
                    <div class="pl-8 flex gap-2">
                      <span class="text-yellow-300">"Symfony"</span>
                      <span class="text-white">,</span>
                    </div>
                    <div class="pl-8 flex gap-2">
                      <span class="text-yellow-300">"Vue.js"</span>
                      <span class="text-white">,</span>
                    </div>
                    <div class="pl-8 flex gap-2">
                      <span class="text-yellow-300">"Nuxt"</span>
                    </div>
                    <div class="pl-4 flex gap-2">
                      <span class="text-white">]</span>
                    </div>
                    <div class="flex gap-2">
                      <span class="text-green-300">}</span>
                    </div>
                  </div>
                </div>
                <div class="bg-white/10 p-4 flex items-center justify-center">
                  <div class="text-white/60 text-sm flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" />
                    </svg>
                    Code moderne & performant
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Scroll indicator -->
      <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
      </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white dark:bg-dark transition-colors duration-300">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div 
            v-for="stat in stats" 
            :key="stat.label"
            class="text-center transform hover:scale-105 transition-transform duration-300"
          >
            <div 
              class="text-4xl font-bold mb-2 bg-gradient-to-r bg-clip-text text-transparent"
              :class="stat.gradient"
            >
              {{ stat.value }}
            </div>
            <div class="text-gray-600 dark:text-gray-400 font-medium">{{ stat.label }}</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services/Expertise Section -->
    <section id="services" class="py-20 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <div class="inline-block mb-4">
            <span class="bg-primary/10 dark:bg-primary/20 text-primary px-4 py-2 rounded-full text-sm font-semibold">
              Nos expertises
            </span>
          </div>
          <h2 class="text-4xl md:text-5xl font-bold text-dark dark:text-white mb-4">
            Expertise complète du web au service de votre croissance
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
            Architecture technique, design UX/UI, développement sur-mesure et maintenance évolutive : 
            une approche 360° pour des projets qui durent et génèrent du ROI
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div 
            v-for="service in services" 
            :key="service.title"
            class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 group border-t-4"
            :class="service.borderColor"
          >
            <div 
              class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg bg-gradient-to-br"
              :class="service.iconGradient"
            >
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="service.icon" />
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-dark dark:text-white mb-4">{{ service.title }}</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">
              {{ service.description }}
            </p>
            <NuxtLink 
              :to="service.link" 
              class="font-semibold hover:underline inline-flex items-center group/link"
              :class="service.linkColor"
            >
              En savoir plus 
              <svg class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </NuxtLink>
          </div>
        </div>
      </div>
    </section>

    <!-- Processus Timeline -->
    <section id="processus" class="py-24 bg-white dark:bg-dark transition-colors duration-300">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
          <div class="inline-block mb-4">
            <span class="bg-secondary/10 dark:bg-secondary/20 text-secondary px-4 py-2 rounded-full text-sm font-bold">
              NOTRE MÉTHODE
            </span>
          </div>
          <h2 class="text-4xl md:text-6xl font-black text-dark dark:text-white mb-4">
            Comment nous travaillons
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
            Un processus transparent, des points réguliers, zéro mauvaise surprise
          </p>
        </div>

        <div class="relative max-w-5xl mx-auto">
          <!-- Timeline line -->
          <div class="absolute left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-primary via-accent to-secondary transform -translate-x-1/2 hidden md:block"></div>

          <!-- Steps -->
          <div 
            v-for="(step, index) in processSteps" 
            :key="step.title"
            class="relative mb-16 last:mb-0"
          >
            <div 
              class="md:flex items-center"
              :class="index % 2 === 0 ? '' : 'flex-row-reverse'"
            >
              <!-- Card -->
              <div 
                class="md:w-1/2 mb-8 md:mb-0"
                :class="index % 2 === 0 ? 'md:pr-12 md:text-right' : 'md:pl-12'"
              >
                <div class="inline-block bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                  <!-- Icon -->
                  <div 
                    class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 shadow-lg bg-gradient-to-br mx-auto"
                    :class="[step.iconGradient, index % 2 === 0 ? 'md:ml-auto md:mr-0' : 'md:mr-auto md:ml-0']"
                  >
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="step.icon" />
                    </svg>
                  </div>
                  
                  <h3 class="text-2xl font-bold text-dark dark:text-white mb-3">
                    {{ index + 1 }}. {{ step.title }}
                  </h3>
                  <p class="text-gray-600 dark:text-gray-300 mb-4">
                    {{ step.description }}
                  </p>
                  <div 
                    class="text-sm font-semibold"
                    :class="step.durationColor"
                  >
                    ⏱ {{ step.duration }}
                  </div>
                </div>
              </div>

              <!-- Center badge -->
              <div 
                class="absolute left-1/2 w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-2xl transform -translate-x-1/2 hidden md:flex bg-gradient-to-br"
                :class="step.badgeGradient"
              >
                {{ index + 1 }}
              </div>

              <!-- Empty space for alternating layout -->
              <div 
                class="md:w-1/2"
                :class="index % 2 === 0 ? 'md:pl-12' : 'md:pr-12'"
              ></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Us Section -->
    <section class="py-20 bg-gradient-to-br from-primary/5 via-accent/5 to-secondary/5 dark:from-primary/10 dark:via-accent/10 dark:to-secondary/10 transition-colors duration-300">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
          <div>
            <div class="inline-block mb-4">
              <span class="bg-accent/10 dark:bg-accent/20 text-accent px-4 py-2 rounded-full text-sm font-semibold">
                Nos atouts
              </span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-dark dark:text-white mb-6">
              Ce qui fait la différence AS-Turing
            </h2>
            <div class="space-y-6">
              <div 
                v-for="advantage in advantages" 
                :key="advantage.title"
                class="flex items-start bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 group"
              >
                <div 
                  class="flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center mr-4 bg-gradient-to-br group-hover:scale-110 transition-transform"
                  :class="advantage.iconGradient"
                >
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="text-xl font-bold text-dark dark:text-white mb-2">
                    {{ advantage.title }}
                  </h3>
                  <p class="text-gray-600 dark:text-gray-300">
                    {{ advantage.description }}
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-br from-primary via-accent to-secondary rounded-3xl blur-3xl opacity-20"></div>
            <div class="relative bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-2xl">
              <div class="bg-gradient-to-br from-primary/10 via-accent/10 to-secondary/10 dark:from-primary/20 dark:via-accent/20 dark:to-secondary/20 h-96 rounded-2xl flex items-center justify-center">
                <p class="text-gray-500 dark:text-gray-400 text-lg text-center px-4">
                  [ Photo professionnelle / Illustration workspace ]
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Clients Logos Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900 overflow-hidden transition-colors duration-300">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="text-center">
          <h2 class="text-3xl font-bold text-dark dark:text-white mb-2">
            Ils nous ont fait confiance
          </h2>
          <p class="text-gray-600 dark:text-gray-400">
            PME, artisans et startups de Nouvelle-Aquitaine
          </p>
        </div>
      </div>

      <div class="relative">
        <!-- Gradient overlays pour smooth edges -->
        <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-gray-50 dark:from-gray-900 to-transparent z-10 pointer-events-none"></div>
        <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-gray-50 dark:from-gray-900 to-transparent z-10 pointer-events-none"></div>
        
        <!-- Logos slider -->
        <div class="flex gap-12 animate-scroll">
          <div class="flex gap-12 shrink-0">
            <div 
              v-for="client in clients" 
              :key="client.name"
              class="w-48 h-24 bg-white dark:bg-gray-800 rounded-2xl shadow-md flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 hover:scale-105 group"
            >
              <span class="text-2xl font-bold text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors">
                {{ client.name }}
              </span>
            </div>
          </div>
          <!-- Duplicate pour loop infini -->
          <div class="flex gap-12 shrink-0" aria-hidden="true">
            <div 
              v-for="client in clients" 
              :key="'dup-' + client.name"
              class="w-48 h-24 bg-white dark:bg-gray-800 rounded-2xl shadow-md flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 hover:scale-105 group"
            >
              <span class="text-2xl font-bold text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors">
                {{ client.name }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Portfolio Section -->
    <section id="projets" class="py-20 bg-white dark:bg-dark transition-colors duration-300">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <div class="inline-block mb-4">
            <span class="bg-coral/10 dark:bg-coral/20 text-coral px-4 py-2 rounded-full text-sm font-semibold">
              Portfolio
            </span>
          </div>
          <h2 class="text-4xl md:text-5xl font-bold text-dark dark:text-white mb-4">
            Projets réalisés avec excellence
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
            Découvrez quelques réalisations qui illustrent notre savoir-faire technique et créatif
          </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
          <div 
            v-for="project in projects" 
            :key="project.title"
            class="rounded-3xl overflow-hidden shadow-2xl group hover:scale-105 transition-all duration-300 bg-gradient-to-br"
            :class="project.bgGradient"
          >
            <!-- Image -->
            <div 
              class="h-64 flex items-center justify-center relative overflow-hidden bg-gradient-to-br"
              :class="project.imageGradient"
            >
              <div class="absolute inset-0 bg-black/20"></div>
              <p class="text-white text-lg relative z-10">{{ project.imageText }}</p>
            </div>
            
            <!-- Content -->
            <div class="p-8">
              <div class="flex items-center gap-2 mb-3">
                <div 
                  class="w-2 h-2 rounded-full"
                  :class="project.dotColor"
                ></div>
                <span 
                  class="text-sm font-semibold"
                  :class="project.categoryColor"
                >
                  {{ project.category }}
                </span>
              </div>
              
              <h3 class="text-2xl font-bold text-white mb-3">
                {{ project.title }}
              </h3>
              
              <p 
                class="mb-6"
                :class="project.descColor"
              >
                {{ project.description }}
              </p>
              
              <div class="flex flex-wrap gap-2 mb-6">
                <span 
                  v-for="tech in project.technologies" 
                  :key="tech"
                  class="px-3 py-1 rounded-full text-sm"
                  :class="project.techClass"
                >
                  {{ tech }}
                </span>
              </div>
              
              <NuxtLink 
                :to="project.link"
                class="font-semibold hover:underline inline-flex items-center group/link"
                :class="project.linkColor"
              >
                Voir le projet 
                <svg class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
              </NuxtLink>
            </div>
          </div>
        </div>

        <div class="text-center mt-12">
          <NuxtLink
            to="/projets"
            class="inline-block bg-gradient-to-r from-primary to-secondary text-white px-10 py-4 rounded-full font-semibold hover:shadow-xl transition-all duration-300 hover:scale-105"
          >
            Voir tous les projets →
          </NuxtLink>
        </div>
      </div>
    </section>

    <!-- Blog Section -->
    <section class="py-20 bg-white dark:bg-dark transition-colors duration-300">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <div class="inline-block mb-4">
            <span class="bg-secondary/10 dark:bg-secondary/20 text-secondary px-4 py-2 rounded-full text-sm font-semibold">
              Blog
            </span>
          </div>
          <h2 class="text-4xl md:text-5xl font-bold text-dark dark:text-white mb-4">
            Actualités & Conseils
          </h2>
          <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
            Retrouvez nos derniers articles sur le web et le développement
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <div 
            v-for="article in blogArticles" 
            :key="article.title"
            class="group"
          >
            <!-- Article avec contenu -->
            <NuxtLink 
              v-if="article.slug"
              :to="`/blog/${article.slug}`"
              class="block bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2"
            >
              <!-- Image -->
              <div 
                class="h-48 bg-gradient-to-br relative overflow-hidden"
                :class="article.imageGradient"
              >
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                  <p class="text-white text-sm">{{ article.imageText }}</p>
                </div>
              </div>
              
              <!-- Content -->
              <div class="p-6">
                <div class="flex items-center gap-2 mb-3">
                  <span 
                    class="px-3 py-1 rounded-full text-xs font-semibold"
                    :class="article.categoryClass"
                  >
                    {{ article.category }}
                  </span>
                  <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{ article.date }}
                  </span>
                </div>
                
                <h3 class="text-xl font-bold text-dark dark:text-white mb-2 group-hover:text-primary dark:group-hover:text-primary transition-colors">
                  {{ article.title }}
                </h3>
                
                <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
                  {{ article.excerpt }}
                </p>
                
                <div class="flex items-center text-primary dark:text-primary font-semibold">
                  Lire la suite
                  <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </div>
              </div>
            </NuxtLink>
            
            <!-- Placeholder pour article à venir -->
            <div 
              v-else
              class="border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-2xl p-12 flex items-center justify-center transition-all duration-300"
              :class="`hover:border-${article.hoverColor}`"
            >
              <div class="text-center">
                <div 
                  class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-4 bg-gradient-to-br"
                  :class="article.iconGradient"
                >
                  <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                  </svg>
                </div>
                <p class="text-gray-500 dark:text-gray-400 font-medium">Article à venir</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- CTA vers le blog -->
        <div class="text-center mt-12">
          <NuxtLink
            to="/blog"
            class="inline-block px-8 py-4 bg-gradient-to-r from-secondary to-accent text-white rounded-full font-semibold hover:shadow-xl transition-all duration-300 hover:scale-105"
          >
            Voir tous les articles →
          </NuxtLink>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-br from-gray-900 to-gray-800 dark:from-gray-950 dark:to-black text-white">
      <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">
          Prêt à démarrer votre projet ?
        </h2>
        <p class="text-xl text-gray-300 mb-12 max-w-2xl mx-auto">
          Discutons de vos besoins et trouvons ensemble la solution adaptée à votre activité.
        </p>
        <NuxtLink
          to="/contact"
          class="inline-block px-8 py-4 bg-gradient-to-r from-primary via-accent to-secondary text-white rounded-full text-lg font-semibold hover:shadow-2xl transform hover:scale-105 transition-all animate-gradient"
        >
          Demander un devis gratuit
        </NuxtLink>
      </div>
    </section>
    <!-- Contact CTA Section -->
    <section id="contact" class="py-20 gradient-hero text-white relative overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl animate-blob animation-delay-2000"></div>
      </div>
      
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">
          Un projet en tête ? Parlons-en
        </h2>
        <p class="text-xl text-white/90 mb-10">
          Audit gratuit de 30min, devis détaillé sous 48h et premier prototype dans la semaine. Sans engagement.
        </p>

        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-12 shadow-2xl">
          <form @submit.prevent="submitContact" class="space-y-6">
            <div class="grid md:grid-cols-2 gap-6">
              <input 
                v-model="contactForm.name"
                type="text" 
                placeholder="Votre nom" 
                required
                class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-primary dark:focus:border-primary outline-none text-dark dark:text-white dark:bg-gray-700 transition"
              >
              <input 
                v-model="contactForm.email"
                type="email" 
                placeholder="Votre email" 
                required
                class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-secondary dark:focus:border-secondary outline-none text-dark dark:text-white dark:bg-gray-700 transition"
              >
            </div>
            
            <input 
              v-model="contactForm.subject"
              type="text" 
              placeholder="Sujet" 
              required
              class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-accent dark:focus:border-accent outline-none text-dark dark:text-white dark:bg-gray-700 transition"
            >
            
            <textarea 
              v-model="contactForm.message"
              rows="5" 
              placeholder="Décrivez votre projet" 
              required
              class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-primary dark:focus:border-primary outline-none text-dark dark:text-white dark:bg-gray-700 resize-none transition"
            ></textarea>
            
            <button 
              type="submit" 
              class="w-full bg-gradient-to-r from-primary to-secondary text-white py-4 rounded-xl font-semibold text-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-gradient"
            >
              Envoyer ma demande
            </button>
          </form>

          <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
            <p class="text-gray-600 dark:text-gray-300 mb-4 font-medium">
              Ou contactez-nous directement :
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-6">
              <a 
                href="mailto:contact@as-turing.fr" 
                class="text-primary dark:text-primary font-semibold hover:underline inline-flex items-center justify-center group"
              >
                <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                contact@as-turing.fr
              </a>
              <a 
                href="tel:+33612345678" 
                class="text-secondary dark:text-secondary font-semibold hover:underline inline-flex items-center justify-center group"
              >
                <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                06 12 34 56 78
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
// Stats
const stats = [
  { value: '15+', label: 'Projets livrés', gradient: 'from-primary to-coral' },
  { value: '100%', label: 'Clients satisfaits', gradient: 'from-accent to-secondary' },
  { value: '3 ans', label: 'D\'expérience', gradient: 'from-coral to-primary' },
  { value: '<24h', label: 'Délai moyen de réponse', gradient: 'from-secondary to-accent' },
]

// Fetch data from API
const { fetchServices, fetchProjects, fetchBlogPosts } = useApi()

const services = ref([])
const projects = ref([])
const blogArticles = ref([])

// Load data on mount
onMounted(async () => {
  services.value = await fetchServices()
  projects.value = await fetchProjects()
  const posts = await fetchBlogPosts()
  
  // Transform blog posts to match frontend structure
  blogArticles.value = posts.map((post: any) => ({
    title: post.title,
    slug: post.slug,
    category: post.category,
    categoryClass: post.categoryClass,
    date: new Date(post.publishedAt).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' }),
    excerpt: post.excerpt,
    imageGradient: post.imageGradient,
    imageText: post.imageText
  }))
})

// Process steps
const processSteps = [
  {
    icon: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
    iconGradient: 'from-primary to-coral',
    title: 'Écoute & Analyse',
    description: 'Compréhension approfondie de vos besoins, objectifs et contraintes. Audit de l\'existant si besoin.',
    duration: '2-3 jours',
    durationColor: 'text-primary dark:text-primary',
    badgeGradient: 'from-primary to-coral'
  },
  {
    icon: 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01',
    iconGradient: 'from-coral to-accent',
    title: 'Conception & Devis',
    description: 'Proposition technique détaillée, maquettes si nécessaire, devis transparent avec paiement échelonné.',
    duration: '2-5 jours',
    durationColor: 'text-coral dark:text-coral',
    badgeGradient: 'from-coral to-accent'
  },
  {
    icon: 'M13 10V3L4 14h7v7l9-11h-7z',
    iconGradient: 'from-accent to-secondary',
    title: 'Développement Agile',
    description: 'Itérations rapides, démos régulières, feedback continu. Vous suivez l\'avancement en temps réel.',
    duration: '2-6 semaines selon projet',
    durationColor: 'text-accent dark:text-accent',
    badgeGradient: 'from-accent to-secondary'
  },
  {
    icon: 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
    iconGradient: 'from-secondary to-primary',
    title: 'Livraison & Suivi',
    description: 'Formation complète, documentation, déploiement sécurisé. Support post-lancement inclus.',
    duration: 'Support 30 jours inclus',
    durationColor: 'text-secondary dark:text-secondary',
    badgeGradient: 'from-secondary to-primary'
  },
]

// Advantages
const advantages = [
  {
    title: 'Engagement contractuel de réactivité',
    description: 'SLA de 24h sur tickets support, disponibilité 6j/7 et astreinte possible pour projets critiques',
    iconGradient: 'from-primary to-coral'
  },
  {
    title: 'Stack technologique dernière génération',
    description: 'Vue.js 3, Nuxt, Symfony 7, headless CMS et architecture cloud-native pour des applications scalables',
    iconGradient: 'from-secondary to-accent'
  },
  {
    title: 'Accompagnement personnalisé',
    description: 'Écoute, conseil et suivi sur-mesure adapté à votre secteur d\'activité',
    iconGradient: 'from-accent to-coral'
  },
  {
    title: 'Tarifs transparents',
    description: 'Devis détaillés, pas de frais cachés, paiement échelonné possible',
    iconGradient: 'from-coral to-primary'
  },
]

// Clients
const clients = [
  { name: 'Client 1' },
  { name: 'Client 2' },
  { name: 'Client 3' },
  { name: 'Client 4' },
  { name: 'Client 5' },
]

const contactForm = ref({
  name: '',
  email: '',
  subject: '',
  message: ''
})

const submitContact = async () => {
  try {
    const { sendContactMessage } = useApi()
    await sendContactMessage(contactForm.value)
    
    // Reset form
    contactForm.value = {
      name: '',
      email: '',
      subject: '',
      message: ''
    }
    alert('Merci pour votre message ! Nous vous répondrons dans les plus brefs délais.')
  } catch (error) {
    alert('Une erreur est survenue. Veuillez réessayer.')
    console.error('Error submitting contact form:', error)
  }
}
</script>

<style scoped>
@keyframes blob {
  0%, 100% {
    transform: translate(0, 0) scale(1);
  }
  33% {
    transform: translate(30px, -50px) scale(1.1);
  }
  66% {
    transform: translate(-20px, 20px) scale(0.9);
  }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}

@keyframes gradient {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

.animate-gradient {
  background-size: 200% 200%;
  animation: gradient 3s ease infinite;
}

@keyframes scroll {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

.animate-scroll {
  animation: scroll 30s linear infinite;
}

.animate-scroll:hover {
  animation-play-state: paused;
}
</style>
