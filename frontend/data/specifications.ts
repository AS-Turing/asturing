type FieldOption = {
    value: string;
    label: string;
};

type FieldValidation = {
    pattern?: string;
    min?: number;
    max?: number;
    errorMessage?: string;
};

export type Specification = {
    id: string;
    label: string;
    type: 'text' | 'email' | 'number' | 'date' | 'tel' | 'textarea' | 'select' | 'checkbox' | 'radio';
    placeholder?: string;
    required: boolean;
    validation?: FieldValidation;
    tooltip?: string;
    category: string;
    order: number;
    options?: FieldOption[];
};

export const specifications: Specification[] = [
    // === 1. INFORMATIONS PERSONNELLES ===
    {
        id: "prenom",
        label: "Quel est votre prénom ?",
        type: "text",
        placeholder: "Entrez votre prénom",
        required: true,
        validation: {
            pattern: "^[A-Za-zÀ-ÖØ-öø-ÿ\\s]{1,50}$",
            errorMessage: "Veuillez entrer un prénom valide",
        },
        tooltip: "Votre prénom sera utilisé pour personnaliser nos échanges.",
        category: "Informations personnelles",
        order: 1,
    },
    {
        id: "nom",
        label: "Quel est votre nom de famille ?",
        type: "text",
        placeholder: "Entrez votre nom",
        required: true,
        validation: {
            pattern: "^[A-Za-zÀ-ÖØ-öø-ÿ\\s'-]{1,50}$",
            errorMessage: "Veuillez entrer un nom valide",
        },
        tooltip: "Utilisé pour l'identification dans le document final.",
        category: "Informations personnelles",
        order: 2,
    },
    {
        id: "email",
        label: "Quelle est votre adresse e-mail ?",
        type: "email",
        placeholder: "exemple@domaine.com",
        required: true,
        validation: {
            pattern: "^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$",
            errorMessage: "Veuillez entrer une adresse e-mail valide",
        },
        tooltip: "Pour vous recontacter facilement.",
        category: "Informations personnelles",
        order: 3,
    },
    {
        id: "telephone",
        label: "Quel est votre numéro de téléphone ?",
        type: "tel",
        placeholder: "Ex: 0601020304",
        required: true,
        validation: {
            pattern: "^\\+?\\d{7,15}$",
            errorMessage: "Veuillez entrer un numéro de téléphone valide",
        },
        tooltip: "Pour un contact plus rapide si nécessaire.",
        category: "Informations personnelles",
        order: 4,
    },

    // === 2. ENTREPRISE / ORGANISATION ===
    {
        id: "nom_entreprise",
        label: "Quel est le nom de votre entreprise ou organisation ?",
        type: "text",
        placeholder: "Nom de l’entreprise",
        required: true,
        tooltip: "Utilisé pour contextualiser le projet.",
        category: "Entreprise",
        order: 5,
    },
    {
        id: "secteur_activite",
        label: "Dans quel secteur d'activité évoluez-vous ?",
        type: "text",
        placeholder: "Ex : Restauration, Éducation, Industrie...",
        required: true,
        tooltip: "Permet d'adapter les recommandations à votre secteur.",
        category: "Entreprise",
        order: 6,
    },
    {
        id: "taille_entreprise",
        label: "Quelle est la taille de votre structure ?",
        type: "select",
        placeholder: "Sélectionnez",
        required: true,
        options: [
            { value: "Auto-entrepreneur", label: "Auto-entrepreneur" },
            { value: "TPE", label: "TPE (1-10 personnes)" },
            { value: "PME", label: "PME (10-250 personnes)" },
            { value: "Grande entreprise", label: "Grande entreprise" },
            { value: "Association", label: "Association" },
            { value: "Collectivité", label: "Collectivité" },
        ],
        tooltip: "Nous permet d'estimer les ressources disponibles et l'organisation du projet.",
        category: "Entreprise",
        order: 7,
    },

    // === 3. OBJECTIFS DU PROJET ===
    {
        id: "objectif_principal",
        label: "Quel est l'objectif principal de votre projet ?",
        type: "textarea",
        placeholder: "Décrivez votre but (vendre en ligne, présenter vos services, générer des leads...)",
        required: true,
        tooltip: "Un bon objectif permet d’orienter tout le reste du projet.",
        category: "Objectifs du projet",
        order: 8,
    },
    {
        id: "objectifs_secondaires",
        label: "Y a-t-il d'autres objectifs secondaires ?",
        type: "textarea",
        placeholder: "Ex : Améliorer l'image de marque, fidéliser les clients, etc.",
        required: false,
        tooltip: "Listez les objectifs annexes éventuels.",
        category: "Objectifs du projet",
        order: 9,
    },
    {
        id: "problematique",
        label: "Quelle problématique essayez-vous de résoudre avec ce projet ?",
        type: "textarea",
        placeholder: "Décrivez le problème que votre site web doit résoudre",
        required: false,
        tooltip: "Comprendre le problème nous aide à proposer la bonne solution.",
        category: "Objectifs du projet",
        order: 10,
    },

    // === 4. CIBLES & UTILISATEURS ===
    {
        id: "cibles",
        label: "Qui sont vos cibles principales ?",
        type: "textarea",
        placeholder: "Ex : Particuliers, professionnels, étudiants...",
        required: true,
        tooltip: "Cela influencera fortement le design et le contenu.",
        category: "Cibles & utilisateurs",
        order: 11,
    },
    {
        id: "besoins_utilisateurs",
        label: "Quels sont leurs besoins spécifiques ?",
        type: "textarea",
        placeholder: "Décrivez ce que vos utilisateurs recherchent",
        required: true,
        tooltip: "Comprendre les besoins des utilisateurs est essentiel pour créer une expérience adaptée.",
        category: "Cibles & utilisateurs",
        order: 12,
    },

    // === 5. CONTENU ===
    {
        id: "contenu_disponible",
        label: "Disposez-vous déjà de contenu (textes, images, vidéos...) ?",
        type: "radio",
        required: true,
        options: [
            { value: "oui", label: "Oui" },
            { value: "partiellement", label: "Partiellement" },
            { value: "non", label: "Non" },
        ],
        tooltip: "Le contenu est souvent un point critique dans un projet.",
        category: "Contenu",
        order: 13,
    },
    {
        id: "pages_souhaitees",
        label: "Avez-vous déjà une idée du nombre et type de pages souhaitées ?",
        type: "textarea",
        placeholder: "Ex : Accueil, À propos, Contact, Blog, Boutique...",
        required: true,
        tooltip: "Donne une première estimation du périmètre.",
        category: "Contenu",
        order: 14,
    },
    {
        id: "accompagnement_redaction",
        label: "Souhaitez-vous un accompagnement à la rédaction ?",
        type: "select",
        placeholder: "Oui / Non / Je ne sais pas",
        required: true,
        options: [
            { value: "Oui", label: "Oui" },
            { value: "Non", label: "Non" },
            { value: "À déterminer", label: "À déterminer"}
        ],
        tooltip: "",
        category: "Contenu",
        order: 15,
    },
    {
        id: "import_contenu",
        label: "Des contenus sont-ils déjà existants à importer ? (Produits, articles...)",
        type: "textarea",
        placeholder: "Précisez le type, la quantité et le format si possible",
        required: false,
        tooltip: "Cela permet d'anticiper les efforts de migration ou d'intégration.",
        category: "Contenu",
        order: 16,
    },
    {
        id: "traduction",
        label: "Y a-t-il un besoin de traduction ou multilingue ?",
        type: "textarea",
        placeholder: "Précisez les langues nécessaires",
        required: false,
        tooltip: "Important pour l'architecture du site et son référencement.",
        category: "Contenu",
        order: 17,
    },

    // === 6. DESIGN & EXPÉRIENCE UTILISATEUR ===
    {
        id: "charte_graphique",
        label: "Avez-vous une charte graphique existante ?",
        type: "radio",
        required: true,
        options: [
            { value: "oui", label: "Oui" },
            { value: "non", label: "Non" },
            { value: "En cours de création", label: "En cours de création" },
        ],
        tooltip: "Permet de savoir s’il faut intégrer un travail graphique au projet.",
        category: "Design & expérience utilisateur",
        order: 18,
    },
    {
        id: "design_type",
        label: "Souhaitez-vous un design sur mesure ou basé sur un modèle ?",
        type: "radio",
        required: true,
        options: [
            { value: "Sur mesure", label: "Sur mesure" },
            { value: "Modèle", label: "Modèle" },
            { value: "À déterminer", label: "À déterminer"}
        ],
        tooltip: "",
        category: "Design & expérience utilisateur",
        order: 19,
    },
    {
        id: "valeurs_design",
        label: "Quelles émotions/valeurs voulez-vous que le design véhicule ?",
        type: "textarea",
        placeholder: "",
        required: false,
        tooltip: "",
        category: "Design & expérience utilisateur",
        order: 20,
    },
    {
        id: "exemples_sites",
        label: "Avez-vous des exemples de sites que vous aimez (ou détestez) ?",
        type: "textarea",
        placeholder: "Listez les URLs ou noms, avec un commentaire si possible.",
        required: false,
        tooltip: "Cela guide l’ergonomie et l’univers graphique.",
        category: "Design & expérience utilisateur",
        order: 21,
    },
    // === 7. FONCTIONNALITÉS ATTENDUES ===
    {
        id: "fonctionnalites",
        label: "Quelles fonctionnalités souhaitez-vous intégrer ?",
        type: "checkbox",
        required: false,
        options: [
            { value: "blog", label: "Blog" },
            { value: "ecommerce", label: "E-commerce" },
            { value: "formulaire", label: "Formulaire de contact" },
            { value: "reservation", label: "Système de réservation" },
            { value: "compte_client", label: "Espace client / membre" },
            { value: "multilingue", label: "Site multilingue" },
            { value: "autre", label: "Autre (à préciser dans le champ suivant)" },
        ],
        tooltip: "C’est une base pour déterminer le périmètre technique.",
        category: "Fonctionnalités attendues",
        order: 22,
    },
    {
        id: "fonctionnalites_autres",
        label: "Autres fonctionnalités à préciser",
        type: "textarea",
        placeholder: "Décrivez toute autre idée ou besoin technique.",
        required: false,
        tooltip: "À utiliser si les options précédentes ne suffisent pas.",
        category: "Fonctionnalités attendues",
        order: 23,
    },
    {
        id: "fonctionnalites_mvp",
        label: "Listez les fonctionnalités indispensables (MVP).",
        type: "textarea",
        placeholder: "Les fonctionnalités sans lesquelles le site ne peut pas être lancé",
        required: true,
        tooltip: "Ces fonctionnalités seront prioritaires dans le développement.",
        category: "Fonctionnalités attendues",
        order: 24,
    },
    {
        id: "fonctionnalites_optionnelles",
        label: "Quelles fonctionnalités seraient un plus mais pas vitales ?",
        type: "textarea",
        placeholder: "Fonctionnalités qui pourraient être développées dans un second temps",
        required: false,
        tooltip: "Nous aide à planifier les phases de développement.",
        category: "Fonctionnalités attendues",
        order: 25,
    },
    {
        id: "fonctionnalites_techniques",
        label: "Y a-t-il des fonctionnalités techniques précises à intégrer ?",
        type: "textarea",
        placeholder: "Ex: paiement, carte interactive...",
        required: false,
        tooltip: "Précisez les aspects techniques spécifiques nécessaires.",
        category: "Fonctionnalités attendues",
        order: 26,
    },

    // === 8. MARKETING & RÉFÉRENCEMENT ===
    {
        id: "seo",
        label: "Souhaitez-vous optimiser le site pour le référencement naturel (SEO) ?",
        type: "radio",
        required: true,
        options: [
            { value: "oui", label: "Oui" },
            { value: "non", label: "Non" },
            { value: "À préciser", label: "À préciser" },
        ],
        tooltip: "Important pour la visibilité sur les moteurs de recherche.",
        category: "Marketing & référencement",
        order: 27,
    },
    {
        id: "reseaux_sociaux",
        label: "Souhaitez-vous intégrer des réseaux sociaux ?",
        type: "checkbox",
        required: false,
        options: [
            { value: "facebook", label: "Facebook" },
            { value: "instagram", label: "Instagram" },
            { value: "linkedin", label: "LinkedIn" },
            { value: "x", label: "X / Twitter" },
            { value: "tiktok", label: "TikTok" },
        ],
        tooltip: "Pour lier votre site à votre présence sociale.",
        category: "Marketing & référencement",
        order: 28,
    },

    // === 10. TECHNIQUE & INFRASTRUCTURE ===
    {
        id: "preferences_techno",
        label: "Avez-vous une préférence technologique ou CMS ?",
        type: "textarea",
        placeholder: "Ex: WordPress, Shopify, développement sur mesure...",
        required: false,
        tooltip: "Nous aide à orienter les choix techniques.",
        category: "Technique & infrastructure",
        order: 29,
    },
    // === 11. SÉCURITÉ & CONFORMITÉ ===
    {
        id: "donnees_personnelles",
        label: "Votre site collectera-t-il des données personnelles ?",
        type: "radio",
        required: true,
        options: [
            { value: "oui", label: "Oui" },
            { value: "non", label: "Non" },
            { value: "À déterminer", label: "À déterminer"}
        ],
        tooltip: "Pour anticiper les obligations légales (RGPD).",
        category: "Sécurité & conformité",
        order: 30,
    },
    {
        id: "CGU/CGV",
        label: "Souhaitez-vous que nous gérions la rédaction des mentions légales et CGU/CGV ?",
        type: "radio",
        required: true,
        options: [
            { value: "oui", label: "Oui" },
            { value: "non", label: "Non" },
            { value: "À déterminer", label: "À déterminer"}
        ],
        tooltip: "Les mentions légales et CGU/CGV sont obligatoires pour tout site professionnel. Nous pouvons vous accompagner pour rédiger ces documents de manière conforme (RGPD, e-commerce, collecte de données…).",
        category: "Sécurité & conformité",
        order: 30,
    },
    {
        id: "rgpd_accompagnement",
        label: "Souhaitez-vous un accompagnement sur la conformité RGPD ?",
        type: "radio",
        required: true,
        options: [
            { value: "oui", label: "Oui" },
            { value: "non", label: "Non" },
        ],
        tooltip: "Nous pouvons vous aider à mettre en place les éléments nécessaires à la conformité.",
        category: "Sécurité & conformité",
        order: 31,
    },
    {
        id: "accessibilite",
        label: "Souhaitez-vous que le site soit conforme aux normes d'accessibilité (WCAG) ?",
        type: "radio",
        required: true,
        options: [
            { value: "oui", label: "Oui" },
            { value: "non", label: "Non" },
            { value: "À déterminer", label: "À déterminer"}
        ],
        tooltip: "Notamment pour les personnes en situation de handicap.",
        category: "Sécurité & conformité",
        order: 32,
    },

    // === 12. COLLABORATION & SUIVI ===
    {
        id: "equipe_projet",
        label: "Avez-vous une équipe projet ou un interlocuteur dédié ?",
        type: "text",
        placeholder: "Précisez qui sera impliqué côté client",
        required: true,
        tooltip: "Nous aide à comprendre avec qui nous collaborerons.",
        category: "Collaboration & suivi",
        order: 33,
    },
    {
        id: "redaction_contenu",
        label: "Souhaitez-vous être accompagné pour la rédaction de contenu ?",
        type: "radio",
        required: false,
        options: [
            { value: "oui", label: "Oui" },
            { value: "non", label: "Non" },
            { value: "partiellement", label: "Partiellement" },
        ],
        tooltip: "Textes optimisés SEO, storytelling, mise en page, etc.",
        category: "Contenu",
        order: 35,
    },
    {
        id: "mots_cles",
        label: "Quels mots-clés aimeriez-vous cibler pour votre référencement ?",
        type: "textarea",
        required: false,
        placeholder: "Listez quelques expressions importantes pour votre activité.",
        tooltip: "Aide à orienter la stratégie de contenu et de référencement.",
        category: "Marketing & référencement",
        order: 36,
    },
    {
        id: "nom_domaine",
        label: "Avez-vous déjà un nom de domaine ?",
        type: "radio",
        required: true,
        options: [
            { value: "oui", label: "Oui" },
            { value: "non", label: "Non" },
            { value: "À acheter", label: "Je souhaite que vous m’aidiez à en choisir un" },
        ],
        tooltip: "Élément essentiel pour la mise en ligne du site.",
        category: "Technique & infrastructure",
        order: 37,
    },
    {
        id: "hebergement",
        label: "Disposez-vous déjà d’un hébergement web ?",
        type: "radio",
        required: true,
        options: [
            { value: "oui", label: "Oui" },
            { value: "non", label: "Non" },
            { value: "À migrer", label: "Oui, mais je souhaite migrer" },
        ],
        tooltip: "Nécessaire pour la mise en ligne du site.",
        category: "Technique & infrastructure",
        order: 38,
    },
    {
        id: "frequence_suivi",
        label: "À quelle fréquence souhaitez-vous des points d’avancement ?",
        type: "radio",
        placeholder: "Ex: hebdomadaire, bi-mensuel...",
        required: true,
        options: [
            { value: "Hebdomadaire", label: "Hebdomadaire" },
            { value: "Mensuel", label: "Mensuel" },
            { value: "Bimensuel", label: "bimensuel" },
            { value: "À déterminer", label: "À déterminer" },
        ],
        tooltip: "Permet d'établir un rythme de communication adapté.",
        category: "Collaboration & suivi",
        order: 39,
    },
    {
        id: "experience_prestataire",
        label: "Avez-vous déjà travaillé avec des prestataires externes ? Comment cela s’est-il passé ?",
        type: "textarea",
        placeholder: "Partagez votre expérience précédente",
        required: false,
        tooltip: "Nous aide à adapter notre approche à vos attentes.",
        category: "Collaboration & suivi",
        order: 40,
    },
    {
        id: "formation_admin",
        label: "Souhaitez-vous une formation pour gérer le site (CMS, contenu, etc.) ?",
        type: "radio",
        required: true,
        options: [
            { value: "oui", label: "Oui" },
            { value: "non", label: "Non" },
        ],
        tooltip: "Pour être autonome après la livraison du site.",
        category: "Collaboration & suivi",
        order: 41,
    },

    // === 13. MAINTENANCE & ÉVOLUTION ===
    {
        id: "maintenance_besoin",
        label: "Souhaitez-vous un service de maintenance après la mise en ligne ?",
        type: "radio",
        required: true,
        options: [
            { value: "oui", label: "Oui" },
            { value: "non", label: "Non" },
            { value: "À déterminer", label: "À déterminer" },
        ],
        tooltip: "Mise à jour du site, correctifs, évolutions futures...",
        category: "Maintenance & évolution",
        order: 42,
    },
    {
        id: "evolutions_prevues",
        label: "Avez-vous déjà en tête des évolutions futures du projet ?",
        type: "textarea",
        required: false,
        placeholder: "Ex : ajout d'un blog, nouvelles fonctionnalités...",
        tooltip: "Nous aide à concevoir une architecture évolutive.",
        category: "Maintenance & évolution",
        order: 43,
    },

    // === 14. CONTRAINTES & REMARQUES ===
    {
        id: "contraintes",
        label: "Y a-t-il des contraintes techniques, juridiques, ou autres à prendre en compte ?",
        type: "textarea",
        placeholder: "Normes, RGPD, hébergement, accessibilité, etc.",
        required: true,
        tooltip: "Toute contrainte spécifique qui pourrait impacter le projet.",
        category: "Contraintes & remarques",
        order: 44,
    },
    {
        id: "remarques",
        label: "Souhaitez-vous ajouter autre chose ?",
        type: "textarea",
        placeholder: "Remarques ou demandes spécifiques...",
        required: false,
        tooltip: "Tout élément supplémentaire qui vous semble important.",
        category: "Contraintes & remarques",
        order: 45,
    },

    // === 9. PLANNING & BUDGET ===
    {
        id: "budget",
        label: "Quel est votre budget approximatif ?",
        type: "number",
        placeholder: "En euros",
        required: true,
        validation: {
            min: 1000,
            max: 100000,
            errorMessage: "Le budget doit être compris entre 1 000 et 100 000 euros",
        },
        tooltip: "Indiquez une fourchette pour cadrer les solutions proposées.",
        category: "Budget",
        order: 46,
    },
    {
        id: "delai",
        label: "Quel est votre délai idéal de livraison ?",
        type: "date",
        placeholder: "Choisissez une date",
        required: true,
        tooltip: "Permet de planifier la charge de travail.",
        category: "Planification",
        order: 47,
    },
    {
        id: "dates_cles",
        label: "Quelles sont les dates clés à respecter ?",
        type: "textarea",
        placeholder: "",
        required: false,
        tooltip: "Indiquez les dates et évènements liés à respecter",
        category: "Planification",
        order: 48,
    },
];
