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
                    <label for="contact-name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nom complet *</label>
                    <input id="contact-name" v-model="form.name" type="text" required class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-primary outline-none text-dark dark:text-white dark:bg-gray-700 transition" aria-required="true" />
                  </div>
                  <div>
                    <label for="contact-email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Email *</label>
                    <input id="contact-email" v-model="form.email" type="email" required class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-secondary outline-none text-dark dark:text-white dark:bg-gray-700 transition" aria-required="true" />
                  </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                  <div>
                    <label for="contact-phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Téléphone</label>
                    <input id="contact-phone" v-model="form.phone" type="tel" class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-accent outline-none text-dark dark:text-white dark:bg-gray-700 transition" />
                  </div>
                  <div>
                    <label for="contact-company" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Entreprise</label>
                    <input id="contact-company" v-model="form.company" type="text" class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-coral outline-none text-dark dark:text-white dark:bg-gray-700 transition" />
                  </div>
                </div>
                <div>
                  <label for="contact-subject" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sujet *</label>
                  <input id="contact-subject" v-model="form.subject" type="text" required class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-accent outline-none text-dark dark:text-white dark:bg-gray-700 transition" aria-required="true" />
                </div>
                <div>
                  <label for="contact-message" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Message *</label>
                  <textarea id="contact-message" v-model="form.message" rows="6" required class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 dark:border-gray-600 focus:border-primary outline-none text-dark dark:text-white dark:bg-gray-700 resize-none transition" aria-required="true"></textarea>
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
            <!-- Email -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
              <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 gradient-hero from-primary to-secondary">
                  <MdiIcon name="mdi:email" class="!w-6 !h-6 text-white" />
                </div>
                <div>
                  <h3 class="font-semibold text-dark dark:text-white mb-1">Email</h3>
                  <a :href="`mailto:${company?.email}`" class="text-primary hover:underline">{{ company?.email }}</a>
                </div>
              </div>
            </div>

            <!-- Téléphone -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
              <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 gradient-hero from-secondary to-coral">
                  <MdiIcon name="mdi:phone" class="!w-6 !h-6 text-white" />
                </div>
                <div>
                  <h3 class="font-semibold text-dark dark:text-white mb-1">Téléphone</h3>
                  <a :href="`tel:${company?.phone?.replace(/\s/g, '')}`" class="text-secondary hover:underline">{{ company?.phone }}</a>
                </div>
              </div>
            </div>

            <!-- Adresse -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
              <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 gradient-hero from-coral to-accent">
                  <MdiIcon name="mdi:map-marker" class="!w-6 !h-6 text-white" />
                </div>
                <div>
                  <h3 class="font-semibold text-dark dark:text-white mb-1">Adresse</h3>
                  <p class="text-gray-600 dark:text-gray-400">{{ company?.address }}</p>
                  <p class="text-gray-600 dark:text-gray-400">{{ company?.zipCode }} {{ company?.city }}</p>
                  <p class="text-gray-600 dark:text-gray-400">{{ company?.region }}, {{ company?.country }}</p>
                </div>
              </div>
            </div>

            <!-- Horaires -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
              <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 gradient-hero from-accent to-primary">
                  <MdiIcon name="mdi:clock-outline" class="!w-6 !h-6 text-white" />
                </div>
                <div class="w-full">
                  <h3 class="font-semibold text-dark dark:text-white mb-2">Horaires</h3>
                  <div class="space-y-1 text-sm">
                    <div v-for="item in sortedBusinessHours" :key="item.day" class="flex justify-between">
                      <span class="text-gray-600 dark:text-gray-400 font-medium">{{ formatDay(item.day) }}</span>
                      <span class="text-gray-600 dark:text-gray-400">
                        <template v-if="item.hours && typeof item.hours === 'object' && item.hours.open && item.hours.close">
                          {{ item.hours.open }} - {{ item.hours.close }}
                        </template>
                        <template v-else>
                          Fermé
                        </template>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="gradient-hero rounded-2xl p-6 text-white shadow-xl">
              <h3 class="text-xl font-bold mb-2">{{ config.urgentCta.title }}</h3>
              <p class="text-white/90 mb-4 text-sm">{{ config.urgentCta.description }}</p>
              <a :href="`tel:${company?.phone?.replace(/\s/g, '')}`"
                 class="inline-flex items-center gap-2 bg-white text-primary px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition-all hover:scale-105">
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
const { companyInfo: company } = useCompany()

