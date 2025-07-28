<script setup lang="ts">
import { ref } from 'vue'
import { useApiFetch } from '../../utils/useApiFetch'
import { Client } from '../../types/Client'

const emit = defineEmits(['submit-success'])

// Form data and validation
const form: Client = ref({
  email: '',
  firstname: '',
  lastname: '',
  phone: '',
  company: '',
  tvaNumber: '',
  siret: '',
  codeNaf: '',
  address: '',
  zipCode: '',
  country: '',
  webSite: '',
})

const errors = ref({
  email: '',
  firstname: '',
  lastname: '',
  phone: '',
  company: '',
  tvaNumber: '',
  siret: '',
  codeNaf: '',
  address: '',
  zipCode: '',
  country: '',
  webSite: '',
})

const isSubmitting = ref(false)
const submitError = ref('')
const submitSuccess = ref(false)

// Validation functions
function validateEmail(email: string): string {
  if (!email) return 'L\'email est requis'
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!emailRegex.test(email)) return 'Format d\'email invalide'
  return ''
}

function validateRequired(value: string, fieldName: string): string {
  return value ? '' : `Le champ ${fieldName} est requis`
}

function validatePhone(phone: string): string {
  if (!phone) return 'Le numéro de téléphone est requis'
  const phoneRegex = /^(\+\d{1,3}[- ]?)?\d{10}$/
  if (!phoneRegex.test(phone)) return 'Format de téléphone invalide'
  return ''
}

function validateSiret(siret: string): string {
  if (!siret) return ''
  const siretRegex = /^\d{14}$/
  if (!siretRegex.test(siret)) return 'Le SIRET doit contenir 14 chiffres'
  return ''
}

function validateForm(): boolean {
  let isValid = true

  // Reset all errors
  Object.keys(errors.value).forEach(key => {
    errors.value[key as keyof typeof errors.value] = ''
  })

  // Validate required fields
  errors.value.email = validateEmail(form.value.email)
  errors.value.firstname = validateRequired(form.value.firstname, 'prénom')
  errors.value.lastname = validateRequired(form.value.lastname, 'nom')
  errors.value.phone = validatePhone(form.value.phone)
  errors.value.company = validateRequired(form.value.company, 'entreprise')
  errors.value.address = validateRequired(form.value.address, 'adresse')
  errors.value.zipCode = validateRequired(form.value.zipCode, 'code postal')
  errors.value.country = validateRequired(form.value.country, 'pays')
  
  // Validate optional fields with specific formats
  if (form.value.siret) {
    errors.value.siret = validateSiret(form.value.siret)
  }

  // Check if any errors exist
  for (const key in errors.value) {
    if (errors.value[key as keyof typeof errors.value]) {
      isValid = false
      break
    }
  }

  return isValid
}

async function handleSubmit() {
  submitError.value = ''
  submitSuccess.value = false
  
  if (!validateForm()) {
    return
  }

  isSubmitting.value = true

  try {
    const response = await useApiFetch('/api/client', {
      method: 'POST',
      body: JSON.stringify(form.value),
      headers: {
        'Content-Type': 'application/json',
      },
    })

    if (response.success) {
      submitSuccess.value = true
      emit('submit-success')
      
      // Reset form after successful submission
      Object.keys(form.value).forEach(key => {
        form.value[key as keyof typeof form.value] = ''
      })
    } else {
      submitError.value = response.data || 'Une erreur est survenue lors de la création du client'
    }
  } catch (error) {
    console.error('Error creating client:', error)
    submitError.value = 'Erreur de connexion au serveur'
  } finally {
    isSubmitting.value = false
  }
}
</script>

