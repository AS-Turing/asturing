<template>
  <div v-if="formattedArticle" class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <!-- Hero -->
    <section class="pt-32 pb-16 gradient-hero text-white relative overflow-hidden">
      <div class="absolute inset-0 opacity-20">
        <div 
          class="absolute inset-0 gradient-hero"
          :class="formattedArticle.imageGradient"
        ></div>
      </div>
      
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb -->
        <nav class="mb-8">
          <ol class="flex items-center gap-2 text-white/80">
            <li><NuxtLink to="/" class="hover:text-white transition">Accueil</NuxtLink></li>
            <li>/</li>
            <li><NuxtLink to="/blog" class="hover:text-white transition">Blog</NuxtLink></li>
            <li>/</li>
            <li class="text-white font-semibold">{{ formattedArticle.title }}</li>
          </ol>
        </nav>

        <!-- Category -->
        <div class="mb-4">
          <span :class="`px-4 py-2 rounded-full text-sm font-semibold ${formattedArticle.categoryClass}`">
            {{ formattedArticle.category }}
          </span>
        </div>

        <!-- Title -->
        <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
          {{ formattedArticle.title }}
        </h1>

        <!-- Meta -->
        <div class="flex flex-wrap items-center gap-6 text-white/90">
          <div class="flex items-center gap-2">
            <Icon name="mdi:calendar" class="w-5 h-5" />
            <span>{{ formattedArticle.date }}</span>
          </div>
          <div class="flex items-center gap-2">
            <Icon name="mdi:clock-outline" class="w-5 h-5" />
            <span>{{ readingTime }} min de lecture</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Content -->
    <article class="py-16">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Excerpt -->
        <div class="mb-12">
          <p class="text-2xl text-gray-700 dark:text-gray-300 leading-relaxed font-medium">
            {{ formattedArticle.excerpt }}
          </p>
        </div>

        <!-- Main content -->
        <div 
          class="prose prose-lg dark:prose-invert max-w-none
                 prose-headings:font-bold prose-headings:text-dark dark:prose-headings:text-white
                 prose-h2:text-3xl prose-h2:mt-12 prose-h2:mb-6
                 prose-h3:text-2xl prose-h3:mt-8 prose-h3:mb-4
                 prose-p:text-gray-700 dark:prose-p:text-gray-300 prose-p:leading-relaxed prose-p:mb-6
                 prose-a:text-primary prose-a:no-underline hover:prose-a:underline
                 prose-strong:text-dark dark:prose-strong:text-white prose-strong:font-bold
                 prose-ul:my-6 prose-li:text-gray-700 dark:prose-li:text-gray-300
                 prose-code:text-primary prose-code:bg-gray-100 dark:prose-code:bg-gray-800 prose-code:px-2 prose-code:py-1 prose-code:rounded
                 bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-12 shadow-lg"
          v-html="formattedArticle.content"
        ></div>

        <!-- Share -->
        <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
          <h3 class="text-xl font-bold text-dark dark:text-white mb-4">Partager cet article</h3>
          <div class="flex gap-4">
            <a
              :href="`https://twitter.com/intent/tweet?text=${encodeURIComponent(formattedArticle.title)}&url=${currentUrl}`"
              target="_blank"
              rel="noopener noreferrer"
              class="flex items-center gap-2 px-6 py-3 bg-black text-white rounded-full font-semibold hover:bg-gray-800 transition-all hover:scale-105"
            >
              <Icon name="mdi:twitter" class="w-5 h-5" />
              Twitter
            </a>
            <a
              :href="`https://www.linkedin.com/sharing/share-offsite/?url=${currentUrl}`"
              target="_blank"
              rel="noopener noreferrer"
              class="flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition-all hover:scale-105"
            >
              <Icon name="mdi:linkedin" class="w-5 h-5" />
              LinkedIn
            </a>
            <button
              @click="copyLink"
              class="flex items-center gap-2 px-6 py-3 bg-gray-200 dark:bg-gray-700 text-dark dark:text-white rounded-full font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-all hover:scale-105"
            >
              <Icon :name="copied ? 'mdi:check' : 'mdi:link'" class="w-5 h-5" />
              {{ copied ? 'Copié !' : 'Copier le lien' }}
            </button>
          </div>
        </div>
      </div>
    </article>

    <!-- Related Articles -->
    <section v-if="relatedArticles.length > 0" class="py-16 bg-white dark:bg-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-dark dark:text-white mb-12 text-center">
          Articles similaires
        </h2>

        <div class="grid md:grid-cols-3 gap-8">
          <NuxtLink
            v-for="related in relatedArticles"
            :key="related.id"
            :to="`/blog/${related.slug}`"
            class="group bg-gray-50 dark:bg-gray-900 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
          >
            <div class="relative h-48 overflow-hidden">
              <div 
                class="absolute inset-0 flex items-center justify-center text-white text-4xl font-bold gradient-hero transition-all duration-300 group-hover:scale-110"
                :class="related.imageGradient"
              >
                {{ related.imageText }}
              </div>
            </div>
            <div class="p-6">
              <span :class="`px-3 py-1 rounded-full text-xs font-semibold ${related.categoryClass}`">
                {{ related.category }}
              </span>
              <h3 class="text-xl font-bold text-dark dark:text-white mt-4 mb-2 group-hover:text-primary transition-colors line-clamp-2">
                {{ related.title }}
              </h3>
              <p class="text-gray-600 dark:text-gray-400 text-sm">{{ related.date }}</p>
            </div>
          </NuxtLink>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <ServiceCTA 
      title="Un projet web en tête ?"
      subtitle="Échangeons sur vos besoins et démarrons votre projet ensemble. Audit gratuit et devis sous 48h."
      primaryButtonText="Démarrer un projet"
    />
  </div>

  <!-- 404 -->
  <div v-else class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">
    <div class="text-center">
      <Icon name="mdi:file-document-alert-outline" class="w-32 h-32 mx-auto text-gray-300 dark:text-gray-600 mb-6" />
      <h1 class="text-4xl font-bold text-dark dark:text-white mb-4">Article introuvable</h1>
      <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">Cet article n'existe pas ou a été supprimé.</p>
      <NuxtLink to="/blog" class="inline-flex items-center gap-2 px-8 py-4 bg-primary text-white rounded-full font-semibold hover:bg-primary/90 transition">
        <Icon name="mdi:arrow-left" class="w-5 h-5" />
        Retour au blog
      </NuxtLink>
    </div>
  </div>
