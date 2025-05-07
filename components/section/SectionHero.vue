<script setup lang="ts">
const scrollToElement = (id: string) => {
  const targetElement = document.getElementById(id)
  if (targetElement) {
    targetElement.scrollIntoView({
      behavior: 'smooth',
      block: 'start',
    })
  } else {
    console.warn(`L'élément avec l'id "${id}" est introuvable.`)
  }
}
</script>

<template>
  <section
      class="relative bg-white dark:bg-gray-900 min-h-[80vh] bg-cover bg-center before:content-[''] before:z-0 before:absolute before:inset-0 before:bg-black before:bg-opacity-50" style="background-image:url('/images/hero.png')">
    <div class="absolute w-full z-10 min-h-[80vh] grid max-w-screen-xl px-2 py-8 mx-auto lg:gap-8 xl:gap-0 lg:px-24 lg:py-16 lg:grid-cols-12">
      <Transition name="slide" appear>
        <div class="mr-auto place-self-center lg:col-span-12">
          <h1 class="max-w-2xl mb-4 text-4xl font-extrabold md:text-5xl xl:text-6xl tracking-tight text-white leading-relaxed">
            Mon objectif ?<br> Vous aider à réaliser vos envie Numériques
          </h1>
          <p class="max-w-2xl mb-6 font-light text-white lg:mb-8 md:text-lg lg:text-xl dark:text-white">
            Chez <span class="font-bold jetbrains-mono-800">&lt; AS-Turing /&gt;</span> je vous aide à concrétiser vos
            projets numérique.
            <br>
            Un site ? Un conseil ? Une formation? Je suis à votre disposition pour vous accompagner au mieux dans l'univers du web.
          </p>
          <button
              @click="scrollToElement('contact-form')"
              class="group inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center border rounded-lg
             text-secondary bg-primary hover:text-primary hover:bg-secondary border-secondary hover:border-primary
             dark:text-primary dark:bg-secondary dark:hover:text-secondary dark:hover:bg-primary dark:border-gray-700    dark:focus:ring-gray-800
             hover:scale-105 transition-all duration-700 ease-in-out transform focus:ring-4 focus:ring-gray-100 hover:cursor-pointer"
          >
            <Icon name="lucide:handshake"
                  class="w-5 h-5 transition-all duration-700 group-hover:scale-110 group-hover:rotate-12" />
            <span class="ml-2 transition-all duration-700 group-hover:translate-x-1  font-bold">
            Travaillons ensemble
          </span>
          </button>
        </div>
      </Transition>
    </div>
  </section>
</template>

<style scoped>

.slide-enter-active, .slide-leave-active {
  transition: all 1s ease;
}
.slide-enter-from {
  transform: translateX(-50px);
  opacity: 0;
}
.slide-enter-to {
  transform: translateX(0);
  opacity: 1;
}
.slide-leave-from {
  transform: translateX(0);
  opacity: 1;
}
.slide-leave-to {
  transform: translateX(-50px);
  opacity: 0;
}
</style>
