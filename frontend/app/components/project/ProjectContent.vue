<template>
  <div v-if="content && content.sections" class="space-y-0">
    <section 
      v-for="(section, sectionIndex) in content.sections" 
      :key="sectionIndex"
      class="py-20"
      :class="{
        'bg-white dark:bg-dark': section.bgColor === 'white',
        'bg-gradient-to-br from-gray-50 to-white dark:from-dark-lighter dark:to-dark': section.bgColor === 'gray',
        'bg-gradient-to-br from-primary/5 to-secondary/5 dark:from-primary/10 dark:to-secondary/10': section.bgColor === 'gradient'
      }"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Titre de section -->
        <div v-if="section.title" class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-dark dark:text-white mb-4">
            {{ section.title }}
          </h2>
        </div>

        <!-- Blocs de la section -->
        <div v-if="section.blocks && section.blocks.length > 0" class="space-y-16">
          <div 
            v-for="(block, blockIndex) in section.blocks" 
            :key="blockIndex"
          >
            <!-- Bloc text_image -->
            <div v-if="block.type === 'text_image'" class="grid lg:grid-cols-2 gap-8 items-center">
              <!-- Image à gauche -->
              <div v-if="block.layout === 'image_left'" class="order-1">
                <div class="relative h-80 lg:h-96 rounded-3xl overflow-hidden shadow-xl">
                  <img 
                    v-if="block.image"
                    :src="block.image"
                    :alt="projectTitle"
                    class="absolute inset-0 w-full h-full object-cover"
                  />
                  <div 
                    v-else
                    class="absolute inset-0 flex items-center justify-center text-white text-lg font-semibold gradient-hero"
                    :class="imageGradient"
                  >
                    {{ imageText }}
                  </div>
                </div>
              </div>

              <!-- Contenu texte -->
              <div 
                :class="block.layout === 'image_left' ? 'order-2' : 'order-1'"
                class="prose prose-lg max-w-none text-dark dark:text-white" 
                v-html="block.content"
              ></div>

              <!-- Image à droite -->
              <div v-if="block.layout === 'image_right'" class="order-2">
                <div class="relative h-80 lg:h-96 rounded-3xl overflow-hidden shadow-xl">
                  <img 
                    v-if="block.image"
                    :src="block.image"
                    :alt="projectTitle"
                    class="absolute inset-0 w-full h-full object-cover"
                  />
                  <div 
                    v-else
                    class="absolute inset-0 flex items-center justify-center text-white text-lg font-semibold gradient-hero from-primary to-secondary"
                  >
                    {{ imageText }}
                  </div>
                </div>
              </div>
            </div>

            <!-- Bloc text seul -->
            <div v-else-if="block.type === 'text'" class="prose prose-lg max-w-none text-dark dark:text-white mx-auto" v-html="block.content"></div>

            <!-- Bloc image seule -->
            <div v-else-if="block.type === 'image'" class="max-w-5xl mx-auto">
              <div class="relative h-96 rounded-3xl overflow-hidden shadow-xl">
                <img 
                  v-if="block.image"
                  :src="block.image"
                  :alt="projectTitle"
                  class="absolute inset-0 w-full h-full object-cover"
                />
              </div>
            </div>
          </div>
        </div>
        
        <!-- Debug: si pas de blocs -->
        <div v-else class="text-center text-gray-500">
          <p>Aucun bloc dans cette section ({{ section.blocks?.length || 0 }} blocs)</p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
interface Props {
  content: any
  projectTitle: string
  imageText?: string
  imageGradient?: string
}

defineProps<Props>()
</script>

<style scoped>
.prose :deep(h2) {
  font-size: 1.875rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  margin-top: 3rem;
}

.prose :deep(h2:first-child) {
  margin-top: 0;
}

.prose :deep(h3) {
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  margin-top: 2rem;
}

.prose :deep(h4) {
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 0.75rem;
  margin-top: 1.5rem;
}

.prose :deep(p) {
  margin-bottom: 1rem;
  line-height: 1.75;
}

.prose :deep(ul) {
  list-style: none;
  margin-bottom: 1.5rem;
}

.prose :deep(li) {
  padding-left: 0;
  margin-bottom: 0.5rem;
}

.prose :deep(strong) {
  font-weight: 600;
  color: var(--color-primary);
}

.dark .prose :deep(strong) {
  color: var(--color-primary-light);
}
</style>
