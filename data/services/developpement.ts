import {Service} from "../../types/services";

export const developpementSurMesure:Service = {
    slug: 'developpement-sur-mesure',
    title: "Développement sur mesure",
    description:
        "Un développement adapté à vos besoins spécifiques : fonctionnalités avancées, automatisation, API, algorithmes… Réalisé avec précision et robustesse.",
    microServices: [
        "Développement de fonctionnalités personnalisées",
        "Création de tableaux de bord / back-office spécifiques",
        "Intégration d’API externes (Stripe, Airtable, Notion, etc.)",
        "Automatisation de processus métiers",
        "Développement d’algorithmes métiers",
        "Mise en place de cron jobs, gestion de flux de données"
    ],
    prices: [
        {
            name: "Fonctionnalité unique",
            includes: [
                "Analyse du besoin",
                "Conception technique",
                "Développement d'une fonctionnalité clé",
                "Recette avec vous"
            ],
            price: "à partir de 250€ TTC"
        },
        {
            name: "Module métier sur mesure",
            includes: [
                "Spécification technique détaillée",
                "Développement complet d’un module",
                "Tests unitaires et validation",
                "Documentation utilisateur (si besoin)"
            ],
            price: "à partir de 800€ TTC"
        },
        {
            name: "Pack Dev Premium",
            includes: [
                "10 jours de développement à répartir sur 2 mois",
                "Suivi hebdomadaire de l’avancement",
                "Livraisons itératives et ajustements",
                "Support technique inclus"
            ],
            price: "2 200€ TTC"
        }
    ],
    faq: [
        {
            question: "Ce service inclut-il le design de l’interface ?",
            answer:
                "Le développement s’appuie sur vos maquettes ou sur une interface déjà existante. Si besoin, je peux proposer une prestation de design en complément."
        },
        {
            question: "Est-ce que vous pouvez intégrer ce développement sur mon site existant ?",
            answer:
                "Oui, tant que les contraintes techniques le permettent. Un audit technique peut être proposé en amont pour valider la faisabilité."
        },
        {
            question: "Comment se passe le suivi après livraison ?",
            answer:
                "Une période de support est incluse (variable selon la prestation). Vous pouvez également souscrire à une offre de maintenance pour un suivi plus long."
        }
    ]
}
