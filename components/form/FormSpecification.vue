<script setup lang="ts">
import { ref, computed } from 'vue'
import { specifications } from '@/data/specifications'

type FormData = Record<string, any>
const form = ref<FormData>({})
const errors = ref<FormData>({})
const accordionState = ref<Record<string, boolean>>({})

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
async function loadImageAsBase64(src: string): Promise<string> {
  const response = await fetch(src)
  const blob = await response.blob()
  return await new Promise<string>((resolve) => {
    const reader = new FileReader()
    reader.onloadend = () => resolve(reader.result as string)
    reader.readAsDataURL(blob)
  })
}
async function generateStructuredPdfWithJsPdf() {
  if (!import.meta.client) return

  const jsPDFModule = await import('jspdf')
  const autoTable = (await import('jspdf-autotable')).default
  const jsPDF = jsPDFModule.default

  const doc = new jsPDF({ unit: 'mm', format: 'a4', orientation: 'portrait' })
  const today = new Date().toLocaleDateString('fr-FR')
  let currentY = 10

  // Logo (optionnel)
  const logoBase64 = await loadImageAsBase64('/images/logo.png')
  doc.addImage(logoBase64, 'PNG', 10, currentY, 50, 15)

// Titre
  doc.setFontSize(24)
  doc.setFont('helvetica', 'bold')

  const title = 'Cahier des charges ' + form.value.nom_entreprise;
  const pageWidth = doc.internal.pageSize.getWidth()
  const textWidth = doc.getTextWidth(title)
  const xPosition = (pageWidth - textWidth) / 2
  doc.text(title, xPosition, 42)

  doc.setFontSize(10)
  doc.setFont('helvetica', 'normal')
  doc.text(`Généré le ${today}`, 200, 15, { align: 'right' })

  currentY += 50

  const grouped = groupedSpecifications.value

  for (const group of grouped) {
    const { name, fields } = group

    doc.setFontSize(13)
    doc.setTextColor(30)
    doc.text(name, 10, currentY)
    currentY += 6

    const rows = fields.map(field => {
      const rawValue = form.value[field.id]
      const value = Array.isArray(rawValue)
          ? rawValue.join(', ')
          : rawValue?.toString().trim() || '(non renseigné)'
      return [field.label, value]
    })

    autoTable(doc, {
      head: [['Question', 'Réponse']],
      body: rows,
      startY: currentY,
      theme: 'grid',
      styles: {
        fontSize: 10,
        cellPadding: 3,
      },
      headStyles: {
        fillColor: [44, 62, 80],
        textColor: 255,
        halign: 'left',
      },
      bodyStyles: {
        valign: 'top',
      },
      columnStyles: {
        0: { cellWidth: 70 },
        1: { cellWidth: 120 },
      },
      margin: { left: 10, right: 10 },
      didDrawPage: (data) => {
        currentY = data.cursor.y + 10
      }
    })
  }

  doc.setFontSize(9)
  doc.setTextColor(150)
  doc.text('Document généré automatiquement via AS-Turing.fr', 10, 290)

  doc.save(`cahier-des-charges-${today.replace(/\//g, '-')}.pdf`)
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

    await generateStructuredPdfWithJsPdf()

    console.log("PDF généré avec succés : ", form.value)
  } else {
    await generateStructuredPdfWithJsPdf()

    console.warn('❌ Erreurs :', errors.value)
  }
}
</script>

<template>
  <form @submit.prevent="handleSubmit">
    <div class="space-y-6 max-w-3xl mx-auto">
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
                rows="5"
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
