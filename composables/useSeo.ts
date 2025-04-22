export const useSeo = () => {
    const route = useRoute()

    const seoMap: Record<string, { title: string; description: string }> = {
        '/': {
            title: 'Accueil - AS Turing',
            description: 'Bienvenue chez AS Turing, votre partenaire digital pour la création de valeur.'
        },
        '/about': {
            title: 'À propos - AS Turing',
            description: 'Découvrez l’histoire, la mission et l’équipe derrière AS Turing.'
        },
        '/contact': {
            title: 'Contact - AS Turing',
            description: 'Prenez contact avec AS Turing pour vos besoins digitaux ou pour toute question.'
        },
        '/engagements': {
            title: 'Nos engagements - AS Turing',
            description: 'Nos valeurs, notre éthique et nos engagements pour un numérique responsable.'
        },
        '/conditions-generales-de-ventes': {
            title: 'Conditions Générales de Vente - AS Turing',
            description: 'Lisez les conditions générales de vente d’AS Turing pour comprendre nos engagements contractuels.'
        },
        '/services': {
            title: 'Nos services - AS Turing',
            description: 'Explorez l’ensemble des services digitaux proposés par AS Turing.'
        },
        '/services/conseil-accompagnement-digital': {
            title: 'Conseil & Accompagnement Digital - AS Turing',
            description: 'AS Turing vous guide dans votre transformation numérique grâce à un accompagnement sur mesure.'
        },
        '/services/creation-site-internet': {
            title: 'Création de site internet - AS Turing',
            description: 'Sites vitrines, e-commerce ou sur mesure : boostez votre présence en ligne avec AS Turing.'
        },
        '/services/developpement-sur-mesure': {
            title: 'Développement sur mesure - AS Turing',
            description: 'Des solutions digitales pensées pour vous : notre expertise en développement personnalisé.'
        },
        '/services/formation-vulgarisation': {
            title: 'Formation & Vulgarisation - AS Turing',
            description: 'Formations accessibles pour tous : le numérique expliqué simplement par AS Turing.'
        },
        '/services/integration-solutions-externes': {
            title: 'Intégration de solutions externes - AS Turing',
            description: 'Connectez vos outils et optimisez vos processus avec nos intégrations intelligentes.'
        },
        '/services/maintenance-support-technique': {
            title: 'Maintenance & Support Technique - AS Turing',
            description: 'Nous veillons sur vos solutions digitales avec un support et une maintenance réactifs.'
        }
    }

    const seo = seoMap[route.path]

    if (seo) {
        useHead({
            title: seo.title,
            meta: [{ name: 'description', content: seo.description }]
        })
    }
}
