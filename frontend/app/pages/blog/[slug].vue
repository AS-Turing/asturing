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
                 bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-12 shadow-lg
                 blog-content"
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
    imageText: article.value.imageText,
    metaTitle: article.value.metaTitle,
    metaDescription: article.value.metaDescription,
    metaKeywords: article.value.metaKeywords,
    ogImage: article.value.ogImage
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

// SEO Premium AAA pour Article avec Schema BlogPosting
watch(formattedArticle, (newArticle) => {
  if (newArticle) {
    usePremiumSeo({
      title: newArticle.metaTitle || `${newArticle.title} - Blog AS-Turing`,
      description: newArticle.metaDescription || newArticle.excerpt,
      url: `https://as-turing.fr/blog/${newArticle.slug}`,
      image: newArticle.ogImage || 'https://as-turing.fr/images/og-blog.jpg',
      type: 'article',
      article: {
        publishedTime: article.value?.publishedAt,
        modifiedTime: article.value?.updatedAt,
        author: 'AS-Turing',
        section: newArticle.category,
        tags: newArticle.tags || []
      },
      breadcrumbs: [
        { name: 'Accueil', url: '/' },
        { name: 'Blog', url: '/blog' },
        { name: newArticle.title, url: `/blog/${newArticle.slug}` }
      ]
    })
    
    // Keywords meta
    useHead({
      meta: [
        {
          name: 'keywords',
          content: newArticle.metaKeywords || `${newArticle.category}, blog développement web, ${newArticle.slug}`
        }
      ]
    })
  }
}, { immediate: true })
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Blog content styling - ULTRA PREMIUM */
.blog-content :deep(h2) {
  font-size: 2.25rem;
  font-weight: 800;
  color: var(--color-dark);
  margin-top: 4rem;
  margin-bottom: 2rem;
  padding-bottom: 1rem;
  border-bottom: 3px solid transparent;
  background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
  background-size: 100% 3px;
  background-repeat: no-repeat;
  background-position: bottom;
  letter-spacing: -0.02em;
  position: relative;
}

.blog-content :deep(h2::before) {
  content: "";
  position: absolute;
  left: -1.5rem;
  top: 0.5rem;
  width: 4px;
  height: 2rem;
  background: linear-gradient(180deg, var(--color-primary), var(--color-coral));
  border-radius: 2px;
}

.dark .blog-content :deep(h2) {
  color: white;
}

.blog-content :deep(h3) {
  font-size: 1.75rem;
  font-weight: 700;
  color: var(--color-dark);
  margin-top: 3rem;
  margin-bottom: 1.5rem;
  position: relative;
  padding-left: 1.5rem;
}

.blog-content :deep(h3::before) {
  content: "";
  position: absolute;
  left: 0;
  top: 0.5rem;
  width: 6px;
  height: 1.5rem;
  background: var(--color-primary);
  border-radius: 3px;
}

.dark .blog-content :deep(h3) {
  color: white;
}

.blog-content :deep(h4) {
  font-size: 1.375rem;
  font-weight: 600;
  color: var(--color-primary);
  margin-top: 2rem;
  margin-bottom: 1rem;
}

.dark .blog-content :deep(h4) {
  color: var(--color-secondary);
}

.blog-content :deep(p) {
  color: #1f2937;
  line-height: 1.9;
  margin-bottom: 1.75rem;
  font-size: 1.125rem;
  font-weight: 400;
  letter-spacing: 0.01em;
}

.dark .blog-content :deep(p) {
  color: #e5e7eb;
}

.blog-content :deep(p:first-of-type) {
  font-size: 1.25rem;
  line-height: 2;
  color: #374151;
  font-weight: 500;
}

.dark .blog-content :deep(p:first-of-type) {
  color: #d1d5db;
}

.blog-content :deep(a) {
  color: var(--color-primary);
  font-weight: 600;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  text-decoration: none;
  border-bottom: 2px solid transparent;
  padding-bottom: 1px;
}

.blog-content :deep(a:hover) {
  border-bottom-color: var(--color-primary);
  color: var(--color-secondary);
}

.blog-content :deep(strong) {
  color: var(--color-dark);
  font-weight: 700;
  background: linear-gradient(120deg, rgba(var(--color-primary-rgb), 0.1) 0%, rgba(var(--color-secondary-rgb), 0.1) 100%);
  padding: 0.125rem 0.375rem;
  border-radius: 0.25rem;
}

.dark .blog-content :deep(strong) {
  color: white;
  background: linear-gradient(120deg, rgba(var(--color-primary-rgb), 0.2) 0%, rgba(var(--color-secondary-rgb), 0.2) 100%);
}

.blog-content :deep(em) {
  font-style: italic;
  color: #6b7280;
  font-weight: 500;
}

.dark .blog-content :deep(em) {
  color: #9ca3af;
}

