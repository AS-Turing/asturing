export const useSeo = () => {
  const route = useRoute()

  const baseTitle = 'AS Turing'
  const baseLocation = 'Libourne, Bordeaux, Créon, Saint-Émilion'
  const mainKeywords = 'création de site internet, développeur web, création site web, transformation digitale'

  const seoMap: Record<string, { title: string; description: string }> = {
    '/': {
      title: `Création de site internet à ${baseLocation} - ${baseTitle}`,
      description: `AS Turing, votre agence digitale à ${baseLocation}, spécialisée en ${mainKeywords}. Boostez votre présence en ligne avec nous.`
    },
    '/about': {
      title: `À propos de votre agence web à ${baseLocation} - ${baseTitle}`,
      description: `Découvrez AS Turing, votre partenaire en ${mainKeywords} basé à ${baseLocation}.`
    },
    '/contact': {
      title: `Contactez votre développeur web à ${baseLocation} - ${baseTitle}`,
      description: `Besoin d'un site internet ou de conseils digitaux à ${baseLocation} ? Contactez AS Turing.`
    },
    '/engagements': {
      title: `Nos engagements pour un numérique responsable à ${baseLocation} - ${baseTitle}`,
      description: `AS Turing s'engage pour un numérique éthique et responsable à ${baseLocation}.`
    },
    '/conditions-generales-de-ventes': {
      title: `CGV - Services digitaux à ${baseLocation} - ${baseTitle}`,
      description: `Consultez nos conditions générales de vente pour nos prestations de ${mainKeywords}.`
    },
    '/services': {
      title: `Services de création de site internet à ${baseLocation} - ${baseTitle}`,
      description: `Découvrez nos services : ${mainKeywords} pour booster votre activité en ligne à ${baseLocation}.`
    },
    '/services/conseil-accompagnement-digital': {
      title: `Conseil en transformation digitale à ${baseLocation} - ${baseTitle}`,
      description: `AS Turing vous accompagne dans votre projet numérique à ${baseLocation} avec des conseils personnalisés.`
    },
    '/services/creation-site-internet': {
      title: `Création de site internet à ${baseLocation} - ${baseTitle}`,
      description: `Confiez la création de votre site vitrine ou e-commerce à nos experts basés à ${baseLocation}.`
    },
    '/services/developpement-sur-mesure': {
      title: `Développement web sur mesure à ${baseLocation} - ${baseTitle}`,
      description: `Des solutions digitales adaptées à vos besoins, réalisées depuis ${baseLocation} par AS Turing.`
    },
    '/services/formation-vulgarisation': {
      title: `Formations numériques à ${baseLocation} - ${baseTitle}`,
      description: `Simplifiez votre compréhension du digital avec nos formations adaptées à tous niveaux à ${baseLocation}.`
    },
    '/services/integration-solutions-externes': {
      title: `Intégration de solutions digitales à ${baseLocation} - ${baseTitle}`,
      description: `Optimisez vos outils digitaux grâce à l'intégration professionnelle d'AS Turing à ${baseLocation}.`
    },
    '/services/maintenance-support-technique': {
      title: `Support technique et maintenance à ${baseLocation} - ${baseTitle}`,
      description: `Garantissez la performance de vos solutions digitales avec notre support basé à ${baseLocation}.`
    }
  }

  const seo = seoMap[route.path]

  if (seo) {
    useHead({
      title: seo.title,
      meta: [
        { name: 'description', content: seo.description },
        { name: 'keywords', content: `${mainKeywords}, ${baseLocation}, site internet, développement web` },
        { property: 'og:title', content: seo.title },
        { property: 'og:description', content: seo.description }
      ]
    })
  }
}
