<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

// Form data and validation
const form = ref({
  email: '',
  password: ''
})

const errors = ref({
  email: '',
  password: ''
})

// Validation function
function validateField(field: string, value: string): string | null {
  if (!value.trim()) {
    return 'Ce champ est requis.'
  }

  if (field === 'email') {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if (!emailRegex.test(value)) {
      return 'Veuillez entrer une adresse email valide.'
    }
  }

  return null
}

// Form submission handler
function handleSubmit() {
  // Reset errors
  errors.value = {
    email: '',
    password: ''
  }

  // Validate fields
  const emailError = validateField('email', form.value.email)
  const passwordError = validateField('password', form.value.password)

  if (emailError) errors.value.email = emailError
  if (passwordError) errors.value.password = passwordError

  // If no errors, proceed with login
  if (!errors.value.email && !errors.value.password) {
    console.log('Login attempt with:', form.value)
    // Here you would typically call an authentication API
    // For example: await login(form.value.email, form.value.password)

    // For demo purposes, we'll just navigate to the dashboard
    router.push('/admin/dashboard')
  }
}
</script>

<template>
  <div class="max-w-md mx-auto my-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Connexion Administrateur</h1>

    <form @submit.prevent="handleSubmit" class="space-y-6">
      <div>
        <label for="email" class="block font-semibold mb-1">
          Email <span class="text-red-500">*</span>
        </label>
        <input
          id="email"
          type="email"
          v-model="form.email"
          placeholder="Votre adresse email"
          class="w-full p-2 border rounded"
        />
        <p v-if="errors.email" class="text-sm text-red-600 mt-1">
          {{ errors.email }}
        </p>
      </div>

      <div>
        <label for="password" class="block font-semibold mb-1">
          Mot de passe <span class="text-red-500">*</span>
        </label>
        <input
          id="password"
          type="password"
          v-model="form.password"
          placeholder="Votre mot de passe"
          class="w-full p-2 border rounded"
        />
        <p v-if="errors.password" class="text-sm text-red-600 mt-1">
          {{ errors.password }}
        </p>
      </div>

      <button
        type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded"
      >
        Se connecter
      </button>
    </form>
  </div>
</template>

<style scoped>
button:focus {
  outline: none;
}
</style>
