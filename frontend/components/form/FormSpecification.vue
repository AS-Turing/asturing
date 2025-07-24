<script setup lang="ts">
import { ref, computed } from 'vue'
import {SpecificationQuestion} from "../../types/SpecificationQuestion";
import {ApiResponse} from "../../types/apiResponse";

type FormData = Record<string, any>
const form = ref<FormData>({})
const errors = ref<FormData>({})
const accordionState = ref<Record<string, boolean>>({})
const specifications = ref<Specification[]>([]);
const isLoading = ref(false)
const apiError = ref<string | null>(null)

async function loadData() {
  isLoading.value = true
  apiError.value = null
  
  try {
    const response: ApiResponse<SpecificationQuestion[]> = await useApiFetch('/api/specifications/questions')
    
    if (!response || !response.success) {
      throw new Error('La requête API a échoué')
    }
    
    const { success, data } = response
    
    if (!data) {
      throw new Error('Aucune donnée reçue de l\'API')
    }
    
    try {
      // Parse the JSON string in the data field
      const parsedData = JSON.parse(data)
      
      if (!Array.isArray(parsedData)) {
        throw new Error('Format de données invalide')
      }
      
      // Transform the data to match the expected structure
      const transformedData = parsedData.map((item: any) => {
        // Convert category from object to string (category name)
        const categoryName = item.category?.name || 'Autre'
        
        return {
          id: String(item.id), // Convert id to string
          label: item.label,
          type: item.type,
          placeholder: item.placeholder,
          required: item.required,
          validation: {
            pattern: item.pattern,
            min: item.min,
            max: item.max,
            errorMessage: item.errorMessage
          },
          tooltip: item.tooltip,
          category: categoryName,
          order: item.displayOrder || 0,
          options: item.typeOptions // Rename typeOptions to options
        }
      })
      
      specifications.value = transformedData

      // Initialiser les champs et états d'accordéon
      for (const field of specifications.value) {
        if (field.type === 'checkbox') {
          form.value[field.id] = []
        } else {
          form.value[field.id] = ''
        }
      }
    } catch (parseError) {
      console.error('Erreur lors du parsing des données:', parseError)
      apiError.value = 'Erreur lors du traitement des données'
      specifications.value = []
    }
  } catch (error) {
    console.error('Erreur lors du chargement des spécifications:', error)
    apiError.value = 'Impossible de charger les questions du formulaire'
    specifications.value = []
  } finally {
    isLoading.value = false
  }
}

// Grouper les questions par catégorie
const groupedSpecifications = computed(() => {
  const categories: Record<string, any[]> = {}
  
  // Make sure specifications.value is defined before sorting
  if (specifications.value && specifications.value.length > 0) {
    // Sort specifications by order
    const sortedSpecs = [...specifications.value].sort((a, b) => a.order - b.order)
    
    // Group by category
    for (const spec of sortedSpecs) {
      if (!categories[spec.category]) categories[spec.category] = []
      categories[spec.category].push(spec)
    }
  }

  // Initialiser état des accordéons
  for (const categoryName of Object.keys(categories)) {
    if (!(categoryName in accordionState.value)) {
      accordionState.value[categoryName] = false
    }
  }

  return Object.entries(categories).map(([name, fields]) => ({ name, fields }))
})

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

  try {
    const jsPDFModule = await import('jspdf')
    const autoTable = (await import('jspdf-autotable')).default
    const jsPDF = jsPDFModule.default

    const doc = new jsPDF({ unit: 'mm', format: 'a4', orientation: 'portrait' })
    const today = new Date().toLocaleDateString('fr-FR')
    let currentY = 10

    try {
      // Logo (optionnel)
      const logoBase64 = await loadImageAsBase64('/images/logo.png')
      doc.addImage(logoBase64, 'PNG', 10, currentY, 50, 15)
    } catch (error) {
      console.warn("Impossible de charger le logo:", error)
      // Continue without logo
    }

    // Titre
    doc.setFontSize(24)
    doc.setFont('helvetica', 'bold')

    // Use a default name if nom_entreprise is not available
    const companyName = form.value.nom_entreprise || 'Projet'
    const title = 'Cahier des charges ' + companyName
    const pageWidth = doc.internal.pageSize.getWidth()
    const textWidth = doc.getTextWidth(title)
    const xPosition = (pageWidth - textWidth) / 2
    doc.text(title, xPosition, 42)

    doc.setFontSize(10)
    doc.setFont('helvetica', 'normal')
    doc.text(`Généré le ${today}`, 200, 15, { align: 'right' })

    currentY += 50

    // Get grouped specifications
    const grouped = groupedSpecifications.value

    // Process each group
    for (const group of grouped) {
      const { name, fields } = group

      doc.setFontSize(13)
      doc.setTextColor(30)
      doc.text(name, 10, currentY)
      currentY += 6

      // Create rows for the table
      const rows = fields.map(field => {
        const rawValue = form.value[field.id]
        const value = Array.isArray(rawValue)
            ? rawValue.join(', ')
            : rawValue?.toString().trim() || '(non renseigné)'
        return [field.label, value]
      })

      // Add table to the PDF
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

    // Add footer
    doc.setFontSize(9)
    doc.setTextColor(120)
    doc.setFont('helvetica', 'italic')
    doc.text(
        'Ce document a été généré automatiquement via AS-Turing.fr à partir des réponses fournies par le client dans le formulaire.\n' +
        'Il constitue une base de discussion et de cadrage du projet, sans valeur contractuelle sauf mention contraire.',
        10,
        285,
        { maxWidth: 190 }
    )

    // Save the PDF
    doc.save(`cahier-des-charges-${today.replace(/\//g, '-')}.pdf`)
    
    return true
  } catch (error) {
    console.error("Erreur lors de la génération du PDF:", error)
    throw error
  }
}

