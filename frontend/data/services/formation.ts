import { Service } from '../../types/services'

export const formationVulgarisation: Service = {
  slug: 'formation-vulgarisation',
  title: 'Formation et vulgarisation',
  description:
        'Vous souhaitez mieux comprendre le web, les outils ou le code ? Je vous accompagne avec pédagogie pour démystifier la tech, à votre rythme.',
  microServices: [
    'Sensibilisation aux enjeux du web (SEO, performance, accessibilité)',
    'Initiation à HTML/CSS ou JavaScript',
    'Découverte des CMS (WordPress, Strapi...)',
    'Formation à l’utilisation de votre site ou back-office',
    'Sessions de vulgarisation technique (serveurs, bases de données, etc.)',
    'Coaching sur la gestion de projet web'
  ],
  prices: [
    {
      name: 'Session découverte',
      includes: [
        '1h de session en visio ou en présentiel',
        'Sujet au choix (technique, outils, projet)',
        'Support de formation fourni',
        'Échange libre et questions'
      ],
      price: '60€ TTC'
    },
    {
      name: 'Pack initiation',
      includes: [
        '3 sessions de 1h30',
        'Parcours adapté à votre niveau',
        'Supports + exercices pratiques',
        'Suivi par email entre les sessions'
      ],
      price: '240€ TTC'
    },
    {
      name: 'Formation personnalisée',
      includes: [
        'Programme défini sur mesure',
        'Sessions en visio ou en présentiel',
        'Supports adaptés à votre usage (slides, vidéos, démonstrations)',
        'Accès à un espace de ressources dédié'
      ],
      price: 'à partir de 450€ TTC'
    }
  ],
  faq: [
    {
      question: 'Est-ce que je dois avoir des bases pour suivre ces formations ?',
      answer:
                'Pas du tout ! Les formations sont conçues pour être accessibles à tous, même sans aucune connaissance technique.'
    },
    {
      question: 'Est-ce que je peux demander un sujet précis ?',
      answer:
                'Absolument ! Chaque session peut être adaptée à votre besoin : un outil, un concept technique, ou même un audit en direct de votre site.'
    },
    {
      question: 'Faites-vous des formations en entreprise ?',
      answer:
                'Oui, des sessions groupées ou en individuel sont possibles. Contactez-moi pour définir un format adapté à votre équipe.'
    }
  ],
  seo: {
    title: 'Formation web et vulgarisation numérique | AS-Turing',
    description: 'Formations sur mesure au web, HTML/CSS, JavaScript, CMS, gestion de projet… à Libourne ou en visio. Vulgarisation technique accessible à tous.',
    ogTitle: 'Formation au numérique pour tous | AS-Turing',
    ogDescription: 'Apprenez à votre rythme avec un formateur pédagogue : web, outils, projet digital. Sessions à distance ou en entreprise.',
    ogUrl: 'https://www.as-turing.fr/services/formation-vulgarisation'
  }
}
