<?php

namespace App\DataFixtures;

use App\Entity\Specification;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SpecificationsFixtures extends Fixture implements DependentFixtureInterface
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {
        // === 1. INFORMATIONS PERSONNELLES ===
        $this->createSpecification(
            $manager,
            'prenom',
            'Quel est votre prénom ?',
            'text',
            'Entrez votre prénom',
            true,
            '^[A-Za-zÀ-ÖØ-öø-ÿ\\s]{1,50}$',
            null,
            null,
            'Veuillez entrer un prénom valide',
            'Votre prénom sera utilisé pour personnaliser nos échanges.',
            'Informations personnelles',
            1,
            null
        );

        $this->createSpecification(
            $manager,
            'nom',
            'Quel est votre nom de famille ?',
            'text',
            'Entrez votre nom',
            true,
            '^[A-Za-zÀ-ÖØ-öø-ÿ\\s\'-]{1,50}$',
            null,
            null,
            'Veuillez entrer un nom valide',
            'Utilisé pour l\'identification dans le document final.',
            'Informations personnelles',
            2,
            null
        );

        $this->createSpecification(
            $manager,
            'email',
            'Quelle est votre adresse e-mail ?',
            'email',
            'exemple@domaine.com',
            true,
            '^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$',
            null,
            null,
            'Veuillez entrer une adresse e-mail valide',
            'Pour vous recontacter facilement.',
            'Informations personnelles',
            3,
            null
        );

        $this->createSpecification(
            $manager,
            'telephone',
            'Quel est votre numéro de téléphone ?',
            'tel',
            'Ex: 0601020304',
            true,
            '^\\+?\\d{7,15}$',
            null,
            null,
            'Veuillez entrer un numéro de téléphone valide',
            'Pour un contact plus rapide si nécessaire.',
            'Informations personnelles',
            4,
            null
        );

        // === 2. ENTREPRISE / ORGANISATION ===
        $this->createSpecification(
            $manager,
            'nom_entreprise',
            'Quel est le nom de votre entreprise ou organisation ?',
            'text',
            'Nom de l\'entreprise',
            true,
            null,
            null,
            null,
            null,
            'Utilisé pour contextualiser le projet.',
            'Entreprise',
            5,
            null
        );

        $this->createSpecification(
            $manager,
            'secteur_activite',
            'Dans quel secteur d\'activité évoluez-vous ?',
            'text',
            'Ex : Restauration, Éducation, Industrie...',
            true,
            null,
            null,
            null,
            null,
            'Permet d\'adapter les recommandations à votre secteur.',
            'Entreprise',
            6,
            null
        );

        $this->createSpecification(
            $manager,
            'taille_entreprise',
            'Quelle est la taille de votre structure ?',
            'select',
            'Sélectionnez',
            true,
            null,
            null,
            null,
            null,
            'Nous permet d\'estimer les ressources disponibles et l\'organisation du projet.',
            'Entreprise',
            7,
            [
                ['value' => 'Auto-entrepreneur', 'label' => 'Auto-entrepreneur'],
                ['value' => 'TPE', 'label' => 'TPE (1-10 personnes)'],
                ['value' => 'PME', 'label' => 'PME (10-250 personnes)'],
                ['value' => 'Grande entreprise', 'label' => 'Grande entreprise'],
                ['value' => 'Association', 'label' => 'Association'],
                ['value' => 'Collectivité', 'label' => 'Collectivité'],
            ]
        );

        // === 3. OBJECTIFS DU PROJET ===
        $this->createSpecification(
            $manager,
            'objectif_principal',
            'Quel est l\'objectif principal de votre projet ?',
            'textarea',
            'Décrivez votre but (vendre en ligne, présenter vos services, générer des leads...)',
            true,
            null,
            null,
            null,
            null,
            'Un bon objectif permet d\'orienter tout le reste du projet.',
            'Objectifs du projet',
            8,
            null
        );

        $this->createSpecification(
            $manager,
            'objectifs_secondaires',
            'Y a-t-il d\'autres objectifs secondaires ?',
            'textarea',
            'Ex : Améliorer l\'image de marque, fidéliser les clients, etc.',
            false,
            null,
            null,
            null,
            null,
            'Listez les objectifs annexes éventuels.',
            'Objectifs du projet',
            9,
            null
        );

        $this->createSpecification(
            $manager,
            'problematique',
            'Quelle problématique essayez-vous de résoudre avec ce projet ?',
            'textarea',
            'Décrivez le problème que votre site web doit résoudre',
            false,
            null,
            null,
            null,
            null,
            'Comprendre le problème nous aide à proposer la bonne solution.',
            'Objectifs du projet',
            10,
            null
        );

        // === 4. CIBLES & UTILISATEURS ===
        $this->createSpecification(
            $manager,
            'cibles',
            'Qui sont vos cibles principales ?',
            'textarea',
            'Ex : Particuliers, professionnels, étudiants...',
            true,
            null,
            null,
            null,
            null,
            'Cela influencera fortement le design et le contenu.',
            'Cibles & utilisateurs',
            11,
            null
        );

        $this->createSpecification(
            $manager,
            'besoins_utilisateurs',
            'Quels sont leurs besoins spécifiques ?',
            'textarea',
            'Décrivez ce que vos utilisateurs recherchent',
            true,
            null,
            null,
            null,
            null,
            'Comprendre les besoins des utilisateurs est essentiel pour créer une expérience adaptée.',
            'Cibles & utilisateurs',
            12,
            null
        );

        // === 5. CONTENU ===
        $this->createSpecification(
            $manager,
            'contenu_disponible',
            'Disposez-vous déjà de contenu (textes, images, vidéos...) ?',
            'radio',
            null,
            true,
            null,
            null,
            null,
            null,
            'Le contenu est souvent un point critique dans un projet.',
            'Contenu',
            13,
            [
                ['value' => 'oui', 'label' => 'Oui'],
                ['value' => 'partiellement', 'label' => 'Partiellement'],
                ['value' => 'non', 'label' => 'Non'],
            ]
        );

        $this->createSpecification(
            $manager,
            'pages_souhaitees',
            'Avez-vous déjà une idée du nombre et type de pages souhaitées ?',
            'textarea',
            'Ex : Accueil, À propos, Contact, Blog, Boutique...',
            true,
            null,
            null,
            null,
            null,
            'Donne une première estimation du périmètre.',
            'Contenu',
            14,
            null
        );

        $this->createSpecification(
            $manager,
            'accompagnement_redaction',
            'Souhaitez-vous un accompagnement à la rédaction ?',
            'select',
            'Oui / Non / Je ne sais pas',
            true,
            null,
            null,
            null,
            null,
            '',
            'Contenu',
            15,
            [
                ['value' => 'Oui', 'label' => 'Oui'],
                ['value' => 'Non', 'label' => 'Non'],
                ['value' => 'À déterminer', 'label' => 'À déterminer'],
            ]
        );

        $this->createSpecification(
            $manager,
            'import_contenu',
            'Des contenus sont-ils déjà existants à importer ? (Produits, articles...)',
            'textarea',
            'Précisez le type, la quantité et le format si possible',
            false,
            null,
            null,
            null,
            null,
            'Cela permet d\'anticiper les efforts de migration ou d\'intégration.',
            'Contenu',
            16,
            null
        );

        $this->createSpecification(
            $manager,
            'traduction',
            'Y a-t-il un besoin de traduction ou multilingue ?',
            'textarea',
            'Précisez les langues nécessaires',
            false,
            null,
            null,
            null,
            null,
            'Important pour l\'architecture du site et son référencement.',
            'Contenu',
            17,
            null
        );

        // === 6. DESIGN & EXPÉRIENCE UTILISATEUR ===
        $this->createSpecification(
            $manager,
            'charte_graphique',
            'Avez-vous une charte graphique existante ?',
            'radio',
            null,
            true,
            null,
            null,
            null,
            null,
            'Permet de savoir s\'il faut intégrer un travail graphique au projet.',
            'Design & expérience utilisateur',
            18,
            [
                ['value' => 'oui', 'label' => 'Oui'],
                ['value' => 'non', 'label' => 'Non'],
                ['value' => 'En cours de création', 'label' => 'En cours de création'],
            ]
        );

        $this->createSpecification(
            $manager,
            'design_type',
            'Souhaitez-vous un design sur mesure ou basé sur un modèle ?',
            'radio',
            null,
            true,
            null,
            null,
            null,
            null,
            '',
            'Design & expérience utilisateur',
            19,
            [
                ['value' => 'Sur mesure', 'label' => 'Sur mesure'],
                ['value' => 'Modèle', 'label' => 'Modèle'],
                ['value' => 'À déterminer', 'label' => 'À déterminer'],
            ]
        );

        $this->createSpecification(
            $manager,
            'valeurs_design',
            'Quelles émotions/valeurs voulez-vous que le design véhicule ?',
            'textarea',
            '',
            false,
            null,
            null,
            null,
            null,
            '',
            'Design & expérience utilisateur',
            20,
            null
        );

        $this->createSpecification(
            $manager,
            'exemples_sites',
            'Avez-vous des exemples de sites que vous aimez (ou détestez) ?',
            'textarea',
            'Listez les URLs ou noms, avec un commentaire si possible.',
            false,
            null,
            null,
            null,
            null,
            'Cela guide l\'ergonomie et l\'univers graphique.',
            'Design & expérience utilisateur',
            21,
            null
        );

        // === 7. FONCTIONNALITÉS ATTENDUES ===
        $this->createSpecification(
            $manager,
            'fonctionnalites',
            'Quelles fonctionnalités souhaitez-vous intégrer ?',
            'checkbox',
            null,
            false,
            null,
            null,
            null,
            null,
            'C\'est une base pour déterminer le périmètre technique.',
            'Fonctionnalités attendues',
            22,
            [
                ['value' => 'blog', 'label' => 'Blog'],
                ['value' => 'ecommerce', 'label' => 'E-commerce'],
                ['value' => 'formulaire', 'label' => 'Formulaire de contact'],
                ['value' => 'reservation', 'label' => 'Système de réservation'],
                ['value' => 'compte_client', 'label' => 'Espace client / membre'],
                ['value' => 'multilingue', 'label' => 'Site multilingue'],
                ['value' => 'autre', 'label' => 'Autre (à préciser dans le champ suivant)'],
            ]
        );

        $this->createSpecification(
            $manager,
            'fonctionnalites_autres',
            'Autres fonctionnalités à préciser',
            'textarea',
            'Décrivez toute autre idée ou besoin technique.',
            false,
            null,
            null,
            null,
            null,
            'À utiliser si les options précédentes ne suffisent pas.',
            'Fonctionnalités attendues',
            23,
            null
        );

        $this->createSpecification(
            $manager,
            'fonctionnalites_mvp',
            'Listez les fonctionnalités indispensables (MVP).',
            'textarea',
            'Les fonctionnalités sans lesquelles le site ne peut pas être lancé',
            true,
            null,
            null,
            null,
            null,
            'Ces fonctionnalités seront prioritaires dans le développement.',
            'Fonctionnalités attendues',
            24,
            null
        );

        $this->createSpecification(
            $manager,
            'fonctionnalites_optionnelles',
            'Quelles fonctionnalités seraient un plus mais pas vitales ?',
            'textarea',
            'Fonctionnalités qui pourraient être développées dans un second temps',
            false,
            null,
            null,
            null,
            null,
            'Nous aide à planifier les phases de développement.',
            'Fonctionnalités attendues',
            25,
            null
        );

        $this->createSpecification(
            $manager,
            'fonctionnalites_techniques',
            'Y a-t-il des fonctionnalités techniques précises à intégrer ?',
            'textarea',
            'Ex: paiement, carte interactive...',
            false,
            null,
            null,
            null,
            null,
            'Précisez les aspects techniques spécifiques nécessaires.',
            'Fonctionnalités attendues',
            26,
            null
        );

        // === 8. MARKETING & RÉFÉRENCEMENT ===
        $this->createSpecification(
            $manager,
            'seo',
            'Souhaitez-vous optimiser le site pour le référencement naturel (SEO) ?',
            'radio',
            null,
            true,
            null,
            null,
            null,
            null,
            'Important pour la visibilité sur les moteurs de recherche.',
            'Marketing & référencement',
            27,
            [
                ['value' => 'oui', 'label' => 'Oui'],
                ['value' => 'non', 'label' => 'Non'],
                ['value' => 'À préciser', 'label' => 'À préciser'],
            ]
        );

        $this->createSpecification(
            $manager,
            'reseaux_sociaux',
            'Souhaitez-vous intégrer des réseaux sociaux ?',
            'checkbox',
            null,
            false,
            null,
            null,
            null,
            null,
            'Pour lier votre site à votre présence sociale.',
            'Marketing & référencement',
            28,
            [
                ['value' => 'facebook', 'label' => 'Facebook'],
                ['value' => 'instagram', 'label' => 'Instagram'],
                ['value' => 'linkedin', 'label' => 'LinkedIn'],
                ['value' => 'x', 'label' => 'X / Twitter'],
                ['value' => 'tiktok', 'label' => 'TikTok'],
            ]
        );

        // === 9. TECHNIQUE & INFRASTRUCTURE ===
        $this->createSpecification(
            $manager,
            'preferences_techno',
            'Avez-vous une préférence technologique ou CMS ?',
            'textarea',
            'Ex: WordPress, Shopify, développement sur mesure...',
            false,
            null,
            null,
            null,
            null,
            'Nous aide à orienter les choix techniques.',
            'Technique & infrastructure',
            29,
            null
        );

        // === 10. SÉCURITÉ & CONFORMITÉ ===
        $this->createSpecification(
            $manager,
            'donnees_personnelles',
            'Votre site collectera-t-il des données personnelles ?',
            'radio',
            null,
            true,
            null,
            null,
            null,
            null,
            'Pour anticiper les obligations légales (RGPD).',
            'Sécurité & conformité',
            30,
            [
                ['value' => 'oui', 'label' => 'Oui'],
                ['value' => 'non', 'label' => 'Non'],
                ['value' => 'À déterminer', 'label' => 'À déterminer'],
            ]
        );

        $this->createSpecification(
            $manager,
            'CGU/CGV',
            'Souhaitez-vous que nous gérions la rédaction des mentions légales et CGU/CGV ?',
            'radio',
            null,
            true,
            null,
            null,
            null,
            null,
            'Les mentions légales et CGU/CGV sont obligatoires pour tout site professionnel. Nous pouvons vous accompagner pour rédiger ces documents de manière conforme (RGPD, e-commerce, collecte de données…).',
            'Sécurité & conformité',
            30,
            [
                ['value' => 'oui', 'label' => 'Oui'],
                ['value' => 'non', 'label' => 'Non'],
                ['value' => 'À déterminer', 'label' => 'À déterminer'],
            ]
        );

        $this->createSpecification(
            $manager,
            'rgpd_accompagnement',
            'Souhaitez-vous un accompagnement sur la conformité RGPD ?',
            'radio',
            null,
            true,
            null,
            null,
            null,
            null,
            'Nous pouvons vous aider à mettre en place les éléments nécessaires à la conformité.',
            'Sécurité & conformité',
            31,
            [
                ['value' => 'oui', 'label' => 'Oui'],
                ['value' => 'non', 'label' => 'Non'],
            ]
        );

        $this->createSpecification(
            $manager,
            'accessibilite',
            'Souhaitez-vous que le site soit conforme aux normes d\'accessibilité (WCAG) ?',
            'radio',
            null,
            true,
            null,
            null,
            null,
            null,
            'Notamment pour les personnes en situation de handicap.',
            'Sécurité & conformité',
            32,
            [
                ['value' => 'oui', 'label' => 'Oui'],
                ['value' => 'non', 'label' => 'Non'],
                ['value' => 'À déterminer', 'label' => 'À déterminer'],
            ]
        );

        // === 11. COLLABORATION & SUIVI ===
        $this->createSpecification(
            $manager,
            'equipe_projet',
            'Avez-vous une équipe projet ou un interlocuteur dédié ?',
            'text',
            'Précisez qui sera impliqué côté client',
            true,
            null,
            null,
            null,
            null,
            'Nous aide à comprendre avec qui nous collaborerons.',
            'Collaboration & suivi',
            33,
            null
        );

        $this->createSpecification(
            $manager,
            'redaction_contenu',
            'Souhaitez-vous être accompagné pour la rédaction de contenu ?',
            'radio',
            null,
            false,
            null,
            null,
            null,
            null,
            'Textes optimisés SEO, storytelling, mise en page, etc.',
            'Contenu',
            35,
            [
                ['value' => 'oui', 'label' => 'Oui'],
                ['value' => 'non', 'label' => 'Non'],
                ['value' => 'partiellement', 'label' => 'Partiellement'],
            ]
        );

        $this->createSpecification(
            $manager,
            'mots_cles',
            'Quels mots-clés aimeriez-vous cibler pour votre référencement ?',
            'textarea',
            'Listez quelques expressions importantes pour votre activité.',
            false,
            null,
            null,
            null,
            null,
            'Aide à orienter la stratégie de contenu et de référencement.',
            'Marketing & référencement',
            36,
            null
        );

        $this->createSpecification(
            $manager,
            'nom_domaine',
            'Avez-vous déjà un nom de domaine ?',
            'radio',
            null,
            true,
            null,
            null,
            null,
            null,
            'Élément essentiel pour la mise en ligne du site.',
            'Technique & infrastructure',
            37,
            [
                ['value' => 'oui', 'label' => 'Oui'],
                ['value' => 'non', 'label' => 'Non'],
                ['value' => 'À acheter', 'label' => 'Je souhaite que vous m\'aidiez à en choisir un'],
            ]
        );

        $this->createSpecification(
            $manager,
            'hebergement',
            'Disposez-vous déjà d\'un hébergement web ?',
            'radio',
            null,
            true,
            null,
            null,
            null,
            null,
            'Nécessaire pour la mise en ligne du site.',
            'Technique & infrastructure',
            38,
            [
                ['value' => 'oui', 'label' => 'Oui'],
                ['value' => 'non', 'label' => 'Non'],
                ['value' => 'À migrer', 'label' => 'Oui, mais je souhaite migrer'],
            ]
        );

        $this->createSpecification(
            $manager,
            'frequence_suivi',
            'À quelle fréquence souhaitez-vous des points d\'avancement ?',
            'radio',
            'Ex: hebdomadaire, bi-mensuel...',
            true,
            null,
            null,
            null,
            null,
            'Permet d\'établir un rythme de communication adapté.',
            'Collaboration & suivi',
            39,
            [
                ['value' => 'Hebdomadaire', 'label' => 'Hebdomadaire'],
                ['value' => 'Mensuel', 'label' => 'Mensuel'],
                ['value' => 'Bimensuel', 'label' => 'bimensuel'],
                ['value' => 'À déterminer', 'label' => 'À déterminer'],
            ]
        );

        $this->createSpecification(
            $manager,
            'experience_prestataire',
            'Avez-vous déjà travaillé avec des prestataires externes ? Comment cela s\'est-il passé ?',
            'textarea',
            'Partagez votre expérience précédente',
            false,
            null,
            null,
            null,
            null,
            'Nous aide à adapter notre approche à vos attentes.',
            'Collaboration & suivi',
            40,
            null
        );

        $this->createSpecification(
            $manager,
            'formation_admin',
            'Souhaitez-vous une formation pour gérer le site (CMS, contenu, etc.) ?',
            'radio',
            null,
            true,
            null,
            null,
            null,
            null,
            'Pour être autonome après la livraison du site.',
            'Collaboration & suivi',
            41,
            [
                ['value' => 'oui', 'label' => 'Oui'],
                ['value' => 'non', 'label' => 'Non'],
            ]
        );

        // === 12. MAINTENANCE & ÉVOLUTION ===
        $this->createSpecification(
            $manager,
            'maintenance_besoin',
            'Souhaitez-vous un Service de maintenance après la mise en ligne ?',
            'radio',
            null,
            true,
            null,
            null,
            null,
            null,
            'Mise à jour du site, correctifs, évolutions futures...',
            'Maintenance & évolution',
            42,
            [
                ['value' => 'oui', 'label' => 'Oui'],
                ['value' => 'non', 'label' => 'Non'],
                ['value' => 'À déterminer', 'label' => 'À déterminer'],
            ]
        );

        $this->createSpecification(
            $manager,
            'evolutions_prevues',
            'Avez-vous déjà en tête des évolutions futures du projet ?',
            'textarea',
            'Ex : ajout d\'un blog, nouvelles fonctionnalités...',
            false,
            null,
            null,
            null,
            null,
            'Nous aide à concevoir une architecture évolutive.',
            'Maintenance & évolution',
            43,
            null
        );

        // === 13. CONTRAINTES & REMARQUES ===
        $this->createSpecification(
            $manager,
            'contraintes',
            'Y a-t-il des contraintes techniques, juridiques, ou autres à prendre en compte ?',
            'textarea',
            'Normes, RGPD, hébergement, accessibilité, etc.',
            true,
            null,
            null,
            null,
            null,
            'Toute contrainte spécifique qui pourrait impacter le projet.',
            'Contraintes & remarques',
            44,
            null
        );

        $this->createSpecification(
            $manager,
            'remarques',
            'Souhaitez-vous ajouter autre chose ?',
            'textarea',
            'Remarques ou demandes spécifiques...',
            false,
            null,
            null,
            null,
            null,
            'Tout élément supplémentaire qui vous semble important.',
            'Contraintes & remarques',
            45,
            null
        );

        // === 14. PLANNING & BUDGET ===
        $this->createSpecification(
            $manager,
            'budget',
            'Quel est votre budget approximatif ?',
            'number',
            'En euros',
            true,
            null,
            1000,
            100000,
            'Le budget doit être compris entre 1 000 et 100 000 euros',
            'Indiquez une fourchette pour cadrer les solutions proposées.',
            'Budget',
            46,
            null
        );

        $this->createSpecification(
            $manager,
            'delai',
            'Quel est votre délai idéal de livraison ?',
            'date',
            'Choisissez une date',
            true,
            null,
            null,
            null,
            null,
            'Permet de planifier la charge de travail.',
            'Planification',
            47,
            null
        );

        $this->createSpecification(
            $manager,
            'dates_cles',
            'Quelles sont les dates clés à respecter ?',
            'textarea',
            '',
            false,
            null,
            null,
            null,
            null,
            'Indiquez les dates et évènements liés à respecter',
            'Planification',
            48,
            null
        );

        $manager->flush();
    }

    private function createSpecification(
        ObjectManager $manager,
        string $id,
        string $label,
        string $type,
        ?string $placeholder,
        bool $required,
        ?string $pattern,
        ?int $min,
        ?int $max,
        ?string $errorMessage,
        ?string $tooltip,
        string $categoryName,
        int $order,
        ?array $options
    ): void {
        $category = $this->categoryRepository->findOneBy(['name' => $categoryName]);

        if (!$category) {
            throw new \Exception("Category not found: $categoryName");
        }

        $specification = new Specification();
        $specification->setLabel($label);
        $specification->setType($type);
        $specification->setPlaceholder($placeholder ?? '');
        $specification->setRequired($required);
        $specification->setPattern($pattern ?? '');
        $specification->setMin($min);
        $specification->setMax($max);
        $specification->setErrorMessage($errorMessage ?? '');
        $specification->setTooltip($tooltip);
        $specification->setDisplayOrder($order);
        $specification->setTypeOptions($options);
        $specification->setCategory($category);

        $manager->persist($specification);
    }
}