function toggleCategory(name: string) {
  accordionState.value[name] = !accordionState.value[name]
}

function validateField(field: any, value: any): string | null {
  // Check if required field is empty
  if (field.required && (!value || (Array.isArray(value) && value.length === 0))) {
    return 'Ce champ est requis.'
  }

  // Check validation rules
  if (field.validation) {
    // Pattern validation for string values
    if (field.validation.pattern && typeof value === 'string') {
      try {
        const regex = new RegExp(field.validation.pattern)
        if (!regex.test(value)) {
          return field.validation.errorMessage || 'Format invalide.'
        }
      } catch (error) {
        console.error('Invalid regex pattern:', field.validation.pattern, error)
        return 'Erreur de validation.'
      }
    }

    // Min/max validation for number values
    if (typeof value === 'number') {
      if (
          (field.validation.min !== null && field.validation.min !== undefined && value < field.validation.min) ||
          (field.validation.max !== null && field.validation.max !== undefined && value > field.validation.max)
      ) {
        return field.validation.errorMessage || 'Valeur hors limites.'
      }
    }
  }

  return null
}

async function uploadFile(file: any) {
  const response: ApiResponse<any> = useApiFetch('/file/upload', {
    method: 'POST',
    body: file,
    headers: {
      'Content-Type': 'multipart/form-data',
      'Accept': 'application/json',
    }
  })

  if (!response.success) {
    console.warn(resonse.data)
  }
}
async function handleSubmit() {
  errors.value = {}

  // Make sure specifications.value is defined before validation
  if (specifications.value && specifications.value.length > 0) {
    for (const field of specifications.value) {
      const error = validateField(field, form.value[field.id])
      if (error) {
        errors.value[field.id] = error
      }
    }
  }

  if (Object.keys(errors.value).length === 0) {
    try {
      await generateStructuredPdfWithJsPdf()
      console.log("PDF généré avec succès : ", form.value)
    } catch (error) {
      console.error("Erreur lors de la génération du PDF :", error)
    }
  } else {
    try {
      console.warn('❌ Erreurs :', errors.value)
    } catch (error) {
      console.error("Erreur lors de la génération du PDF :", error)
    }
  }
}

onMounted(() => {
  loadData()

  // Set first category to open by default after a short delay
  setTimeout(() => {
    if (groupedSpecifications.value.length > 0) {
      const firstCategory = groupedSpecifications.value[0].name
      accordionState.value[firstCategory] = true
    }
  }, 500)
})
</script>

<template>
  <div class="max-w-3xl mx-auto">
    <!-- Loading state -->
    <div v-if="isLoading" class="flex justify-center items-center py-12">
      <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
      <span class="ml-3 text-gray-600">Chargement des questions...</span>
    </div>
    
    <!-- Error state -->
    <div v-else-if="apiError" class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative my-6">
      <strong class="font-bold">Erreur !</strong>
      <span class="block sm:inline"> {{ apiError }}</span>
      <button 
        @click="loadData" 
        class="mt-3 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded text-sm"
      >
        Réessayer
      </button>
    </div>
    
    <!-- Empty state -->
    <div v-else-if="!isLoading && specifications.length === 0" class="text-center py-12">
      <p class="text-gray-500">Aucune question n'a été trouvée.</p>
    </div>
    
    <!-- Form content -->
    <form v-else @submit.prevent="handleSubmit" class="space-y-6">
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
    </form>
  </div>
</template>

<style scoped>
button:focus {
  outline: none;
}
</style>
