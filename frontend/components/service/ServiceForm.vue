<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useApiFetch } from '../../utils/useApiFetch'
import { Service, Price, Faq } from '../../types/services'

const props = defineProps<{
  service?: Service
}>()

const emit = defineEmits(['submit-success'])

const form = ref<Service>({
  id: 0,
  slug: '',
  title: '',
  description: '',
  microServices: [],
  prices: [],
  faqs: [],
  seo: {
    id: 0,
    title: '',
    description: '',
    ogTitle: '',
    ogDescription: '',
    ogUrl: '',
    service: 0,
  },
})

const errors = ref({
  slug: '',
  title: '',
  description: '',
  microServices: '',
  prices: '',
  faqs: '',
  seo: {
    title: '',
    description: '',
    ogTitle: '',
    ogDescription: '',
    ogUrl: '',
  },
})

const newMicroService = ref('')
const newPrice = ref<Price>({
  id: 0,
  name: '',
  includes: [],
  price: '',
  service: 0,
})
const newPriceInclude = ref('')
const newFaq = ref<Faq>({
  id: 0,
  question: '',
  answer: '',
  service: 0,
})

const isSubmitting = ref(false)
const submitError = ref('')
const submitSuccess = ref(false)

// Validation functions
function validateRequired(value: string, fieldName: string): string {
  return value ? '' : `Le champ ${fieldName} est requis`
}

function validateForm(): boolean {
  let isValid = true

  // Reset all errors
  errors.value.slug = ''
  errors.value.title = ''
  errors.value.description = ''
  errors.value.microServices = ''
  errors.value.prices = ''
  errors.value.faqs = ''
  errors.value.seo.title = ''
  errors.value.seo.description = ''
  errors.value.seo.ogTitle = ''
  errors.value.seo.ogDescription = ''
  errors.value.seo.ogUrl = ''

  // Validate required fields
  errors.value.title = validateRequired(form.value.title, 'titre')
  errors.value.slug = validateRequired(form.value.slug, 'slug')
  errors.value.description = validateRequired(form.value.description, 'description')
  errors.value.seo.title = validateRequired(form.value.seo.title, 'titre SEO')
  errors.value.seo.description = validateRequired(form.value.seo.description, 'description SEO')

  // Check if any errors exist
  if (errors.value.slug || errors.value.title || errors.value.description ||
      errors.value.seo.title || errors.value.seo.description) {
    isValid = false
  }

  return isValid
}

// Handlers for arrays
function addMicroService() {
  if (newMicroService.value.trim()) {
    form.value.microServices.push(newMicroService.value.trim())
    newMicroService.value = ''
  }
}

function removeMicroService(index: number) {
  form.value.microServices.splice(index, 1)
}

function addPriceInclude() {
  if (newPriceInclude.value.trim()) {
    newPrice.value.includes.push(newPriceInclude.value.trim())
    newPriceInclude.value = ''
  }
}

function removePriceInclude(index: number) {
  newPrice.value.includes.splice(index, 1)
}

function addPrice() {
  if (newPrice.value.name && newPrice.value.price) {
    form.value.prices.push({ ...newPrice.value })
    newPrice.value = {
      id: 0,
      name: '',
      includes: [],
      price: '',
      service: 0,
    }
  }
}

function removePrice(index: number) {
  form.value.prices.splice(index, 1)
}

function addFaq() {
  if (newFaq.value.question && newFaq.value.answer) {
    form.value.faqs.push({ ...newFaq.value })
    newFaq.value = {
      id: 0,
      question: '',
      answer: '',
      service: 0,
    }
  }
}

function removeFaq(index: number) {
  form.value.faqs.splice(index, 1)
}

