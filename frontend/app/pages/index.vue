<template>
  <div>
    <SectionHero />
    <SectionServices />
    <SectionProcess />
    <SectionAdvantages />
    <SectionClients />
    <SectionProjects />
    <SectionBlog />
    <SectionContact />
  </div>
</template>

<script setup lang="ts">
// SEO optimisé pour positionnement local Libourne / Entre-deux-Mers
useHead({
  title: 'Création Site Internet Libourne | Agence Web Entre-deux-Mers - AS-Turing',
  meta: [
    {
      name: 'description',
      content: 'Agence web de proximité à Libourne. Création de sites internet et e-commerce pour commerces et PME. Qualité professionnelle, tarifs accessibles. Libourne, Saint-Émilion, Bordeaux Est.'
    },
    // Open Graph
    {
      property: 'og:title',
      content: 'AS-Turing - Agence Web Libourne | Création Site Internet'
    },
    {
      property: 'og:description',
      content: 'Votre agence web de proximité dans l\'Entre-deux-Mers. Sites vitrines, e-commerce et applications métier. Accompagnement personnalisé, tarifs compétitifs.'
    },
    {
      property: 'og:type',
      content: 'website'
    },
    {
      property: 'og:locale',
      content: 'fr_FR'
    },
    // Keywords (pour certains moteurs)
    {
      name: 'keywords',
      content: 'création site internet Libourne, agence web Libourne, site internet Saint-Émilion, création site e-commerce, agence web Entre-deux-Mers, développement web Bordeaux, site vitrine Gironde'
    },
    // Geo
    {
      name: 'geo.region',
      content: 'FR-33'
    },
    {
      name: 'geo.placename',
      content: 'Libourne'
    },
    // Robots
    {
      name: 'robots',
      content: 'index, follow'
    }
  ],
  // Schema.org LocalBusiness
  script: [
    {
      type: 'application/ld+json',
      children: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'LocalBusiness',
        '@id': 'https://as-turing.fr',
        'name': 'AS-Turing',
        'description': 'Agence web spécialisée en création de sites internet et e-commerce à Libourne',
        'url': 'https://as-turing.fr',
        'telephone': '+33123456789',
        'email': 'contact@as-turing.fr',
        'address': {
          '@type': 'PostalAddress',
          'addressLocality': 'Libourne',
          'addressRegion': 'Nouvelle-Aquitaine',
          'postalCode': '33500',
          'addressCountry': 'FR'
        },
        'geo': {
          '@type': 'GeoCoordinates',
          'latitude': '44.9186',
          'longitude': '-0.2421'
        },
        'areaServed': [
          {
            '@type': 'City',
            'name': 'Libourne'
          },
          {
            '@type': 'City',
            'name': 'Saint-Émilion'
          },
          {
            '@type': 'City',
            'name': 'Bordeaux'
          },
          {
            '@type': 'City',
            'name': 'Créon'
          }
        ],
        'priceRange': '€€',
        'openingHours': 'Mo-Fr 09:00-18:00',
        'sameAs': [
          'https://linkedin.com/company/as-turing',
          'https://github.com/as-turing'
        ]
      })
    },
    {
      type: 'application/ld+json',
      children: JSON.stringify({
        '@context': 'https://schema.org',
        '@type': 'ProfessionalService',
        'name': 'AS-Turing',
        'description': 'Création de sites internet, e-commerce et applications métier sur-mesure',
        'serviceType': [
          'Création site internet',
          'Développement e-commerce',
          'Application web sur-mesure',
          'Refonte site web',
          'Maintenance site internet'
        ],
        'provider': {
          '@type': 'Organization',
          'name': 'AS-Turing'
        },
        'areaServed': {
          '@type': 'GeoCircle',
          'geoMidpoint': {
            '@type': 'GeoCoordinates',
            'latitude': '44.9186',
            'longitude': '-0.2421'
          },
          'geoRadius': '40000'
        }
      })
    }
  ]
})
</script>
