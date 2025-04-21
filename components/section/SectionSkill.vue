<script setup lang="ts">
const skills = [
  { title: "HTML", level: 90 },
  { title: "CSS", level: 80 },
  { title: "JavaScript", level: 85 },
  { title: "Vue.js", level: 70 },
  { title: "TailwindCSS", level: 75 }
];
</script>

<template>
  <section class="bg-white dark:bg-gray-900 py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
      <h2 class="text-4xl sm:text-5xl font-bold text-center text-primary dark:text-white mb-12 underline underline-offset-8">
        Mes compétences
      </h2>

      <div class="space-y-8">
        <div
            v-for="skill in skills"
            :key="skill.title"
            class="space-y-2"
        >
          <div class="flex justify-between items-center">
            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white">
              {{ skill.title }}
            </h3>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
              {{ skill.level }}%
            </span>
          </div>
          <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
            <div
                class="bg-secondary h-3 transition-all duration-700 ease-in-out"
                :style="{ width: skill.level + '%' }"
            ></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
