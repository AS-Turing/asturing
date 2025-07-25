import { Service } from '../../types/services'

export const maintenanceSupport: Service = {
  slug: 'maintenance-support-technique',
  title: 'Maintenance & support technique',
  description:
        'Gagnez en sérénité avec un site toujours fonctionnel, à jour et sécurisé. Je vous accompagne pour assurer sa longévité technique.',
  microServices: [
    'Mises à jour de sécurité (CMS, plugins, dépendances)',
    'Sauvegardes régulières',
    'Correction de bugs ou anomalies',
    'Assistance en cas de panne ou d’incident',
    'Optimisation continue des performances',
    'Ajout de contenus ou de fonctionnalités simples'
  ],
  prices: [
    {
      name: 'Assistance ponctuelle',
      includes: [
        'Analyse rapide de la demande',
        'Correction de bugs ou ajout simple si possible',
        'Rapport d’intervention détaillé',
        'Délais rapides selon disponibilité'
      ],
      price: '60€ TTC / heure'
    },
    {
      name: 'Maintenance standard',
      includes: [
        '1 intervention par mois',
        'Mises à jour de sécurité incluses',
        'Sauvegarde mensuelle',
        'Support technique par email'
      ],
      price: '90€ TTC / mois'
    },
    {
      name: 'Maintenance premium',
      includes: [
        '3 interventions par mois',
        'Mises à jour + sauvegardes hebdomadaires',
        'Monitoring de disponibilité',
        'Support prioritaire (email + téléphone)',
        'Rapport mensuel d’activité'
      ],
      price: '180€ TTC / mois'
    }
  ],
  faq: [
    {
      question: 'Puis-je résilier à tout moment ?',
      answer:
                'Oui, les offres de maintenance sont sans engagement. Il suffit de me prévenir avant le prochain mois.'
    },
    {
      question: 'Est-ce que vous intervenez aussi le week-end ?',
      answer:
                "En cas d’urgence critique, je peux intervenir en dehors des horaires classiques. Privilégiez l'offre premium pour bénéficier d’un support prioritaire."
    },
    {
      question: 'Que se passe-t-il si je ne consomme pas toutes les interventions ?',
      answer:
                'Les interventions non utilisées ne sont pas reportées, mais je vous propose toujours des améliorations ou petites évolutions à faire pour en profiter pleinement.'
    },
    {
      question: 'Mon site n’a pas été développé par vous, puis-je quand même vous confier la maintenance ?',
      answer: "Oui, après un rapide audit technique pour m'assurer de pouvoir intervenir efficacement. Un devis spécifique peut être proposé si besoin."
    },
    {
      question: 'Est-ce que vous proposez des rapports de performance ?',
      answer: 'Oui, un suivi de la disponibilité, du temps de chargement et des erreurs peut être inclus dans les forfaits de maintenance standard ou premium.'
    }
  ],
  seo: {
    title: 'Maintenance site web & support technique | AS-Turing',
    description:
            'Gardez votre site web sécurisé, rapide et fonctionnel. Maintenance préventive, dépannage, sauvegardes et assistance sur mesure.',
    ogTitle: 'Support technique & maintenance web | AS-Turing',
    ogDescription:
            'Confiez-moi la maintenance de votre site : mises à jour, monitoring, sécurité et support technique dédié.',
    ogUrl: 'https://www.as-turing.fr/services/maintenance-support-technique'
  }
}
