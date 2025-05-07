<script setup lang="ts">
const items = [
  {
    title: "Création de site internet",
    icon: "lucide:layout-template", // ou "mdi:web"
    description: "Voyons ensemble comment créer votre identité numérique.",
    image: "/images/crea-web.png",
    link: "services/creation-site-internet"
  },
  {
    title: "Conseil & accompagnement digital",
    icon: "lucide:messages-square", // ou "mdi:account-question"
    description: "Besoin d'aide sur votre site ou besoin d'un avis ? Parlons-en !",
    image: "/images/cons-accomp.png",
    link: "services/conseil-accompagnement-digital"
  },
  {
    title: "Développement sur mesure",
    icon: "lucide:code-2", // ou "mdi:xml"
    description: "Un développement spécifique ? Un algorithme ? Créons le code qui vous convient.",
    image: "/images/dev-surmesur.png",
    link: "services/developpement-sur-mesure"
  },
  {
    title: "Maintenance & support technique",
    icon: "lucide:settings", // ou "mdi:tools"
    description: "Besoin de corriger un bug ? Une montée de version de votre site ? Tout est faisable.",
    image: "/images/maint-st.png",
    link: "services/maintenance-support-technique"
  },
  {
    title: "Intégration de solutions externes",
    icon: "lucide:plug", // ou "mdi:puzzle"
    description: "Vous souhaitez intégrer un nouveau module à votre site ? Voyons si c’est faisable.",
    image: "/images/inte-ext.png",
    link: "services/integration-solutions-externes"
  },
  {
    title: "Formation et vulgarisation",
    icon: "lucide:book-open-check", // ou "mdi:school"
    description: "Vous souhaitez vous sensibiliser au domaine du web ? Prenons rendez-vous.",
    image: "/images/form-vulga.png",
    link: "services/formation-vulgarisation"
  }
];

const visibleCards = ref<number[]>([]); // On stocke les indices des Cards visibles

const observeCards = () => {
  const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          const index = Number(entry.target.getAttribute('data-index'));

          if (entry.isIntersecting) {
            // Ajoute s’il est visible
            if (!visibleCards.value.includes(index)) {
              visibleCards.value.push(index);
            }
          } else {
            // Retire s’il sort de l’écran
            const i = visibleCards.value.indexOf(index);
            if (i !== -1) {
              visibleCards.value.splice(i, 1);
            }
          }
        });
      },
      { threshold: 0.3 }
  );

  const cardElements = document.querySelectorAll('.card-item');
  cardElements.forEach((el) => observer.observe(el));
};

onMounted(() => {
  observeCards();
});
</script>

<template>
  <section class="bg-white dark:bg-gray-900 py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl sm:text-5xl font-bold text-center text-primary dark:text-white mb-12 underline dark:decoration-secondary underline-offset-8">
        Mes services
      </h2>

      <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <NuxtLink
          v-for="(item, index) in items"
          :key="item.title + '-' + index"
          :to="item.link"
          class="card-item group overflow-hidden rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-primary shadow-sm hover:shadow-lg transition-all duration-500"
          :data-index="index"
          :class="{'animate-visible': visibleCards.includes(index)}"
        >
          <img
            :src="item.image"
            alt="Illustration service"
            loading="lazy"
            class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300"
          />
          <div class="p-6">
            <h3 class="text-xl min-h-16 font-semibold text-primary hover:dark:text-secondary dark:text-white mb-2 flex items-center gap-2">
              <Icon :name="item.icon" class="w-5 h-5 dark:text-secondary" />
              {{ item.title }}
            </h3>
            <p class="dark:text-gray-200 text-base leading-relaxed">
              {{ item.description }}
            </p>
          </div>
        </NuxtLink>
      </div>
    </div>
  </section>
</template>

<style scoped>
.card-item {
  opacity: 0;
  transform: translateY(30px);
}

.card-item.animate-visible {
  opacity: 1;
  transform: translateY(0);
  transition: all 1s ease-out;
}

.group:hover .card-item img {
  transform: scale(1.05);
}
</style>