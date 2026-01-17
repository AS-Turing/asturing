<template>
  <section v-if="articles.length > 0" class="py-20 bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <div class="inline-block mb-4">
          <span class="bg-primary/10 dark:bg-primary/20 text-primary px-4 py-2 rounded-full text-sm font-semibold">
            Blog
          </span>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-dark dark:text-white mb-6">
          Actualités & Conseils
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
          Nos derniers articles sur le développement web et la tech
        </p>
      </div>

      <div class="grid md:grid-cols-3 gap-8">
        <NuxtLink
          v-for="article in articles.slice(0, 3)"
          :key="article.slug"
          :to="article.slug ? `/blog/${article.slug}` : '#'"
          class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
        >
          <!-- Image -->
          <div class="relative h-48 overflow-hidden">
            <img 
              v-if="article.ogImage"
              :src="article.ogImage"
              :alt="article.title"
              class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
            />
            <div 
              v-else
              class="absolute inset-0 flex items-center justify-center text-white font-semibold gradient-hero"
              :class="article.imageGradient"
            >
              {{ article.imageText }}
            </div>
            <div v-if="article.category" class="absolute top-4 left-4">
              <span :class="`px-3 py-1 rounded-full text-xs font-semibold ${article.categoryClass}`">
                {{ article.category }}
              </span>
            </div>
          </div>

          <!-- Content -->
          <div class="p-6">
            <div v-if="article.date" class="text-sm text-gray-500 dark:text-gray-400 mb-2">
              {{ article.date }}
            </div>
            <h3 class="text-xl font-bold text-dark dark:text-white mb-3 group-hover:text-primary dark:group-hover:text-primary transition-colors">
              {{ article.title }}
            </h3>
            <p v-if="article.excerpt" class="text-gray-600 dark:text-gray-300 mb-4">
              {{ article.excerpt }}
            </p>
            <div class="flex items-center gap-2 text-primary dark:text-primary font-semibold">
              Lire la suite
              <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
              </svg>
            </div>
          </div>
        </NuxtLink>
      </div>

      <div class="text-center mt-12">
        <NuxtLink
          to="/blog"
          class="inline-flex items-center gap-2 px-8 py-4 gradient-hero from-primary to-secondary text-white rounded-full font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300"
        >
          Voir tous les articles
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
          </svg>
        </NuxtLink>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
const { fetchBlogPosts } = useApi()
const rawArticles = ref([])

onMounted(async () => {
  rawArticles.value = await fetchBlogPosts()
})

const articles = computed(() => {
  if (!rawArticles.value) return []
  
  return rawArticles.value.map((post: any) => ({
    title: post.title,
    slug: post.slug,
    category: post.category,
    categoryClass: 'bg-primary/10 text-primary',
    date: new Date(post.publishedAt).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' }),
    excerpt: post.excerpt,
    ogImage: post.ogImage,
    imageGradient: 'from-primary to-secondary',
    imageText: post.title.substring(0, 2).toUpperCase()
  }))
})
</script>