<template>
  <div class="client-form">
    <!-- Success message -->
    <div v-if="submitSuccess" class="mb-6 bg-green-100 dark:bg-green-900/20 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded">
      <p>Le client a été créé avec succès!</p>
    </div>

    <!-- Error message -->
    <div v-if="submitError" class="mb-6 bg-red-100 dark:bg-red-900/20 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded">
      <p>{{ submitError }}</p>
    </div>

    <form @submit.prevent="handleSubmit" class="space-y-6">
      <!-- Personal Information Section -->
      <div class="border dark:border-gray-700 rounded">
        <div class="w-full text-left bg-gray-100 dark:bg-gray-800 px-4 py-3 font-semibold text-lg dark:text-white">
          Informations personnelles
        </div>
        <div class="p-4 space-y-4 bg-white dark:bg-gray-900">
          <!-- Name row -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="firstname" class="block font-semibold mb-1 dark:text-white">
                Prénom <span class="text-red-500 dark:text-red-400">*</span>
              </label>
              <input
                id="firstname"
                v-model="form.firstname"
                type="text"
                class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="Prénom"
              />
              <p v-if="errors.firstname" class="text-sm text-red-600 dark:text-red-400 mt-1">
                {{ errors.firstname }}
              </p>
            </div>
            <div>
              <label for="lastname" class="block font-semibold mb-1 dark:text-white">
                Nom <span class="text-red-500 dark:text-red-400">*</span>
              </label>
              <input
                id="lastname"
                v-model="form.lastname"
                type="text"
                class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="Nom"
              />
              <p v-if="errors.lastname" class="text-sm text-red-600 dark:text-red-400 mt-1">
                {{ errors.lastname }}
              </p>
            </div>
          </div>

          <!-- Contact row -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="email" class="block font-semibold mb-1 dark:text-white">
                Email <span class="text-red-500 dark:text-red-400">*</span>
              </label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="email@exemple.com"
              />
              <p v-if="errors.email" class="text-sm text-red-600 dark:text-red-400 mt-1">
                {{ errors.email }}
              </p>
            </div>
            <div>
              <label for="phone" class="block font-semibold mb-1 dark:text-white">
                Téléphone <span class="text-red-500 dark:text-red-400">*</span>
              </label>
              <input
                id="phone"
                v-model="form.phone"
                type="tel"
                class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="0123456789"
              />
              <p v-if="errors.phone" class="text-sm text-red-600 dark:text-red-400 mt-1">
                {{ errors.phone }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Company Information Section -->
      <div class="border dark:border-gray-700 rounded">
        <div class="w-full text-left bg-gray-100 dark:bg-gray-800 px-4 py-3 font-semibold text-lg dark:text-white">
          Informations de l'entreprise
        </div>
        <div class="p-4 space-y-4 bg-white dark:bg-gray-900">
          <div>
            <label for="company" class="block font-semibold mb-1 dark:text-white">
              Nom de l'entreprise <span class="text-red-500 dark:text-red-400">*</span>
            </label>
            <input
              id="company"
              v-model="form.company"
              type="text"
              class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
              placeholder="Nom de l'entreprise"
            />
            <p v-if="errors.company" class="text-sm text-red-600 dark:text-red-400 mt-1">
              {{ errors.company }}
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <label for="tvaNumber" class="block font-semibold mb-1 dark:text-white">
                Numéro de TVA
              </label>
              <input
                id="tvaNumber"
                v-model="form.tvaNumber"
                type="text"
                class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="FR12345678901"
              />
              <p v-if="errors.tvaNumber" class="text-sm text-red-600 dark:text-red-400 mt-1">
                {{ errors.tvaNumber }}
              </p>
            </div>
            <div>
              <label for="siret" class="block font-semibold mb-1 dark:text-white">
                SIRET
              </label>
              <input
                id="siret"
                v-model="form.siret"
                type="text"
                class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="12345678901234"
              />
              <p v-if="errors.siret" class="text-sm text-red-600 dark:text-red-400 mt-1">
                {{ errors.siret }}
              </p>
            </div>
            <div>
              <label for="codeNaf" class="block font-semibold mb-1 dark:text-white">
                Code NAF
              </label>
              <input
                id="codeNaf"
                v-model="form.codeNaf"
                type="text"
                class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="1234Z"
              />
              <p v-if="errors.codeNaf" class="text-sm text-red-600 dark:text-red-400 mt-1">
                {{ errors.codeNaf }}
              </p>
            </div>
          </div>

          <div>
            <label for="webSite" class="block font-semibold mb-1 dark:text-white">
              Site internet
            </label>
            <input
              id="webSite"
              v-model="form.webSite"
              type="url"
              class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
              placeholder="https://www.exemple.com"
            />
            <p v-if="errors.webSite" class="text-sm text-red-600 dark:text-red-400 mt-1">
              {{ errors.webSite }}
            </p>
          </div>
        </div>
      </div>

      <!-- Address Section -->
      <div class="border dark:border-gray-700 rounded">
        <div class="w-full text-left bg-gray-100 dark:bg-gray-800 px-4 py-3 font-semibold text-lg dark:text-white">
          Adresse
        </div>
        <div class="p-4 space-y-4 bg-white dark:bg-gray-900">
          <div>
            <label for="address" class="block font-semibold mb-1 dark:text-white">
              Adresse <span class="text-red-500 dark:text-red-400">*</span>
            </label>
            <input
              id="address"
              v-model="form.address"
              type="text"
              class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
              placeholder="123 rue Exemple"
            />
            <p v-if="errors.address" class="text-sm text-red-600 dark:text-red-400 mt-1">
              {{ errors.address }}
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="zipCode" class="block font-semibold mb-1 dark:text-white">
                Code postal <span class="text-red-500 dark:text-red-400">*</span>
              </label>
              <input
                id="zipCode"
                v-model="form.zipCode"
                type="text"
                class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="75000"
              />
              <p v-if="errors.zipCode" class="text-sm text-red-600 dark:text-red-400 mt-1">
                {{ errors.zipCode }}
              </p>
            </div>
            <div>
              <label for="country" class="block font-semibold mb-1 dark:text-white">
                Pays <span class="text-red-500 dark:text-red-400">*</span>
              </label>
              <input
                id="country"
                v-model="form.country"
                type="text"
                class="w-full p-2 border rounded dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="France"
              />
              <p v-if="errors.country" class="text-sm text-red-600 dark:text-red-400 mt-1">
                {{ errors.country }}
              </p>
            </div>
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
          {{ isSubmitting ? 'Création en cours...' : 'Créer le client' }}
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