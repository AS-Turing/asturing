<?php

namespace App\DataFixtures;

use App\Entity\Specification;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpecificationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $specifications = [
            // ============================================
            // SECTION 1 : Informations de contact (5 questions)
            // ============================================
            [
                'label' => 'Quel est votre prénom ?',
                'type' => 'text',
                'placeholder' => 'Entrez votre prénom',
                'required' => true,
                'pattern' => '^[A-Za-zÀ-ÖØ-öø-ÿ\\s\'-]{1,50}$',
                'error_message' => 'Veuillez entrer un prénom valide',
                'tooltip' => 'Prénom du contact principal',
                'display_order' => 1,
            ],
            [
                'label' => 'Quel est votre nom de famille ?',
                'type' => 'text',
                'placeholder' => 'Entrez votre nom',
                'required' => true,
                'pattern' => '^[A-Za-zÀ-ÖØ-öø-ÿ\\s\'-]{1,50}$',
                'error_message' => 'Veuillez entrer un nom valide',
                'tooltip' => 'Nom du contact principal',
                'display_order' => 2,
            ],
            [
                'label' => 'Quelle est votre adresse e-mail ?',
                'type' => 'email',
                'placeholder' => 'exemple@domaine.com',
                'required' => true,
                'pattern' => '^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$',
                'error_message' => 'Veuillez entrer une adresse e-mail valide',
                'tooltip' => 'Email de contact principal',
                'display_order' => 3,
            ],
            [
                'label' => 'Quel est votre numéro de téléphone ?',
                'type' => 'tel',
                'placeholder' => 'Ex: 06 01 02 03 04',
                'required' => true,
                'pattern' => '^\\+?[0-9\\s]{10,15}$',
                'error_message' => 'Veuillez entrer un numéro de téléphone valide',
                'tooltip' => 'Téléphone de contact',
                'display_order' => 4,
            ],
            [
                'label' => 'Quel est le nom de votre entreprise ou organisation ?',
                'type' => 'text',
                'placeholder' => 'Nom de l\'entreprise',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Raison sociale complète',
                'display_order' => 5,
            ],
            
            // ============================================
            // SECTION 2 : Contexte entreprise (2 questions)
            // ============================================
            [
                'label' => 'Dans quel secteur d\'activité évoluez-vous ?',
                'type' => 'text',
                'placeholder' => 'Ex : E-commerce, Santé, Industrie, Services...',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Permet d\'adapter les recommandations à votre secteur',
                'display_order' => 6,
            ],
            [
                'label' => 'Quelle est la taille de votre structure ?',
                'type' => 'select',
                'placeholder' => 'Sélectionnez',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Nous permet d\'estimer les ressources disponibles',
                'display_order' => 7,
                'type_options' => [
                    ['label' => 'Auto-entrepreneur', 'value' => 'auto_entrepreneur'],
                    ['label' => 'TPE (1-10 salariés)', 'value' => 'tpe'],
                    ['label' => 'PME (10-250 salariés)', 'value' => 'pme'],
                    ['label' => 'Grande entreprise (250+ salariés)', 'value' => 'grande_entreprise'],
                    ['label' => 'Association', 'value' => 'association'],
                    ['label' => 'Collectivité', 'value' => 'collectivite'],
                ],
            ],
            
            // ============================================
            // SECTION 3 : Objectifs du projet (5 questions)
            // ============================================
            [
                'label' => 'Quel est l\'objectif principal de votre projet et quelle problématique souhaitez-vous résoudre ?',
                'type' => 'textarea',
                'placeholder' => 'Ex: Créer une boutique en ligne pour vendre nos produits artisanaux et toucher une clientèle nationale',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Décrivez en quelques phrases votre besoin principal',
                'display_order' => 8,
            ],
            [
                'label' => 'Avez-vous d\'autres objectifs secondaires ?',
                'type' => 'textarea',
                'placeholder' => 'Ex : Améliorer l\'image de marque, fidéliser les clients, générer des leads...',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Objectifs complémentaires à prendre en compte',
                'display_order' => 9,
            ],
            [
                'label' => 'Quel est votre budget approximatif pour ce projet ?',
                'type' => 'number',
                'placeholder' => 'En euros',
                'required' => true,
                'pattern' => '',
                'min' => 1000,
                'max' => 200000,
                'error_message' => 'Le budget doit être compris entre 1 000 et 200 000 euros',
                'tooltip' => 'Indiquez une fourchette pour cadrer les solutions proposées',
                'display_order' => 10,
            ],
            [
                'label' => 'Quel est votre délai idéal de livraison ?',
                'type' => 'date',
                'placeholder' => 'Choisissez une date',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Date souhaitée de mise en ligne',
                'display_order' => 11,
            ],
            [
                'label' => 'Y a-t-il des dates clés ou événements à respecter ?',
                'type' => 'textarea',
                'placeholder' => 'Ex: Lancement produit le 15/03, salon professionnel en mai...',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Indiquez les deadlines importantes',
                'display_order' => 12,
            ],
            
            // ============================================
            // SECTION 4 : Cibles & Utilisateurs (2 questions)
            // ============================================
            [
                'label' => 'Qui sont vos cibles principales ?',
                'type' => 'textarea',
                'placeholder' => 'Ex : Particuliers 25-45 ans, professionnels du BTP, décideurs IT...',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Définir les cibles influence le design et le contenu',
                'display_order' => 13,
            ],
            [
                'label' => 'Quels sont leurs besoins spécifiques ?',
                'type' => 'textarea',
                'placeholder' => 'Ex: Trouver rapidement des informations, commander en ligne, prendre RDV...',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Comprendre les besoins utilisateurs est essentiel',
                'display_order' => 14,
            ],
            
            // ============================================
            // SECTION 5 : Contenu (4 questions)
            // ============================================
            [
                'label' => 'Disposez-vous déjà de contenu (textes, images, vidéos...) ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Le contenu est souvent un point critique dans un projet',
                'display_order' => 15,
                'type_options' => [
                    ['label' => 'Oui, tout est prêt', 'value' => 'oui'],
                    ['label' => 'Partiellement', 'value' => 'partiellement'],
                    ['label' => 'Non, il faut tout créer', 'value' => 'non'],
                ],
            ],
            [
                'label' => 'Avez-vous déjà une idée du nombre et type de pages souhaitées ?',
                'type' => 'textarea',
                'placeholder' => 'Ex : Accueil, À propos, Services, Réalisations, Blog, Contact...',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Donne une première estimation du périmètre',
                'display_order' => 16,
            ],
            [
                'label' => 'Souhaitez-vous un accompagnement à la rédaction de contenu ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Textes optimisés SEO, storytelling, mise en page...',
                'display_order' => 17,
                'type_options' => [
                    ['label' => 'Oui, totalement', 'value' => 'oui'],
                    ['label' => 'Partiellement', 'value' => 'partiellement'],
                    ['label' => 'Non, on gère', 'value' => 'non'],
                ],
            ],
            [
                'label' => 'Y a-t-il des contenus existants à importer ou un besoin multilingue ?',
                'type' => 'textarea',
                'placeholder' => 'Ex: Migration de 200 articles de blog, site en FR/EN, import catalogue produits...',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Migration de données, traduction, import de catalogue...',
                'display_order' => 18,
            ],
            
            // ============================================
            // SECTION 6 : Design & UX (4 questions)
            // ============================================
            [
                'label' => 'Avez-vous une charte graphique existante ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Logo, couleurs, typographies...',
                'display_order' => 19,
                'type_options' => [
                    ['label' => 'Oui, complète', 'value' => 'oui'],
                    ['label' => 'Partielle (logo uniquement)', 'value' => 'partielle'],
                    ['label' => 'Non', 'value' => 'non'],
                    ['label' => 'En cours de création', 'value' => 'en_cours'],
                ],
            ],
            [
                'label' => 'Souhaitez-vous un design sur mesure ou basé sur un modèle ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Sur mesure = design unique, Modèle = template personnalisé',
                'display_order' => 20,
                'type_options' => [
                    ['label' => 'Sur mesure', 'value' => 'sur_mesure'],
                    ['label' => 'Basé sur un modèle', 'value' => 'modele'],
                    ['label' => 'À déterminer ensemble', 'value' => 'a_determiner'],
                ],
            ],
            [
                'label' => 'Quelles émotions/valeurs souhaitez-vous que le design véhicule ?',
                'type' => 'textarea',
                'placeholder' => 'Ex: Moderne et dynamique, confiance et sérieux, chaleureux et familial...',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Aide à orienter les choix graphiques',
                'display_order' => 21,
            ],
            [
                'label' => 'Avez-vous des exemples de sites que vous aimez (ou détestez) ?',
                'type' => 'textarea',
                'placeholder' => 'URLs et commentaires (ex: j\'aime le menu, je déteste les pop-ups...)',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Références pour guider l\'ergonomie et le style',
                'display_order' => 22,
            ],
            
            // ============================================
            // SECTION 7 : Fonctionnalités (3 questions)
            // ============================================
            [
                'label' => 'Quelles fonctionnalités souhaitez-vous intégrer ?',
                'type' => 'checkbox',
                'placeholder' => '',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Sélectionnez toutes les fonctionnalités souhaitées',
                'display_order' => 23,
                'type_options' => [
                    ['label' => 'Blog / Actualités', 'value' => 'blog'],
                    ['label' => 'E-commerce / Boutique en ligne', 'value' => 'ecommerce'],
                    ['label' => 'Formulaire de contact avancé', 'value' => 'formulaire'],
                    ['label' => 'Système de réservation / Booking', 'value' => 'reservation'],
                    ['label' => 'Espace client / Espace membre', 'value' => 'compte_client'],
                    ['label' => 'Site multilingue', 'value' => 'multilingue'],
                    ['label' => 'Carte interactive / Localisation', 'value' => 'carte'],
                    ['label' => 'Galerie photos / Portfolio', 'value' => 'galerie'],
                    ['label' => 'Autre (préciser ci-dessous)', 'value' => 'autre'],
                ],
            ],
            [
                'label' => 'Listez les fonctionnalités indispensables pour le lancement (MVP)',
                'type' => 'textarea',
                'placeholder' => 'Ex: Paiement en ligne, filtres de recherche produits, système de notation...',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Les fonctionnalités sans lesquelles le site ne peut pas être lancé',
                'display_order' => 24,
            ],
            [
                'label' => 'Quelles fonctionnalités seraient un plus mais pas vitales ?',
                'type' => 'textarea',
                'placeholder' => 'Ex: Chat en direct, wishlist, comparateur de produits...',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Fonctionnalités qui pourraient être ajoutées dans une V2',
                'display_order' => 25,
            ],
            
            // ============================================
            // SECTION 8 : Technique & Infrastructure (3 questions)
            // ============================================
            [
                'label' => 'Avez-vous une préférence technologique ou CMS ?',
                'type' => 'select',
                'placeholder' => 'Sélectionnez',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Si vous avez déjà une préférence technique',
                'display_order' => 26,
                'type_options' => [
                    ['label' => 'WordPress', 'value' => 'wordpress'],
                    ['label' => 'Shopify', 'value' => 'shopify'],
                    ['label' => 'WooCommerce', 'value' => 'woocommerce'],
                    ['label' => 'PrestaShop', 'value' => 'prestashop'],
                    ['label' => 'Développement sur mesure (Symfony, Laravel...)', 'value' => 'custom'],
                    ['label' => 'Aucune préférence', 'value' => 'aucune'],
                    ['label' => 'Autre', 'value' => 'autre'],
                ],
            ],
            [
                'label' => 'Avez-vous déjà un nom de domaine ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Le nom de domaine (ex: monsite.fr)',
                'display_order' => 27,
                'type_options' => [
                    ['label' => 'Oui, je l\'ai déjà', 'value' => 'oui'],
                    ['label' => 'Non, à acheter', 'value' => 'non'],
                    ['label' => 'Besoin d\'aide pour le choisir', 'value' => 'aide'],
                ],
            ],
            [
                'label' => 'Disposez-vous déjà d\'un hébergement web ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Serveur où sera hébergé le site',
                'display_order' => 28,
                'type_options' => [
                    ['label' => 'Oui, hébergement actif', 'value' => 'oui'],
                    ['label' => 'Non, à mettre en place', 'value' => 'non'],
                    ['label' => 'Oui mais je souhaite migrer', 'value' => 'migration'],
                ],
            ],
            
            // ============================================
            // SECTION 9 : SEO & Marketing (3 questions)
            // ============================================
            [
                'label' => 'Souhaitez-vous optimiser le site pour le référencement naturel (SEO) ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Optimisation pour Google et moteurs de recherche',
                'display_order' => 29,
                'type_options' => [
                    ['label' => 'Oui, c\'est prioritaire', 'value' => 'oui_prioritaire'],
                    ['label' => 'Oui, si possible', 'value' => 'oui_si_possible'],
                    ['label' => 'Non', 'value' => 'non'],
                ],
            ],
            [
                'label' => 'Quels mots-clés aimeriez-vous cibler pour votre référencement ?',
                'type' => 'textarea',
                'placeholder' => 'Ex: plombier Paris, création site web Lyon, avocat droit famille...',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Expressions que vos clients tapent dans Google',
                'display_order' => 30,
            ],
            [
                'label' => 'Quels réseaux sociaux souhaitez-vous intégrer ?',
                'type' => 'checkbox',
                'placeholder' => '',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Liens et intégrations réseaux sociaux',
                'display_order' => 31,
                'type_options' => [
                    ['label' => 'Facebook', 'value' => 'facebook'],
                    ['label' => 'Instagram', 'value' => 'instagram'],
                    ['label' => 'LinkedIn', 'value' => 'linkedin'],
                    ['label' => 'X / Twitter', 'value' => 'x'],
                    ['label' => 'TikTok', 'value' => 'tiktok'],
                    ['label' => 'YouTube', 'value' => 'youtube'],
                    ['label' => 'Autre', 'value' => 'autre'],
                ],
            ],
            
            // ============================================
            // SECTION 10 : Juridique & Conformité (4 questions)
            // ============================================
            [
                'label' => 'Votre site collectera-t-il des données personnelles ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Formulaires, comptes clients, cookies... (RGPD)',
                'display_order' => 32,
                'type_options' => [
                    ['label' => 'Oui', 'value' => 'oui'],
                    ['label' => 'Non', 'value' => 'non'],
                    ['label' => 'Je ne sais pas', 'value' => 'je_ne_sais_pas'],
                ],
            ],
            [
                'label' => 'Souhaitez-vous que nous gérions la rédaction des mentions légales et CGU/CGV ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Documents obligatoires pour tout site professionnel',
                'display_order' => 33,
                'type_options' => [
                    ['label' => 'Oui', 'value' => 'oui'],
                    ['label' => 'Non, je les fournirai', 'value' => 'non'],
                    ['label' => 'À déterminer', 'value' => 'a_determiner'],
                ],
            ],
            [
                'label' => 'Souhaitez-vous un accompagnement sur la conformité RGPD ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Mise en conformité avec le règlement européen',
                'display_order' => 34,
                'type_options' => [
                    ['label' => 'Oui', 'value' => 'oui'],
                    ['label' => 'Non', 'value' => 'non'],
                    ['label' => 'À déterminer', 'value' => 'a_determiner'],
                ],
            ],
            [
                'label' => 'Souhaitez-vous que le site soit conforme aux normes d\'accessibilité (WCAG) ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Accessibilité pour les personnes en situation de handicap',
                'display_order' => 35,
                'type_options' => [
                    ['label' => 'Oui, c\'est important', 'value' => 'oui'],
                    ['label' => 'Non', 'value' => 'non'],
                    ['label' => 'À déterminer', 'value' => 'a_determiner'],
                ],
            ],
            
            // ============================================
            // SECTION 11 : Collaboration & Suivi (3 questions)
            // ============================================
            [
                'label' => 'Avez-vous une équipe projet ou un interlocuteur dédié ?',
                'type' => 'text',
                'placeholder' => 'Ex: Moi-même, équipe marketing, prestataire externe...',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Pour savoir avec qui nous collaborerons',
                'display_order' => 36,
            ],
            [
                'label' => 'À quelle fréquence souhaitez-vous des points d\'avancement ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Rythme de communication pendant le projet',
                'display_order' => 37,
                'type_options' => [
                    ['label' => 'Hebdomadaire', 'value' => 'hebdomadaire'],
                    ['label' => 'Bimensuel (tous les 15 jours)', 'value' => 'bimensuel'],
                    ['label' => 'Mensuel', 'value' => 'mensuel'],
                    ['label' => 'À la demande', 'value' => 'a_la_demande'],
                ],
            ],
            [
                'label' => 'Souhaitez-vous une formation pour gérer le site (CMS, contenu, etc.) ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Pour être autonome après la livraison',
                'display_order' => 38,
                'type_options' => [
                    ['label' => 'Oui, complète', 'value' => 'oui_complete'],
                    ['label' => 'Oui, basique', 'value' => 'oui_basique'],
                    ['label' => 'Non', 'value' => 'non'],
                ],
            ],
            
            // ============================================
            // SECTION 12 : Maintenance & Évolution (2 questions)
            // ============================================
            [
                'label' => 'Souhaitez-vous un service de maintenance après la mise en ligne ?',
                'type' => 'radio',
                'placeholder' => '',
                'required' => true,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Mises à jour, sauvegardes, correctifs, monitoring...',
                'display_order' => 39,
                'type_options' => [
                    ['label' => 'Oui, maintenance complète', 'value' => 'oui_complete'],
                    ['label' => 'Oui, maintenance basique', 'value' => 'oui_basique'],
                    ['label' => 'Non', 'value' => 'non'],
                    ['label' => 'À déterminer', 'value' => 'a_determiner'],
                ],
            ],
            [
                'label' => 'Avez-vous déjà en tête des évolutions futures du projet ?',
                'type' => 'textarea',
                'placeholder' => 'Ex : Ajout d\'un blog dans 6 mois, application mobile, extranet partenaires...',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Nous aide à concevoir une architecture évolutive',
                'display_order' => 40,
            ],
            
            // ============================================
            // SECTION 13 : Contraintes & Remarques (2 questions)
            // ============================================
            [
                'label' => 'Y a-t-il des contraintes techniques, juridiques ou autres à prendre en compte ?',
                'type' => 'textarea',
                'placeholder' => 'Ex: Intégration avec CRM existant, hébergement imposé, certification ISO...',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Toute contrainte spécifique qui pourrait impacter le projet',
                'display_order' => 41,
            ],
            [
                'label' => 'Souhaitez-vous ajouter autre chose ?',
                'type' => 'textarea',
                'placeholder' => 'Remarques, demandes spécifiques, informations complémentaires...',
                'required' => false,
                'pattern' => '',
                'error_message' => '',
                'tooltip' => 'Espace libre pour tout élément supplémentaire',
                'display_order' => 42,
            ],
        ];

        foreach ($specifications as $data) {
            $specification = new Specification();
            $specification->setLabel($data['label']);
            $specification->setType($data['type']);
            $specification->setPlaceholder($data['placeholder']);
            $specification->setRequired($data['required']);
            $specification->setPattern($data['pattern']);
            $specification->setMin($data['min'] ?? null);
            $specification->setMax($data['max'] ?? null);
            $specification->setErrorMessage($data['error_message']);
            $specification->setTooltip($data['tooltip'] ?? null);
            $specification->setDisplayOrder($data['display_order']);
            $specification->setTypeOptions($data['type_options'] ?? null);

            $manager->persist($specification);
        }

        $manager->flush();
    }
}
