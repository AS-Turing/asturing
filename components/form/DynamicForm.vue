<script setup lang="ts">
import { ref, computed } from 'vue'
import { specifications } from '@/data/specifications'

type FormData = Record<string, any>
const form = ref<FormData>({})
const errors = ref<FormData>({})
const accordionState = ref<Record<string, boolean>>({})
const pdfRef = ref<HTMLElement | null>(null)

// Initialiser les champs et états d'accordéon
for (const field of specifications) {
  if (field.type === 'checkbox') {
    form.value[field.id] = []
  } else {
    form.value[field.id] = ''
  }
}

// Grouper les questions par catégorie
const groupedSpecifications = computed(() => {
  const categories: Record<string, any[]> = {}
  for (const spec of specifications.sort((a, b) => a.order - b.order)) {
    if (!categories[spec.category]) categories[spec.category] = []
    categories[spec.category].push(spec)
  }

  // Initialiser état des accordéons
  for (const categoryName of Object.keys(categories)) {
    if (!(categoryName in accordionState.value)) {
      accordionState.value[categoryName] = false
    }
  }

  return Object.entries(categories).map(([name, fields]) => ({ name, fields }))
})

function toggleCategory(name: string) {
  accordionState.value[name] = !accordionState.value[name]
}

function validateField(field: any, value: any): string | null {
  if (field.required && (!value || (Array.isArray(value) && value.length === 0))) {
    return 'Ce champ est requis.'
  }
  if (field.validation) {
    if (field.validation.pattern && typeof value === 'string') {
      const regex = new RegExp(field.validation.pattern)
      if (!regex.test(value)) {
        return field.validation.errorMessage || 'Format invalide.'
      }
    }
    if (typeof value === 'number') {
      if (
          (field.validation.min && value < field.validation.min) ||
          (field.validation.max && value > field.validation.max)
      ) {
        return field.validation.errorMessage || 'Valeur hors limites.'
      }
    }
  }
  return null
}

async function generateStructuredPdf() {
  if (!import.meta.client) return

  const html2pdf = (await import('html2pdf.js')).default

  const today = new Date().toLocaleDateString('fr-FR')

  const container = document.createElement('div')
  container.innerHTML = `
    <div style="font-family: Arial, sans-serif; padding: 20px; max-width: 800px;">
      <div style="display: flex; align-items: center; margin-bottom: 24px;">
        <img src="/images/logo.svg" alt="Logo AS-Turing" style="height: 50px; margin-right: 20px;" />
        <div>
          <h1 style="font-size: 24px; margin: 0;">Cahier des charges</h1>
          <p style="font-size: 12px; color: #666;">Généré le ${today}</p>
        </div>
      </div>
      ${generateHtmlContentFromForm()}
      <p style="font-size: 12px; color: #999; margin-top: 40px; text-align: center;">
        Ce document est généré automatiquement à partir du formulaire AS-Turing.
      </p>
    </div>
  `

  await html2pdf()
      .set({
        margin: 10,
        filename: `cahier-des-charges-${today.replace(/\//g, '-')}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
      })
      .from(container)
      .save()
}

function generateHtmlContentFromForm(): string {
  const grouped = groupedSpecifications.value

  return grouped
      .map(({ name, fields }) => {
        const rows = fields
            .map(field => {
              const value = form.value[field.id]
              const display = Array.isArray(value)
                  ? value.join(', ')
                  : value?.toString().trim() || '<em style="color: #888;">(non renseigné)</em>'

              return `
            <tr>
              <td style="padding: 8px 12px; border: 1px solid #ccc; background-color: #f9f9f9;">
                <strong>${field.label}</strong>
              </td>
              <td style="padding: 8px 12px; border: 1px solid #ccc;">${display}</td>
            </tr>
          `
            })
            .join('')

        return `
        <h2 style="margin-top: 32px; font-size: 18px; color: #2c3e50; border-bottom: 2px solid #ddd; padding-bottom: 4px;">
          ${name}
        </h2>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
          ${rows}
        </table>
      `
      })
      .join('')
}

async function handleSubmit() {
  errors.value = {}

  for (const field of specifications) {
    const error = validateField(field, form.value[field.id])
    if (error) {
      errors.value[field.id] = error
    }
  }

  if (Object.keys(errors.value).length === 0) {

    await generateStructuredPdf()

    alert('Formulaire soumis et PDF généré ✅')
  } else {
    console.warn('❌ Erreurs :', errors.value)
  }
}
</script>

<template>
  <form @submit.prevent="handleSubmit">
    <div ref="pdfRef" class="space-y-6 max-w-3xl mx-auto">
      <div
          v-for="(category, index) in groupedSpecifications"
          :key="index"
          class="border rounded"
      >
        <!-- Catégorie (header) -->
        <button
            type="button"
            class="w-full text-left bg-gray-100 px-4 py-3 font-semibold text-lg hover:bg-gray-200 transition"
            @click="toggleCategory(category.name)"
        >
          {{ category.name }}
          <span class="float-right">
          {{ accordionState[category.name] ? '▲' : '▼' }}
        </span>
        </button>

        <!-- Questions (body) -->
        <div v-show="accordionState[category.name]" class="p-4 space-y-6 bg-white">
          <div v-for="field in category.fields" :key="field.id">
            <label :for="field.id" class="block font-semibold mb-1">
              {{ field.label }}
              <span v-if="field.required" class="text-red-500">*</span>
            </label>
            <p v-if="field.tooltip" class="text-sm text-gray-500 mb-2">{{ field.tooltip }}</p>

            <!-- Text, Email, Number, Date -->
            <input
                v-if="['text', 'email', 'number', 'date', 'tel'].includes(field.type)"
                :id="field.id"
                :type="field.type"
                v-model="form[field.id]"
                :placeholder="field.placeholder"
                class="w-full p-2 border rounded"
            />

            <!-- Textarea -->
            <textarea
                v-if="field.type === 'textarea'"
                :id="field.id"
                v-model="form[field.id]"
                :placeholder="field.placeholder"
                class="w-full p-2 border rounded"
            ></textarea>

            <!-- Select -->
            <select
                v-if="field.type === 'select'"
                :id="field.id"
                v-model="form[field.id]"
                class="w-full p-2 border rounded"
            >
              <option disabled value="">{{ field.placeholder }}</option>
              <option
                  v-for="option in field.options"
                  :key="option.value"
                  :value="option.value"
              >
                {{ option.label }}
              </option>
            </select>

            <!-- Checkbox -->
            <div v-if="field.type === 'checkbox'" class="flex flex-col gap-1">
              <label
                  v-for="option in field.options"
                  :key="option.value"
                  class="flex items-center space-x-2"
              >
                <input
                    type="checkbox"
                    :value="option.value"
                    v-model="form[field.id]"
                />
                <span>{{ option.label }}</span>
              </label>
            </div>

            <!-- Radio -->
            <div v-if="field.type === 'radio'" class="flex flex-col gap-1">
              <label
                  v-for="option in field.options"
                  :key="option.value"
                  class="flex items-center space-x-2"
              >
                <input
                    type="radio"
                    :name="field.id"
                    :value="option.value"
                    v-model="form[field.id]"
                />
                <span>{{ option.label }}</span>
              </label>
            </div>

            <!-- Validation Error -->
            <p v-if="errors[field.id]" class="text-sm text-red-600 mt-1">
              {{ errors[field.id] }}
            </p>
          </div>
        </div>
      </div>
      <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded"
      >
        Envoyer
      </button>
    </div>
  </form>
</template>

<style scoped>
button:focus {
  outline: none;
}
</style>