</template>

<script setup lang="ts">
const route = useRoute()
const slug = route.params.slug as string

// Fetch article
const { data: article, error } = await useFetch(`/api/blog/${slug}`)

// Fetch all articles for related section
const { data: rawArticles } = await useFetch('/api/blog')

const formattedArticle = computed(() => {
  if (!article.value) return null
  
  return {
    id: article.value.id,
    title: article.value.title,
    slug: article.value.slug,
    category: article.value.category,
    categoryClass: article.value.categoryClass,
    date: new Date(article.value.publishedAt).toLocaleDateString('fr-FR', { 
      day: 'numeric', 
      month: 'long', 
      year: 'numeric' 
    }),
    excerpt: article.value.excerpt,
    content: article.value.content,
    imageGradient: article.value.imageGradient,
    imageText: article.value.imageText
  }
})

// Reading time estimation (200 words per minute)
const readingTime = computed(() => {
  if (!formattedArticle.value?.content) return 5
  const words = formattedArticle.value.content.replace(/<[^>]*>/g, '').split(/\s+/).length
  return Math.ceil(words / 200)
})

// Related articles (same category, max 3)
const relatedArticles = computed(() => {
  if (!rawArticles.value || !formattedArticle.value) return []
  
  return rawArticles.value
    .filter((post: any) => post.category === formattedArticle.value.category && post.slug !== slug)
    .slice(0, 3)
    .map((post: any) => ({
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
      imageGradient: post.imageGradient,
      imageText: post.imageText
    }))
})

// Share functionality
const copied = ref(false)
const currentUrl = computed(() => {
  if (process.client) {
    return window.location.href
  }
  return ''
})

const copyLink = async () => {
  if (process.client) {
    await navigator.clipboard.writeText(currentUrl.value)
    copied.value = true
    setTimeout(() => {
      copied.value = false
    }, 2000)
  }
}

// SEO
useHead({
  title: formattedArticle.value ? `${formattedArticle.value.title} - Blog AS-Turing` : 'Article introuvable',
  meta: formattedArticle.value ? [
    {
      name: 'description',
      content: formattedArticle.value.excerpt
    },
    {
      property: 'og:title',
      content: formattedArticle.value.title
    },
    {
      property: 'og:description',
      content: formattedArticle.value.excerpt
    },
    {
      property: 'og:type',
      content: 'article'
    }
  ] : []
})
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