.blog-content :deep(ul) {
  margin: 2rem 0;
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.blog-content :deep(ol) {
  margin: 2rem 0;
  list-style: none;
  counter-reset: blog-counter;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.blog-content :deep(ol li) {
  counter-increment: blog-counter;
  position: relative;
  padding-left: 3rem;
}

.blog-content :deep(ol li::before) {
  content: counter(blog-counter);
  position: absolute;
  left: 0;
  top: 0;
  width: 2rem;
  height: 2rem;
  background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
  color: white;
  font-weight: 700;
  font-size: 0.875rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.blog-content :deep(li) {
  color: #1f2937;
  font-size: 1.125rem;
  line-height: 1.8;
  padding: 0.75rem 1rem 0.75rem 3rem;
  background: linear-gradient(135deg, rgba(var(--color-primary-rgb), 0.02) 0%, rgba(var(--color-secondary-rgb), 0.02) 100%);
  border-radius: 0.75rem;
  border-left: 3px solid transparent;
  transition: all 0.3s ease;
}

.blog-content :deep(li:hover) {
  border-left-color: var(--color-primary);
  background: linear-gradient(135deg, rgba(var(--color-primary-rgb), 0.05) 0%, rgba(var(--color-secondary-rgb), 0.05) 100%);
  transform: translateX(4px);
}

.dark .blog-content :deep(li) {
  color: #e5e7eb;
  background: linear-gradient(135deg, rgba(var(--color-primary-rgb), 0.05) 0%, rgba(var(--color-secondary-rgb), 0.05) 100%);
}

.blog-content :deep(ul li) {
  position: relative;
}

.blog-content :deep(ul li::before) {
  content: "→";
  position: absolute;
  left: 1rem;
  top: 0.75rem;
  color: var(--color-primary);
  font-weight: 700;
  font-size: 1.25rem;
}

.blog-content :deep(blockquote) {
  border-left: 4px solid var(--color-primary);
  background: linear-gradient(135deg, rgba(var(--color-primary-rgb), 0.08) 0%, rgba(var(--color-secondary-rgb), 0.08) 100%);
  padding: 2rem 2rem 2rem 3rem;
  margin: 3rem 0;
  font-style: italic;
  color: #1f2937;
  border-radius: 0 1rem 1rem 0;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
  position: relative;
  font-size: 1.25rem;
  line-height: 1.8;
}

.blog-content :deep(blockquote::before) {
  content: "";
  position: absolute;
  left: 1rem;
  top: 0.5rem;
  font-size: 4rem;
  color: var(--color-primary);
  opacity: 0.3;
  font-family: Georgia, serif;
  line-height: 1;
}

.dark .blog-content :deep(blockquote) {
  background: linear-gradient(135deg, rgba(var(--color-primary-rgb), 0.15) 0%, rgba(var(--color-secondary-rgb), 0.15) 100%);
  color: #e5e7eb;
}

.blog-content :deep(code) {
  color: var(--color-primary);
  background: linear-gradient(135deg, rgba(var(--color-primary-rgb), 0.1), rgba(var(--color-secondary-rgb), 0.1));
  padding: 0.25rem 0.625rem;
  border-radius: 0.375rem;
  font-size: 0.9375rem;
  font-family: 'SF Mono', 'Monaco', 'Inconsolata', monospace;
  font-weight: 600;
  border: 1px solid rgba(var(--color-primary-rgb), 0.2);
}

.dark .blog-content :deep(code) {
  background: linear-gradient(135deg, rgba(var(--color-primary-rgb), 0.2), rgba(var(--color-secondary-rgb), 0.2));
  border-color: rgba(var(--color-primary-rgb), 0.3);
}

.blog-content :deep(pre) {
  background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
  color: #f1f5f9;
  padding: 2rem;
  border-radius: 1rem;
  overflow-x: auto;
  margin: 3rem 0;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  border: 1px solid rgba(148, 163, 184, 0.1);
}

.blog-content :deep(pre code) {
  background: transparent;
  color: #f1f5f9;
  padding: 0;
  border: none;
  font-size: 0.9375rem;
  line-height: 1.7;
}

.blog-content :deep(img) {
  border-radius: 1rem;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  margin: 3rem 0;
  width: 100%;
  border: 1px solid rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.blog-content :deep(img:hover) {
  transform: scale(1.02);
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
}

.blog-content :deep(table) {
  width: 100%;
  margin: 3rem 0;
  border-collapse: separate;
  border-spacing: 0;
  border-radius: 1rem;
  overflow: hidden;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.blog-content :deep(th) {
  background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
  color: white;
  border: none;
  padding: 1rem 1.5rem;
  font-weight: 700;
  text-align: left;
  font-size: 0.9375rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.blog-content :deep(td) {
  border-bottom: 1px solid #e5e7eb;
  padding: 1rem 1.5rem;
  background: white;
}

.blog-content :deep(tbody tr:hover td) {
  background: rgba(var(--color-primary-rgb), 0.02);
}

.dark .blog-content :deep(td) {
  border-bottom-color: #374151;
  background: #1f2937;
}

.dark .blog-content :deep(tbody tr:hover td) {
  background: rgba(var(--color-primary-rgb), 0.1);
}

.blog-content :deep(hr) {
  margin: 4rem 0;
  border: none;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--color-primary), var(--color-secondary), transparent);
  opacity: 0.3;
}

.dark .blog-content :deep(hr) {
  opacity: 0.2;
}
</style>
