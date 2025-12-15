<template>
  <div>
    <!-- Hero section - immédiatement chargée (above the fold) -->
    <SectionHero />
    
    <!-- Sections lazy-loadées avec le système natif de Nuxt -->
    <ClientOnly>
      <LazySectionServices />
      <LazySectionProjects />
      <LazySectionClients />
      <LazySectionProcess />
      <LazySectionAdvantages />
      <LazySectionAbout />
      <LazySectionBlog />
      <LazySectionContact />
    </ClientOnly>
  </div>
</template>

<script setup lang="ts">
const { companyInfo: company } = useCompany()

// SEO Premium AAA avec Open Graph, Twitter Cards, JSON-LD Schema
usePremiumSeo({
  title: 'Création Site Internet Libourne | Agence Web Entre-deux-Mers - AS-Turing',
  description: 'Agence web de proximité à Libourne. Création de sites internet et e-commerce pour commerces et PME. Qualité professionnelle, tarifs accessibles. Libourne, Saint-Émilion, Bordeaux Est.',
  url: 'https://www.as-turing.fr',
  image: 'https://www.as-turing.fr/images/og-home.jpg',
  type: 'website',
  breadcrumbs: [
    { name: 'Accueil', url: '/' }
  ]
})

// Geo + Keywords meta spécifiques local
useHead({
  meta: [
    {
      name: 'keywords',
      content: 'création site internet Libourne, agence web Libourne, site internet Saint-Émilion, création site e-commerce, agence web Entre-deux-Mers, développement web Bordeaux, site vitrine Gironde, TMA Libourne, maintenance site web'
    },
    {
      name: 'geo.region',
      content: 'FR-33'
    },
    {
      name: 'geo.placename',
      content: 'Libourne'
    },
    {
      name: 'geo.position',
      content: '44.9177;-0.2419'
    },
    {
      name: 'ICBM',
      content: '44.9177, -0.2419'
    }
  ]
})
</script>