async function handleSubmit() {
  submitError.value = ''
  submitSuccess.value = false
  
  if (!validateForm()) {
    return
  }

  isSubmitting.value = true
  const isUpdate = props.service !== null && props.service !== undefined

  try {
    const url = isUpdate ? `/api/services/${props.service.id}` : '/api/services'
    const method = isUpdate ? 'PUT' : 'POST'
    
    const response = await useApiFetch(url, {
      method: method,
      body: JSON.stringify(form.value),
      headers: {
        'Content-Type': 'application/json',
      },
    })

    if (response.success) {
      submitSuccess.value = true
      emit('submit-success')
      
      // Only reset form after successful creation, not update
      if (!isUpdate) {
        form.value = {
          id: 0,
          slug: '',
          title: '',
          description: '',
          microServices: [],
          prices: [],
          faqs: [],
          seo: {
            id: 0,
            title: '',
            description: '',
            ogTitle: '',
            ogDescription: '',
            ogUrl: '',
            service: 0,
          },
        }
      }
    } else {
      submitError.value = response.data || (isUpdate 
        ? 'Une erreur est survenue lors de la mise à jour du service' 
        : 'Une erreur est survenue lors de la création du service')
    }
  } catch (error) {
    console.error(isUpdate ? 'Error updating service:' : 'Error creating service:', error)
    submitError.value = 'Erreur de connexion au serveur'
  } finally {
    isSubmitting.value = false
  }
}

onMounted(() => {
  if (props.service !== null && props.service !== undefined) {
    form.value = JSON.parse(JSON.stringify(props.service)) // Deep copy
  }
})
</script>

