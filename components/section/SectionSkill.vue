
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
  <section class="bg-white dark:bg-gray-900 min-h-[60vh] py-12">
    <h2 class="mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-back text-center">
      Mes compétences
    </h2>
    <div class="space-y-6">
      <div
          v-for="skill in skills"
          :key="skill.title"
          class="space-y-2"
      >
        <div class="flex justify-between">
          <h4 class="text-lg font-semibold">{{ skill.title }}</h4>
          <span class="text-sm text-gray-600">{{ skill.level }}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5">
          <div
              class="bg-blue-500 h-2.5 rounded-full"
              :style="{ width: skill.level + '%' }"
          ></div>
        </div>
      </div>
    </div>
  </section>
</template>
