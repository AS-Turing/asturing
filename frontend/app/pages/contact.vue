<template>
  <div v-if="config" class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <section class="pt-32 pb-16 gradient-hero text-white relative overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl animate-blob animation-delay-2000"></div>
      </div>
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="inline-block mb-4">
          <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-semibold border border-white/30">
            {{ config.hero.badge }}
          </span>
        </div>
        <h1 class="text-5xl md:text-6xl font-bold mb-6">
          {{ config.hero.title }}
        </h1>
        <p class="text-xl md:text-2xl text-white/90 max-w-3xl mx-auto">
          {{ config.hero.subtitle }}
        </p>
      </div>
    </section>

    <section class="py-16 -mt-20 relative z-10">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8">
          <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 md:p-12 shadow-2xl">
              <h2 class="text-3xl font-bold text-dark dark:text-white mb-2">
                {{ config.form.title }}
              </h2>
              <p class="text-gray-600 dark:text-gray-400 mb-8">
                {{ config.form.description }}
              </p>

              <form @submit.prevent="submitContact" class="space-y-6">
                <div class="grid md:grid-cols-2 gap-6">
                  <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nom complet *</label>
                    <input v-model="form.name" type="text" required class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-primary outline-none text-dark dark:text-white dark:bg-gray-700 transition" />
                  </div>
                  <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Email *</label>
                    <input v-model="form.email" type="email" required class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-secondary outline-none text-dark dark:text-white dark:bg-gray-700 transition" />
                  </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                  <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Téléphone</label>
                    <input v-model="form.phone" type="tel" class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-accent outline-none text-dark dark:text-white dark:bg-gray-700 transition" />
                  </div>
                  <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Entreprise</label>
                    <input v-model="form.company" type="text" class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-coral outline-none text-dark dark:text-white dark:bg-gray-700 transition" />
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sujet *</label>
                  <input v-model="form.subject" type="text" required class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-accent outline-none text-dark dark:text-white dark:bg-gray-700 transition" />
                </div>
                <div>
                  <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Message *</label>
                  <textarea v-model="form.message" rows="6" required class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-primary outline-none text-dark dark:text-white dark:bg-gray-700 resize-none transition"></textarea>
                </div>
                <div v-if="status.message" class="p-4 rounded-xl" :class="status.type === 'success' ? 'bg-green-50 dark:bg-green-900/20 text-green-800 dark:text-green-200' : 'bg-red-50 dark:bg-red-900/20 text-red-800 dark:text-red-200'">
                  {{ status.message }}
                </div>
                <button type="submit" :disabled="submitting" class="w-full gradient-hero text-white py-4 rounded-xl font-semibold text-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:scale-100">
                  {{ submitting ? config.form.submittingButton : config.form.submitButton }}
                </button>
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                  {{ config.form.privacyText }}
                  <NuxtLink to="/politique-confidentialite" class="text-primary hover:underline">{{ config.form.privacyLink }}</NuxtLink>
                </p>
              </form>
            </div>
          </div>

          <div class="space-y-6">
            <div v-for="info in config.contactInfo" :key="info.title" class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
              <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" :class="info.gradient">
                  <Icon :name="info.icon" class="!w-6 !h-6 text-white" />
                </div>
                <div>
                  <h3 class="font-semibold text-dark dark:text-white mb-1">{{ info.title }}</h3>
                  <a v-if="info.link" :href="info.link" :class="info.type === 'email' ? 'text-primary' : info.type === 'phone' ? 'text-secondary' : ''" class="hover:underline">{{ info.value }}</a>
                  <p v-else class="text-gray-600 dark:text-gray-400 whitespace-pre-line">{{ info.value }}</p>
                </div>
              </div>
            </div>

            <div class="gradient-hero rounded-2xl p-6 text-white shadow-xl">
              <h3 class="text-xl font-bold mb-2">{{ config.urgentCta.title }}</h3>
              <p class="text-white/90 mb-4 text-sm">{{ config.urgentCta.description }}</p>
              <a :href="config.urgentCta.buttonLink" class="inline-flex items-center gap-2 bg-white text-primary px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition-all hover:scale-105">
                <Icon :name="config.urgentCta.buttonIcon" class="!w-5 !h-5" />
                {{ config.urgentCta.buttonText }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-16 bg-white dark:bg-gray-800 transition-colors duration-300">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-dark dark:text-white mb-4">{{ config.faq.title }}</h2>
          <p class="text-gray-600 dark:text-gray-400">{{ config.faq.description }}</p>
        </div>
        <div class="space-y-4">
          <div v-for="(faq, index) in config.faq.items" :key="index" class="bg-gray-50 dark:bg-gray-900 rounded-2xl overflow-hidden">
            <button @click="toggleFaq(index)" class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-100 dark:hover:bg-gray-800 transition">
              <span class="font-semibold text-dark dark:text-white">{{ faq.question }}</span>
              <Icon :name="openFaq === index ? 'mdi:chevron-up' : 'mdi:chevron-down'" class="!w-6 !h-6 text-primary flex-shrink-0 ml-4" />
            </button>
            <div v-if="openFaq === index" class="px-6 pb-6 text-gray-600 dark:text-gray-400">{{ faq.answer }}</div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
const { sendContactMessage } = useApi()
const { data: config } = await useFetch('/api/contact/config')

const form = ref({ name: '', email: '', phone: '', company: '', subject: '', message: '' })
const submitting = ref(false)
const status = ref({ type: '', message: '' })
const openFaq = ref<number | null>(null)

const toggleFaq = (index: number) => { openFaq.value = openFaq.value === index ? null : index }

const submitContact = async () => {
  submitting.value = true
  status.value = { type: '', message: '' }
  try {
    await sendContactMessage(form.value)
    status.value = { type: 'success', message: config.value?.form?.successMessage || '✅ Merci !' }
    form.value = { name: '', email: '', phone: '', company: '', subject: '', message: '' }
  } catch (error) {
    status.value = { type: 'error', message: config.value?.form?.errorMessage || '❌ Erreur' }
  } finally {
    submitting.value = false
  }
}

useHead({
  title: config.value?.seo?.title || 'Contact',
  meta: [{ name: 'description', content: config.value?.seo?.description || '' }]
})
</script>
