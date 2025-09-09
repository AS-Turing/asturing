<script setup lang="ts">
const { isVisible: showLeft, el: leftEl } = useInView()
const { isVisible: showRight, el: rightEl } = useInView()
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
  <section class="m-auto bg-white dark:bg-gray-900 min-h-[60vh] py-16">
    <h2
      class="mb-4 lg:mb-12 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-primary text-center dark:text-white underline dark:decoration-secondary underline-offset-8">
      À propos de
      <span class="font-bold jetbrains-mono-800">
        <div class="relative inline-block">
          <span
            class="relative block select-none underline-offset-8 underline text-4xl md:text-5xl xl:text-6xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-orange-500 to-sky-500 [text-shadow:0_0_32px_rgba(251,191,36,0.45),0_0_70px_rgba(56,189,248,0.35)]"
          >&lt; AS-Turing /&gt;</span>
        </div>
      </span>
    </h2>
    <div class="w-10/12 max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
      <div class="w-full justify-start items-center gap-8 grid lg:grid-cols-2 grid-cols-1">
        <!--        <Transition name="slide-left">-->
        <div
          ref="leftEl"
          :class="[
            'transition-all duration-1000 transform',
            showLeft ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-10'
          ]"
          class="w-full flex-col justify-start lg:items-start items-center gap-10 inline-flex"
        >

          <div class="w-full flex-col justify-start lg:items-start items-center gap-4 flex">
            <h2
              class="text-gray-900 dark:text-white text-4xl font-bold font-manrope leading-normal lg:text-start text-center">
              Une expertise technique, un accompagnement humain
            </h2>
            <p class="dark:text-gray-200 text-base font-normal leading-relaxed lg:text-start text-center">
              À l’origine d’AS-Turing, il y a une envie d’autonomie, un retour aux sources… et une bonne dose de passion pour le web.
            </p>
            <p class="dark:text-gray-200 text-base font-normal leading-relaxed lg:text-start text-center">
              Je m'appelle Alexandre, développeur web basé à Libourne et ses environs, après une reconversion dans
              le développement, quelques expériences enrichissantes à droite à gauche — notamment chez Motion4Ever à Nantes — j’ai décidé de créer mon propre studio.
            </p>
            <p class="dark:text-gray-200 text-base font-normal leading-relaxed lg:text-start text-center">
              Mon objectif ? Permettre à chacun — particulier ou pro — de concrétiser ses projets numériques, sans jargon, sans prise de tête, et surtout avec un accompagnement humain.
            </p>
            <p class="dark:text-gray-200 text-base font-normal leading-relaxed lg:text-start text-center">
              AS-Turing, c’est des sites web créés sur mesure, du conseil digital accessible, de la maintenance quand vous en avez besoin, et de l'écoute en continu.
            </p>
            <p class="dark:text-gray-200 text-base font-normal leading-relaxed lg:text-start text-center">
              Que vous ayez une idée un peu floue ou un cahier des charges béton, je suis là pour vous aider à faire le pont entre l’envie et la réalisation.
            </p>
          </div>
          <button
            @click="scrollToElement('contact-form')"
            class="group inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center border rounded-lg
             text-secondary bg-primary hover:text-primary hover:bg-secondary border-secondary hover:border-primary
             dark:text-primary dark:bg-secondary dark:hover:text-secondary dark:hover:bg-primary dark:border-gray-700    dark:focus:ring-gray-800
             hover:scale-105 transition-all duration-700 ease-in-out transform focus:ring-4 focus:ring-gray-100 hover:cursor-pointer"
          >
            <Icon name="lucide:pointer"
                  class="w-5 h-5 transition-all duration-700 group-hover:scale-110 group-hover:rotate-12" />
            <span class="ml-2 transition-all duration-700 group-hover:translate-x-1  font-bold">
              Envie d’échanger sur votre projet ?
            </span>
          </button>
        </div>
        <!--        </Transition>-->
        <!--        <Transition name="slide-right">-->
        <img
          ref="rightEl"
          :class="[
            'transition-all duration-1000 transform',
            showRight ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-10'
          ]"
          src="public/images/form-contact-img.png"
          class="lg:mx-0 mx-auto h-full rounded-3xl object-cover"
        />
        <!--        </Transition>-->
      </div>
    </div>
  </section>
</template>


<style scoped>
/* Slide Left */
.slide-left-enter-active,
.slide-left-leave-active {
  transition: all 1s ease;
}
.slide-left-enter-from,
.slide-left-leave-to {
  opacity: 0;
  transform: translateX(-50px);
}
.slide-left-enter-to,
.slide-left-leave-from {
  opacity: 1;
  transform: translateX(0);
}

/* Slide Right */
.slide-right-enter-active,
.slide-right-leave-active {
  transition: all 0.8s ease;
}
.slide-right-enter-from,
.slide-right-leave-to {
  opacity: 0;
  transform: translateX(50px);
}
.slide-right-enter-to,
.slide-right-leave-from {
  opacity: 1;
  transform: translateX(0);
}

</style>