import { Service } from "../../types/services";

export const conseilAccompagnementDigital: Service = {
    slug: 'conseil-accompagnement-digital',
    title: "Conseil & accompagnement digital",
    description:
        "Profitez d’un accompagnement sur mesure pour faire les bons choix techniques et stratégiques dans votre projet web ou digital.",
    microServices: [
        "Audit de votre site ou projet existant",
        "Recommandations techniques et stratégiques",
        "Conseils sur l’accessibilité, la performance et l’ergonomie",
        "Choix d’outils et de technologies adaptés à vos besoins",
        "Accompagnement dans la rédaction de cahiers des charges",
        "Suivi de projet ou accompagnement ponctuel sur demande"
    ],
    prices: [
        {
            name: "Consultation Express",
            includes: [
                "Échange d’une heure (visio ou téléphone)",
                "Compte rendu synthétique avec recommandations",
                "Support par mail pendant 7 jours"
            ],
            price: "90€ TTC"
        },
        {
            name: "Accompagnement Projet",
            includes: [
                "Audit approfondi",
                "Sessions régulières de suivi",
                "Conseils techniques personnalisés",
                "Rédaction de livrables (cahier des charges, roadmap...)"
            ],
            price: "à partir de 350€ TTC"
        },
        {
            name: "Coaching Digital",
            includes: [
                "10h d’accompagnement à utiliser librement",
                "Support continu pendant 30 jours",
                "Sessions planifiées selon votre planning",
                "Suivi d’avancement et conseils actionnables"
            ],
            price: "600€ TTC"
        }
    ],
    faq: [
        {
            question: "À qui s’adresse ce service ?",
            answer:
                "Ce service est conçu pour les porteurs de projets, freelances, TPE ou associations qui ont besoin d’y voir plus clair dans leurs choix digitaux."
        },
        {
            question: "Faut-il avoir un projet déjà lancé ?",
            answer:
                "Pas du tout ! Je peux vous accompagner dès la phase d’idée pour vous aider à structurer et poser les bonnes bases."
        },
        {
            question: "Est-ce que l’accompagnement peut inclure du développement ?",
            answer:
                "Ce service est orienté conseil, mais peut être complété par une prestation de développement si besoin, sur devis personnalisé."
        }
    ],
    seo: {
        title: 'Conseil & accompagnement digital | AS-Turing',
        description:
            'Audit, stratégie, choix techniques et suivi de projet — bénéficiez de conseils personnalisés pour faire les bons choix digitaux avec AS-Turing.',
        ogTitle: 'Conseil digital sur mesure | AS-Turing',
        ogDescription:
            'Freelance web à Libourne, j’accompagne les professionnels dans leurs décisions techniques, stratégiques et organisationnelles.',
        ogUrl: 'https://www.as-turing.fr/services/conseil-accompagnement-digital'
    }
}
