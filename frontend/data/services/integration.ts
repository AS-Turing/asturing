import { Service } from '../../types/services'

export const integrationSolutionsExternes: Service = {
  slug: 'integration-solutions-externes',
  title: 'Intégration de solutions externes',
  description:
        'Boostez les fonctionnalités de votre site en y intégrant des outils ou services externes adaptés à vos besoins.',
  microServices: [
    'Connexion à des APIs (Google Maps, Stripe, Mailchimp, etc.)',
    'Ajout de modules de paiement ou de réservation',
    'Mise en place de services tiers (chat en ligne, analytics…)',
    'Synchronisation avec vos outils métiers',
    'Intégration de CRM, newsletters, ERP, etc.',
    'Documentation technique pour l’équipe en interne'
  ],
  prices: [
    {
      name: 'Intégration simple',
      includes: [
        'Connexion à une API ou un outil tiers',
        'Configuration de base',
        'Test de bon fonctionnement',
        'Documentation rapide d’utilisation'
      ],
      price: '150€ TTC'
    },
    {
      name: 'Intégration avancée',
      includes: [
        'Connexion à plusieurs services',
        'Synchronisation automatisée (webhooks, scripts…)',
        'Interface personnalisée pour l’administration',
        'Support après livraison inclus (7 jours)'
      ],
      price: '300€ TTC'
    },
    {
      name: 'Intégration sur mesure',
      includes: [
        'Analyse du besoin technique',
        'Conception de middleware ou passerelle personnalisée',
        'Interconnexion avec systèmes internes',
        'Suivi et tests approfondis'
      ],
      price: 'Sur devis'
    }
  ],
  faq: [
    {
      question: 'Quels services pouvez-vous intégrer ?',
      answer:
                'Presque tous : CRM, outils de mailing, solutions de paiement, analytics, outils RH… On échange ensemble sur la faisabilité.'
    },
    {
      question: 'Et si l’outil n’a pas d’API ?',
      answer:
                'Il existe parfois des solutions alternatives comme des scripts d’automatisation ou des connecteurs non officiels. Je vous accompagne pour trouver la meilleure option.'
    },
    {
      question: 'L’intégration inclut-elle les frais de l’outil externe ?',
      answer:
                'Non, les éventuels frais d’abonnement aux outils restent à votre charge. Mais je peux vous conseiller des solutions gratuites ou open source quand c’est possible.'
    }
  ],
  seo: {
    title: "Intégration d'API & outils externes | AS-Turing",
    description: 'Connectez votre site à des services tiers (CRM, analytics, paiement...) pour automatiser et enrichir votre expérience digitale.',
    ogTitle: 'Intégration de solutions externes web | AS-Turing',
    ogDescription: 'Automatisez, synchronisez, connectez : intégration d’outils sur mesure (Stripe, Mailchimp, Google Maps, etc.) pour votre site web.',
    ogUrl: 'https://www.as-turing.fr/services/integration-solutions-externes'
  }
}
