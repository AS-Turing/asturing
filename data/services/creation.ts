import { Service } from "../../types/services";

export const creationSiteInternet: Service = {
    slug: 'creation-site-internet',
    title: 'Création de site internet',
    description: 'Un site à votre image, rapide, élégant et optimisé, pour donner à votre projet digital la visibilité qu’il mérite.',
    microServices: [
        'Conception UX/UI avec maquettes sur mesure',
        'Intégration responsive (mobile, tablette, desktop)',
        'Optimisation SEO technique (balises, performance)',
        'Installation sur votre hébergement (OVH, o2switch…)',
        'Formation à la prise en main de votre site'
    ],
    prices: [
        {
            name: 'Essentiel',
            includes: [
                'One page vitrine',
                'Responsive mobile/tablette',
                'Nom de domaine + hébergement 1 an',
                'Formulaire de contact'
            ],
            price: 'À partir de 690€ TTC'
        },
        {
            name: 'Standard',
            includes: [
                'Jusqu’à 5 pages',
                'Blog ou section actualités',
                'Optimisation SEO complète'
            ],
            price: 'À partir de 1 190€ TTC'
        },
        {
            name: 'Sur-mesure',
            includes: [
                'Nombre de pages illimité',
                'Développement spécifique (formulaires avancés, animations...)',
                'Maintenance 3 mois offerte'
            ],
            price: 'Sur devis'
        }
    ],
    faq: [
        {
            question: 'Quel CMS est utilisé ?',
            answer: 'Aucun CMS imposé, tout est codé sur mesure en NuxtJS pour garantir performance et flexibilité.'
        },
        {
            question: 'Puis-je modifier mon site moi-même ?',
            answer: 'Oui, une formation est incluse pour vous permettre de mettre à jour le contenu si besoin.'
        }
    ],
    seo: {
        title: 'Création de site internet sur mesure | AS-Turing',
        description: 'Création de site vitrine ou site web sur mesure à Libourne et Bordeaux. Responsive, optimisé SEO et personnalisé pour votre activité.',
        ogTitle: 'Création de site vitrine performant | AS-Turing',
        ogDescription: 'Développeur freelance à Libourne, je conçois des sites web élégants, rapides et optimisés pour votre visibilité.',
        ogUrl: 'https://www.as-turing.fr/services/creation-site-internet'
    }
}