const form = ref({ name: '', email: '', phone: '', company: '', subject: '', message: '' })
const submitting = ref(false)
const openFaq = ref<number | null>(null)

const toggleFaq = (index: number) => { openFaq.value = openFaq.value === index ? null : index }

const daysTranslation: Record<string, string> = {
  'monday': 'Lundi',
  'tuesday': 'Mardi',
  'wednesday': 'Mercredi',
  'thursday': 'Jeudi',
  'friday': 'Vendredi',
  'saturday': 'Samedi',
  'sunday': 'Dimanche'
}

const formatDay = (day: string) => daysTranslation[day.toLowerCase()] || day

// Ordre correct des jours de la semaine
const weekDaysOrder = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']

// Horaires triés par ordre de jours
const sortedBusinessHours = computed(() => {
  if (!company.value?.businessHours) return []
  
  return weekDaysOrder
    .filter(day => company.value.businessHours[day])
    .map(day => ({
      day,
      hours: company.value.businessHours[day]
    }))
})

const submitContact = async () => {
  const { notifySuccess, notifyError } = useNotifications()
  
  submitting.value = true
  try {
    await sendContactMessage(form.value)
    notifySuccess(config.value?.form?.successMessage || '✅ Merci pour votre message ! Nous vous répondrons dans les plus brefs délais.')
    form.value = { name: '', email: '', phone: '', company: '', subject: '', message: '' }
  } catch (error) {
    notifyError(config.value?.form?.errorMessage || '❌ Une erreur est survenue. Veuillez réessayer.')
  } finally {
    submitting.value = false
  }
}

// SEO Premium AAA pour page contact
usePremiumSeo({
  title: config.value?.seo?.title || 'Contact Agence Web Libourne | Devis Gratuit & Conseils',
  description: config.value?.seo?.description || 'Contactez notre agence web à Libourne pour votre projet de site internet. Devis gratuit, réponse rapide. Rencontrons-nous autour d\'un café !',
  url: 'https://www.as-turing.fr/contact',
  image: 'https://www.as-turing.fr/images/og-home.jpg',
  type: 'website',
  breadcrumbs: [
    { name: 'Accueil', url: '/' },
    { name: 'Contact', url: '/contact' }
  ]
})

// Keywords meta supplémentaires
useHead({
  meta: [
    {
      name: 'keywords',
      content: 'contact agence web Libourne, devis site internet, rendez-vous agence web, création site Libourne, contact développeur web'
    }
  ],
  // Schema.org ContactPage
  script: config.value ? [
    {
      type: 'application/ld+json',
      children: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'ContactPage',
        'name': 'Contact - AS-Turing',
        'description': 'Contactez notre agence web pour votre projet de site internet',
        'url': 'https://www.as-turing.fr/contact',
        'mainEntity': {
          '@type': 'LocalBusiness',
          'name': 'AS-Turing',
          'description': 'Agence web spécialisée en création de sites internet',
          'telephone': company.value?.phone || '',
          'email': company.value?.email || '',
          'address': {
            '@type': 'PostalAddress',
            'addressLocality': 'Libourne',
            'addressRegion': 'Nouvelle-Aquitaine',
            'postalCode': '33500',
            'addressCountry': 'FR'
          },
          'geo': {
            '@type': 'GeoCoordinates',
            'latitude': '44.9178',
            'longitude': '-0.2422'
          },
          'areaServed': [
            {
              '@type': 'City',
              'name': 'Libourne'
            },
            {
              '@type': 'City',
              'name': 'Saint-Émilion'
            },
            {
              '@type': 'City',
              'name': 'Bordeaux'
            },
            {
              '@type': 'City',
              'name': 'Créon'
            }
          ],
          'priceRange': '€€',
          'openingHours': 'Mo-Fr 09:00-18:00'
        }
      })
    }
  ] : []
})
</script>
