<template>
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
            class="w-full gradient-hero text-white py-4 rounded-xl font-semibold text-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 animate-gradient"
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
              v-if="company?.email"
              :href="`mailto:${company.email}`" 
              class="text-primary dark:text-primary font-semibold hover:underline inline-flex items-center justify-center group"
            >
              <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              {{ company.email }}
            </a>
            <a 
              v-if="company?.phone"
              :href="`tel:${company.phone.replace(/\s/g, '')}`" 
              class="text-secondary dark:text-secondary font-semibold hover:underline inline-flex items-center justify-center group"
            >
              <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
              {{ company.phone }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useApi } from '~/composables/useApi'

const { companyInfo: company } = useCompany()

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