<template>
  <div class="service-form">
    <!-- Success message -->
    <div v-if="submitSuccess" class="mb-6 bg-green-100 dark:bg-green-900/20 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded">
      <p v-if="props.service">Le service a été mis à jour avec succès!</p>
      <p v-else>Le service a été créé avec succès!</p>
    </div>

    <!-- Error message -->
    <div v-if="submitError" class="mb-6 bg-red-100 dark:bg-red-900/20 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded">
      <p>{{ submitError }}</p>
    </div>

    <form @submit.prevent="handleSubmit" class="space-y-6">
      <!-- Basic Information Section -->
      <div class="border dark:border-gray-700 rounded">
        <div class="w-full text-left bg-gray-100 dark:bg-gray-800 px-4 py-3 font-semibold text-lg dark:text-white">
          Informations de base
        </div>
        <div class="p-4 space-y-4 bg-white dark:bg-gray-900">
          <div>
            <label for="title" class="block font-semibold mb-1 dark:text-white">
              Titre <span class="text-red-500 dark:text-red-400">*</span>
            </label>
            <input
              id="title"
              v-model="form.title"
              type="text"
              class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
              placeholder="Titre du service"
            />
            <p v-if="errors.title" class="text-sm text-red-600 dark:text-red-400 mt-1">
              {{ errors.title }}
            </p>
          </div>

          <div>
            <label for="slug" class="block font-semibold mb-1 dark:text-white">
              Slug <span class="text-red-500 dark:text-red-400">*</span>
            </label>
            <input
              id="slug"
              v-model="form.slug"
              type="text"
              class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
              placeholder="slug-du-service"
            />
            <p v-if="errors.slug" class="text-sm text-red-600 dark:text-red-400 mt-1">
              {{ errors.slug }}
            </p>
          </div>

          <div>
            <label for="description" class="block font-semibold mb-1 dark:text-white">
              Description <span class="text-red-500 dark:text-red-400">*</span>
            </label>
            <textarea
              id="description"
              v-model="form.description"
              rows="4"
              class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
              placeholder="Description du service"
            ></textarea>
            <p v-if="errors.description" class="text-sm text-red-600 dark:text-red-400 mt-1">
              {{ errors.description }}
            </p>
          </div>
        </div>
      </div>

      <!-- Micro-Services Section -->
      <div class="border dark:border-gray-700 rounded">
        <div class="w-full text-left bg-gray-100 dark:bg-gray-800 px-4 py-3 font-semibold text-lg dark:text-white">
          Micro-services
        </div>
        <div class="p-4 space-y-4 bg-white dark:bg-gray-900">
          <div class="flex items-center space-x-2">
            <input
              v-model="newMicroService"
              type="text"
              class="flex-grow p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
              placeholder="Ajouter un micro-service"
              @keyup.enter.prevent="addMicroService"
            />
            <button
              type="button"
              @click="addMicroService"
              class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"
            >
              Ajouter
            </button>
          </div>

          <div v-if="form.microServices.length > 0" class="mt-2">
            <div v-for="(microService, index) in form.microServices" :key="index" class="flex items-center justify-between bg-gray-50 dark:bg-gray-800 p-2 rounded mb-2">
              <span class="dark:text-white">{{ microService }}</span>
              <button
                type="button"
                @click="removeMicroService(index)"
                class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
              >
                Supprimer
              </button>
            </div>
          </div>
          <p v-else class="text-gray-500 dark:text-gray-400 italic">Aucun micro-service ajouté</p>
        </div>
      </div>

      <!-- Prices Section -->
      <div class="border dark:border-gray-700 rounded">
        <div class="w-full text-left bg-gray-100 dark:bg-gray-800 px-4 py-3 font-semibold text-lg dark:text-white">
          Tarifs
        </div>
        <div class="p-4 space-y-4 bg-white dark:bg-gray-900">
          <div class="border dark:border-gray-700 rounded p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
              <div>
                <label class="block font-semibold mb-1 dark:text-white">Nom du tarif</label>
                <input
                  v-model="newPrice.name"
                  type="text"
                  class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                  placeholder="Ex: Basic, Premium, etc."
                />
              </div>
              <div>
                <label class="block font-semibold mb-1 dark:text-white">Prix</label>
                <input
                  v-model="newPrice.price"
                  type="text"
                  class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                  placeholder="Ex: 99€, Sur devis, etc."
                />
              </div>
            </div>

            <div class="mb-4">
              <label class="block font-semibold mb-1 dark:text-white">Inclus</label>
              <div class="flex items-center space-x-2">
                <input
                  v-model="newPriceInclude"
                  type="text"
                  class="flex-grow p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                  placeholder="Ajouter un élément inclus"
                  @keyup.enter.prevent="addPriceInclude"
                />
                <button
                  type="button"
                  @click="addPriceInclude"
                  class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"
                >
                  Ajouter
                </button>
              </div>

              <div v-if="newPrice.includes.length > 0" class="mt-2">
                <div v-for="(include, index) in newPrice.includes" :key="index" class="flex items-center justify-between bg-gray-50 dark:bg-gray-800 p-2 rounded mb-2">
                  <span class="dark:text-white">{{ include }}</span>
                  <button
                    type="button"
                    @click="removePriceInclude(index)"
                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
                  >
                    Supprimer
                  </button>
                </div>
              </div>
            </div>

            <div class="flex justify-end">
              <button
                type="button"
                @click="addPrice"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded"
                :disabled="!newPrice.name || !newPrice.price"
              >
                Ajouter ce tarif
              </button>
            </div>
          </div>

          <div v-if="form.prices.length > 0" class="mt-4">
            <h4 class="font-semibold mb-2 dark:text-white">Tarifs ajoutés:</h4>
            <div v-for="(price, index) in form.prices" :key="index" class="bg-gray-50 dark:bg-gray-800 p-4 rounded mb-2">
              <div class="flex justify-between items-center mb-2">
                <h5 class="font-semibold dark:text-white">{{ price.name }} - {{ price.price }}</h5>
                <button
                  type="button"
                  @click="removePrice(index)"
                  class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
                >
                  Supprimer
                </button>
              </div>
              <ul v-if="price.includes.length > 0" class="list-disc pl-5 dark:text-gray-300">
                <li v-for="(include, idx) in price.includes" :key="idx">{{ include }}</li>
              </ul>
              <p v-else class="text-gray-500 dark:text-gray-400 italic">Aucun élément inclus</p>
            </div>
          </div>
          <p v-else class="text-gray-500 dark:text-gray-400 italic">Aucun tarif ajouté</p>
        </div>
      </div>

      <!-- FAQs Section -->
      <div class="border dark:border-gray-700 rounded">
        <div class="w-full text-left bg-gray-100 dark:bg-gray-800 px-4 py-3 font-semibold text-lg dark:text-white">
          FAQs
        </div>
        <div class="p-4 space-y-4 bg-white dark:bg-gray-900">
          <div class="border dark:border-gray-700 rounded p-4">
            <div class="mb-4">
              <label class="block font-semibold mb-1 dark:text-white">Question</label>
              <input
                v-model="newFaq.question"
                type="text"
                class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="Question fréquemment posée"
              />
            </div>

            <div class="mb-4">
              <label class="block font-semibold mb-1 dark:text-white">Réponse</label>
              <textarea
                v-model="newFaq.answer"
                rows="3"
                class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="Réponse à la question"
              ></textarea>
            </div>

            <div class="flex justify-end">
              <button
                type="button"
                @click="addFaq"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded"
                :disabled="!newFaq.question || !newFaq.answer"
              >
                Ajouter cette FAQ
              </button>
            </div>
          </div>

          <div v-if="form.faqs.length > 0" class="mt-4">
            <h4 class="font-semibold mb-2 dark:text-white">FAQs ajoutées:</h4>
            <div v-for="(faq, index) in form.faqs" :key="index" class="bg-gray-50 dark:bg-gray-800 p-4 rounded mb-2">
              <div class="flex justify-between items-center mb-2">
                <h5 class="font-semibold dark:text-white">{{ faq.question }}</h5>
                <button
                  type="button"
                  @click="removeFaq(index)"
                  class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300"
                >
                  Supprimer
                </button>
              </div>
              <p class="dark:text-gray-300">{{ faq.answer }}</p>
            </div>
          </div>
          <p v-else class="text-gray-500 dark:text-gray-400 italic">Aucune FAQ ajoutée</p>
        </div>
      </div>

      <!-- SEO Section -->
      <div class="border dark:border-gray-700 rounded">
        <div class="w-full text-left bg-gray-100 dark:bg-gray-800 px-4 py-3 font-semibold text-lg dark:text-white">
          SEO
        </div>
        <div class="p-4 space-y-4 bg-white dark:bg-gray-900">
          <div>
            <label for="seoTitle" class="block font-semibold mb-1 dark:text-white">
              Titre SEO <span class="text-red-500 dark:text-red-400">*</span>
            </label>
            <input
              id="seoTitle"
              v-model="form.seo.title"
              type="text"
              class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
              placeholder="Titre pour les moteurs de recherche"
            />
            <p v-if="errors.seo.title" class="text-sm text-red-600 dark:text-red-400 mt-1">
              {{ errors.seo.title }}
            </p>
          </div>

          <div>
            <label for="seoDescription" class="block font-semibold mb-1 dark:text-white">
              Description SEO <span class="text-red-500 dark:text-red-400">*</span>
            </label>
            <textarea
              id="seoDescription"
              v-model="form.seo.description"
              rows="3"
              class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
              placeholder="Description pour les moteurs de recherche"
            ></textarea>
            <p v-if="errors.seo.description" class="text-sm text-red-600 dark:text-red-400 mt-1">
              {{ errors.seo.description }}
            </p>
          </div>

          <div>
            <label for="ogTitle" class="block font-semibold mb-1 dark:text-white">
              Titre Open Graph
            </label>
            <input
              id="ogTitle"
              v-model="form.seo.ogTitle"
              type="text"
              class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
              placeholder="Titre pour les réseaux sociaux"
            />
          </div>

          <div>
            <label for="ogDescription" class="block font-semibold mb-1 dark:text-white">
              Description Open Graph
            </label>
            <textarea
              id="ogDescription"
              v-model="form.seo.ogDescription"
              rows="3"
              class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
              placeholder="Description pour les réseaux sociaux"
            ></textarea>
          </div>

          <div>
            <label for="ogUrl" class="block font-semibold mb-1 dark:text-white">
              URL Open Graph
            </label>
            <input
              id="ogUrl"
              v-model="form.seo.ogUrl"
              type="text"
              class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
              placeholder="URL pour les réseaux sociaux"
            />
          </div>
        </div>
      </div>

      <!-- Submit button -->
      <div class="flex justify-end">
        <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-semibold py-2 px-6 rounded flex items-center"
          :disabled="isSubmitting"
        >
          <span v-if="isSubmitting" class="mr-2">
            <div class="animate-spin rounded-full h-4 w-4 border-t-2 border-b-2 border-white"></div>
          </span>
          <template v-if="props.service">
            {{ isSubmitting ? 'Mise à jour en cours...' : 'Mettre à jour le service' }}
          </template>
          <template v-else>
            {{ isSubmitting ? 'Création en cours...' : 'Créer le service' }}
          </template>
        </button>
      </div>
    </form>
  </div>
</template>

<style scoped>
button:focus {
  outline: none;
}
</style>