<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-300">
    <!-- Hero Header -->
    <div class="py-20 gradient-soft">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-2 bg-primary/10 dark:bg-primary/20 text-primary rounded-full text-sm font-semibold mb-4">
          Informations légales
        </span>
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
          Mentions Légales
        </h1>
        <p class="text-xl text-gray-600 dark:text-gray-300">
          Informations légales relatives au site as-turing.fr
        </p>
      </div>
    </div>

    <!-- Content -->
    <div v-if="company" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <!-- Éditeur du site -->
      <article class="mb-12 bg-white dark:bg-dark rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-gray-800">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
          1. Éditeur du site
        </h2>
        <div class="space-y-3 text-lg text-gray-600 dark:text-gray-400">
          <p>
            <strong class="text-gray-900 dark:text-white">Raison sociale :</strong> {{ company.companyName }}
          </p>
          <p>
            <strong class="text-gray-900 dark:text-white">Forme juridique :</strong> Entreprise individuelle (Auto-entrepreneur)
          </p>
          <p>
            <strong class="text-gray-900 dark:text-white">Adresse :</strong><br />
            {{ company.address }}<br />
            {{ company.zipCode }} {{ company.city }}<br />
            {{ company.country }}
          </p>
          <p>
            <strong class="text-gray-900 dark:text-white">SIRET :</strong> {{ company.siret }}
          </p>
          <p>
            <strong class="text-gray-900 dark:text-white">N° TVA :</strong> {{ company.tva }}
          </p>
          <p>
            <strong class="text-gray-900 dark:text-white">Email :</strong> 
            <a :href="`mailto:${company.email}`" class="text-primary hover:underline">{{ company.email }}</a>
          </p>
          <p>
            <strong class="text-gray-900 dark:text-white">Téléphone :</strong> 
            <a :href="`tel:${company.phone?.replace(/\s/g, '')}`" class="text-primary hover:underline">{{ company.phone }}</a>
          </p>
        </div>
      </article>

      <!-- Directeur de publication -->
      <article class="mb-12 bg-white dark:bg-dark rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-gray-800">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
          2. Directeur de publication
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-400">
          Le directeur de la publication du site as-turing.fr est le gérant de {{ company.companyName }}.
        </p>
      </article>

      <!-- Hébergement -->
      <article class="mb-12 bg-white dark:bg-dark rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-gray-800">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
          3. Hébergement
        </h2>
        <div class="space-y-3 text-lg text-gray-600 dark:text-gray-400">
          <p>
            <strong class="text-gray-900 dark:text-white">Hébergeur :</strong> {{ company.companyName }} (auto-hébergé)
          </p>
          <p>
            <strong class="text-gray-900 dark:text-white">Adresse :</strong><br />
            {{ company.address }}<br />
            {{ company.zipCode }} {{ company.city }}<br />
            {{ company.country }}
          </p>
        </div>
      </article>

      <!-- Propriété intellectuelle -->
      <article class="mb-12 bg-white dark:bg-dark rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-gray-800">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
          4. Propriété intellectuelle
        </h2>
        <div class="space-y-4 text-lg text-gray-600 dark:text-gray-400">
          <p>
            L'ensemble de ce site relève de la législation française et internationale sur le droit d'auteur et la propriété intellectuelle. Tous les droits de reproduction sont réservés, y compris pour les documents téléchargeables et les représentations iconographiques et photographiques.
          </p>
          <p>
            La reproduction de tout ou partie de ce site sur un support électronique quel qu'il soit est formellement interdite sauf autorisation expresse du directeur de la publication.
          </p>
          <p>
            Les marques citées sur ce site sont déposées par les sociétés qui en sont propriétaires.
          </p>
        </div>
      </article>

      <!-- Données personnelles -->
      <article class="mb-12 bg-white dark:bg-dark rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-gray-800">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
          5. Données personnelles (RGPD)
        </h2>
        <div class="space-y-4 text-lg text-gray-600 dark:text-gray-400">
          <p>
            Conformément au Règlement Général sur la Protection des Données (RGPD) et à la loi Informatique et Libertés, vous disposez d'un droit d'accès, de rectification, de suppression et d'opposition aux données personnelles vous concernant.
          </p>
          <p>
            Les données collectées via le formulaire de contact sont uniquement utilisées pour répondre à votre demande et ne sont jamais transmises à des tiers.
          </p>
          <p>
            Pour exercer vos droits, vous pouvez nous contacter à l'adresse : 
            <a :href="`mailto:${company.email}`" class="text-primary hover:underline">{{ company.email }}</a>
          </p>
          <p>
            Pour en savoir plus, consultez notre 
            <NuxtLink to="/politique-confidentialite" class="text-primary hover:underline font-semibold">
              Politique de confidentialité
            </NuxtLink>.
          </p>
        </div>
      </article>

      <!-- Cookies -->
      <article class="mb-12 bg-white dark:bg-dark rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-gray-800">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
          6. Cookies
        </h2>
        <div class="space-y-4 text-lg text-gray-600 dark:text-gray-400">
          <p>
            Ce site utilise des cookies techniques nécessaires au bon fonctionnement du site (préférences de thème, etc.). Ces cookies ne nécessitent pas de consentement préalable.
          </p>
          <p>
            Aucun cookie de tracking ou de ciblage publicitaire n'est utilisé sur ce site.
          </p>
          <p>
            Vous pouvez à tout moment désactiver les cookies dans les paramètres de votre navigateur.
          </p>
        </div>
      </article>

      <!-- Crédits -->
      <article class="mb-12 bg-white dark:bg-dark rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-gray-800">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
          7. Crédits
        </h2>
        <div class="space-y-3 text-lg text-gray-600 dark:text-gray-400">
          <p>
            <strong class="text-gray-900 dark:text-white">Conception et développement :</strong> {{ company.companyName }}
          </p>
          <p>
            <strong class="text-gray-900 dark:text-white">Technologies utilisées :</strong> Nuxt 3, Vue.js, Symfony, TailwindCSS
          </p>
        </div>
      </article>

      <!-- Limitation de responsabilité -->
      <article class="mb-12 bg-white dark:bg-dark rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-gray-800">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
          8. Limitation de responsabilité
        </h2>
        <div class="space-y-4 text-lg text-gray-600 dark:text-gray-400">
          <p>
            {{ company.companyName }} s'efforce d'assurer au mieux de ses possibilités, l'exactitude et la mise à jour des informations diffusées sur ce site, dont elle se réserve le droit de corriger, à tout moment et sans préavis, le contenu.
          </p>
          <p>
            Toutefois, {{ company.companyName }} ne peut garantir l'exactitude, la précision ou l'exhaustivité des informations mises à disposition sur ce site.
          </p>
          <p>
            En conséquence, {{ company.companyName }} décline toute responsabilité pour toute imprécision, inexactitude ou omission portant sur des informations disponibles sur ce site.
          </p>
        </div>
      </article>

      <!-- Contact -->
      <article class="bg-gradient-to-br from-primary/5 to-secondary/5 dark:from-primary/10 dark:to-secondary/10 rounded-3xl p-8 border border-primary/20 dark:border-primary/30">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6">
          Contact
        </h2>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">
          Pour toute question relative aux mentions légales ou au site as-turing.fr, vous pouvez nous contacter :
        </p>
        <div class="space-y-3">
          <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <a href="mailto:contact@as-turing.fr" class="text-lg text-primary hover:underline font-semibold">
              contact@as-turing.fr
            </a>
          </div>
          <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <a href="tel:+33783070052" class="text-lg text-primary hover:underline font-semibold">
              07 83 07 00 52
            </a>
          </div>
        </div>
      </article>
    </div>
  </div>
</template>

<script setup lang="ts">
const { companyInfo: company } = useCompany()

usePremiumSeo({
  title: 'Mentions Légales | AS-Turing - Agence Web Libourne',
  description: 'Mentions légales d\'AS-Turing : informations sur l\'éditeur, l\'hébergement, la propriété intellectuelle et la conformité RGPD.',
  url: 'https://www.as-turing.fr/mentions-legales',
  type: 'website',
  breadcrumbs: [
    { name: 'Accueil', url: '/' },
    { name: 'Mentions légales', url: '/mentions-legales' }
  ]
})
</script>
