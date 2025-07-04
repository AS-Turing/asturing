<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

// Form data and validation
const form = ref({
  password: ''
})

const errors = ref({
  password: ''
})

// Validation function
function validateField(value: string): string | null {
  if (!value.trim()) {
    return 'Ce champ est requis.'
  }

  return null
}

async function login(password: string): Promise<boolean> {
  const response = await fetch('https://www.as-turing.fr/php-api/login.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ password })
  })

  if (response.ok) {
    const data = await response.json()
    console.log(data)
    localStorage.setItem('token', data.token)
    return true
  } else {
    return false
  }
}
async function handleSubmit() {
  // Reset errors
  errors.value.password = ''

  // Validate fields
  const passwordError = validateField(form.value.password)

  if (passwordError) {
    errors.value.password = passwordError
    return
  }

  console.log('Login attempt with:', form.value)

  const success = await login(form.value.password)

  if (success) {
    router.push('/admin/dashboard')
  } else {
    errors.value.password = 'Mot de passe invalide.'
  }
}

</script>

<template>
  <div class="max-w-md mx-auto my-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Connexion Administrateur</h1>

    <form @submit.prevent="handleSubmit" class="space-y-6">
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
