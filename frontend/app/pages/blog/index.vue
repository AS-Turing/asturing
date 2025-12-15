<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <!-- Hero -->
    <section class="pt-32 pb-16 gradient-hero text-white relative overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl animate-blob animation-delay-2000"></div>
      </div>
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="inline-block mb-4">
          <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-semibold border border-white/30">
            📝 Blog
          </span>
        </div>
        <h1 class="text-5xl md:text-6xl font-bold mb-6">
          Blog Agence Web Libourne
        </h1>
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
          Conseils et actualités sur la création de sites internet, l'e-commerce et les stratégies digitales
        </p>
      </div>
    </section>

    <!-- Filters -->
    <section class="py-8 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-20 backdrop-blur-sm bg-white/95 dark:bg-gray-800/95">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-center gap-3">
          <button
            @click="selectedCategory = null"
            :class="[
              'px-6 py-2 rounded-full font-semibold transition-all duration-300',
              selectedCategory === null
                ? 'bg-primary text-white shadow-lg scale-105'
                : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'
            ]"
          >
            Tous les articles ({{ articles?.length || 0 }})
          </button>
          <button
            v-for="category in categories"
            :key="category"
            @click="selectedCategory = category"
            :class="[
              'px-6 py-2 rounded-full font-semibold transition-all duration-300',
              selectedCategory === category
                ? 'bg-primary text-white shadow-lg scale-105'
                : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'
            ]"
          >
            {{ category }} ({{ countByCategory(category) }})
          </button>
        </div>
      </div>
    </section>

    <!-- Articles Grid -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div v-if="filteredArticles.length === 0" class="text-center py-20">
          <Icon name="mdi:file-document-outline" class="w-24 h-24 mx-auto text-gray-300 dark:text-gray-600 mb-4" />
          <p class="text-xl text-gray-600 dark:text-gray-400">Aucun article dans cette catégorie</p>
        </div>

        <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <NuxtLink
            v-for="article in filteredArticles"
            :key="article.id"
            :to="`/blog/${article.slug}`"
            class="group bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
          >
            <!-- Image -->
            <div class="relative h-56 overflow-hidden">
              <div 
                class="absolute inset-0 flex items-center justify-center text-white text-6xl font-bold gradient-hero transition-all duration-300 group-hover:scale-110"
                :class="article.imageGradient"
              >
                {{ article.imageText }}
              </div>
              <div class="absolute top-4 left-4">
                <span :class="`px-3 py-1 rounded-full text-xs font-semibold ${article.categoryClass}`">
                  {{ article.category }}
                </span>
              </div>
            </div>

            <!-- Content -->
            <div class="p-6">
              <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-3">
                <Icon name="mdi:calendar" class="w-4 h-4" />
                <span>{{ article.date }}</span>
              </div>
              
              <h3 class="text-xl font-bold text-dark dark:text-white mb-3 group-hover:text-primary dark:group-hover:text-primary transition-colors line-clamp-2">
                {{ article.title }}
              </h3>
              
              <p class="text-gray-600 dark:text-gray-300 mb-6 line-clamp-3">
                {{ article.excerpt }}
              </p>
              
              <div class="flex items-center gap-2 text-primary dark:text-primary font-semibold">
                Lire la suite
                <Icon name="mdi:arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform" />
              </div>
            </div>
          </NuxtLink>
        </div>
      </div>
    </section>

    <!-- CTA Contact -->
    <ServiceCTA 
      title="Un projet web en tête ?"
      subtitle="Échangeons sur vos besoins et démarrons votre projet ensemble. Audit gratuit et devis sous 48h."
      primaryButtonText="Démarrer un projet"
    />
  </div>
</template>

<script setup lang="ts">
const { fetchBlogPosts } = useApi()
const rawArticles = ref([])

onMounted(async () => {
  rawArticles.value = await fetchBlogPosts()
})

const selectedCategory = ref<string | null>(null)

const articles = computed(() => {
  if (!rawArticles.value) return []
  
  return rawArticles.value.map((post: any) => ({
    id: post.id,
    title: post.title,
    slug: post.slug,
    category: post.category,
    categoryClass: post.categoryClass,
    date: new Date(post.publishedAt).toLocaleDateString('fr-FR', { 
      day: 'numeric', 
      month: 'long', 
      year: 'numeric' 
    }),
    excerpt: post.excerpt,
    imageGradient: post.imageGradient,
    imageText: post.imageText
  }))
})

const categories = computed(() => {
  if (!articles.value) return []
  return [...new Set(articles.value.map((a: any) => a.category))]
})

const filteredArticles = computed(() => {
  if (!selectedCategory.value) return articles.value
  return articles.value.filter((a: any) => a.category === selectedCategory.value)
})

const countByCategory = (category: string) => {
  return articles.value.filter((a: any) => a.category === category).length
}

useHead({
  title: 'Blog Création Site Internet Libourne | Conseils E-commerce & Web',
  meta: [
    {
      name: 'description',
      content: 'Blog agence web Libourne : conseils création de sites internet, stratégies e-commerce, référencement SEO, bonnes pratiques digitales.'
    },
    // Keywords
    {
      name: 'keywords',
      content: 'blog création site internet, conseils e-commerce, agence web Libourne, SEO, site vitrine, boutique en ligne, stratégie digitale'
    },
    // Open Graph
    {
      property: 'og:title',
      content: 'Blog Création Site Internet - Conseils & Actualités | AS-Turing'
    },
    {
      property: 'og:description',
      content: 'Conseils d\'expert pour votre site internet : création, e-commerce, référencement et stratégies digitales efficaces.'
    },
    {
      property: 'og:type',
      content: 'blog'
    },
    // Robots
    {
      name: 'robots',
      content: 'index, follow'
    }
  ],
  // Schema.org Blog
  script: [
    {
      type: 'application/ld+json',
      children: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'Blog',
        'name': 'Blog AS-Turing',
        'description': 'Blog sur la création de sites internet, l\'e-commerce et les stratégies digitales',
        'url': 'https://www.as-turing.fr/blog',
        'publisher': {
          '@type': 'Organization',
          'name': 'AS-Turing',
          'logo': {
            '@type': 'ImageObject',
            'url': 'https://www.as-turing.fr/logo.png'
          }
        },
        'inLanguage': 'fr-FR'
      })
    }
  ]
})
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

@keyframes blob {
  0%, 100% { transform: translateY(0px) scale(1); }
  50% { transform: translateY(-20px) scale(1.1); }
}

.animate-blob {
  animation: blob 6s ease-in-out infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}
</style>
