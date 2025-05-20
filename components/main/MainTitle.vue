<script setup lang="ts">
import { ref, onMounted } from 'vue'

const props = defineProps({
  type: String,
  content: Array,
})
const displayedText = ref("")
const typingSpeed = 80
const pauseBetweenTexts = 1000

const typeText = async (texts: any[]) => {
  if (!texts || texts.length === 0) return

  while (true) {
    for (let i = 0; i < texts.length; i++) {
      const text = texts[i]

      displayedText.value = ""

      for (let j = 0; j < text.length; j++) {
        displayedText.value += text[j]
        await new Promise(resolve => setTimeout(resolve, typingSpeed))
      }
      await new Promise(resolve => setTimeout(resolve, pauseBetweenTexts))

      for (let k = 0; k < text.length; k++) {
        displayedText.value = text.substring(0, text.length - k - 1)
        await new Promise(resolve => setTimeout(resolve, typingSpeed))
      }

      await new Promise(resolve => setTimeout(resolve, typingSpeed * 2))
    }
  }
}

onMounted(() => {
  typeText(props.content)
})

</script>

<template>
  <span
      class="max-w-3xl mb-4 text-xl font-extrabold md:text-2xl xl:text-3xl tracking-tight text-white leading-relaxed">
    Envie {{ displayedText }}
  </span>
</template>

<style scoped>

</style>
