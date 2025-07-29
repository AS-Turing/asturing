<?php

namespace App\DataFixtures;

use App\Entity\Faq;
use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FaqFixtures extends Fixture implements DependentFixtureInterface
{
    // Define constants for FAQ data based on frontend/data/services
    const FAQS = [
        'conseil' => [
            [
                'question' => 'Proposez-vous des sites internet adaptés aux mobiles ?',
                'answer' => 'Oui, tous les sites que je développe sont conçus pour être 100 % responsives, afin d\'offrir une expérience optimale sur mobile, tablette et ordinateur.'
            ],
            [
                'question' => 'Est-ce que vous travaillez uniquement avec des entreprises locales ?',
                'answer' => 'Je suis basé à Libourne, mais j\'accompagne des clients partout en France. Un échange à distance ou en présentiel est toujours possible selon vos besoins.'
            ],
            [
                'question' => 'Le référencement est-il inclus dans la prestation ?',
                'answer' => 'Oui, un socle d\'optimisation SEO est intégré à chaque projet : structure propre, balises bien configurées, performance, etc. Pour aller plus loin, un accompagnement dédié est possible.'
            ],
            [
                'question' => 'Puis-je gérer le contenu de mon site moi-même ?',
                'answer' => 'Bien sûr ! Je propose une formation après la livraison pour vous apprendre à modifier votre site en toute autonomie.'
            ],
            [
                'question' => 'Quels types de sites réalisez-vous ?',
                'answer' => 'Site vitrine, blog, landing page, site institutionnel ou sur mesure : je m\'adapte à vos objectifs pour proposer un site adapté à vos attentes.'
            ],
            [
                'question' => 'À qui s\'adresse ce service ?',
                'answer' => 'Ce service est conçu pour les porteurs de projets, freelances, TPE ou associations qui ont besoin d\'y voir plus clair dans leurs choix digitaux.'
            ],
            [
                'question' => 'Faut-il avoir un projet déjà lancé ?',
                'answer' => 'Pas du tout ! Je peux vous accompagner dès la phase d\'idée pour vous aider à structurer et poser les bonnes bases.'
            ],
            [
                'question' => 'Est-ce que l\'accompagnement peut inclure du développement ?',
                'answer' => 'Ce service est orienté conseil, mais peut être complété par une prestation de développement si besoin, sur devis personnalisé.'
            ]
        ],
        'creation' => [
            [
                'question' => 'Combien de temps faut-il pour créer un site internet ?',
                'answer' => 'Le délai varie selon la complexité du projet : de 2-3 semaines pour une landing page à 2-3 mois pour un site complet avec fonctionnalités avancées.'
            ],
            [
                'question' => 'Quelles technologies utilisez-vous ?',
                'answer' => 'Je travaille principalement avec des technologies modernes comme Vue.js, React, Node.js, PHP/Symfony, et WordPress selon les besoins du projet.'
            ],
            [
                'question' => 'Faut-il fournir les textes et images ?',
                'answer' => 'Idéalement oui, car vous connaissez mieux votre activité. Je peux cependant vous conseiller sur la structure et vous orienter vers des ressources adaptées si besoin.'
            ],
            [
                'question' => 'Le site sera-t-il référencé sur Google ?',
                'answer' => 'Tous mes sites sont développés avec les bonnes pratiques SEO. Le référencement naturel s\'améliore avec le temps, mais je mets en place tous les éléments techniques nécessaires.'
            ],
            [
                'question' => 'Proposez-vous l\'hébergement du site ?',
                'answer' => 'Je peux vous conseiller et mettre en place l\'hébergement adapté à votre projet, ou travailler avec votre hébergeur actuel si vous en avez déjà un.'
            ]
        ],
        'developpement' => [
            [
                'question' => 'Quels types d\'applications développez-vous ?',
                'answer' => 'Je développe principalement des applications web, des interfaces d\'administration, des outils métier, des API et des intégrations entre différents systèmes.'
            ],
            [
                'question' => 'Comment se déroule un projet de développement ?',
                'answer' => 'Le processus comprend : analyse des besoins, proposition technique, développement par itérations avec validations régulières, tests, déploiement et formation.'
            ],
            [
                'question' => 'Puis-je faire évoluer l\'application plus tard ?',
                'answer' => 'Absolument ! Je conçois les applications de façon modulaire et évolutive. Vous pouvez ajouter des fonctionnalités au fil du temps selon vos besoins.'
            ],
            [
                'question' => 'Quelle est la différence avec un site internet classique ?',
                'answer' => 'Une application web offre des fonctionnalités interactives plus avancées qu\'un site vitrine : espaces membres, tableaux de bord, traitement de données, automatisations...'
            ],
            [
                'question' => 'Proposez-vous un support après la livraison ?',
                'answer' => 'Oui, je propose différentes formules de maintenance et support technique pour assurer le bon fonctionnement de votre application dans la durée.'
            ]
        ],
        'formation' => [
            [
                'question' => 'À qui s\'adressent vos formations ?',
                'answer' => 'Mes formations s\'adressent aux débutants comme aux utilisateurs intermédiaires : entrepreneurs, équipes marketing, chargés de communication, ou toute personne souhaitant gagner en autonomie numérique.'
            ],
            [
                'question' => 'Quels sujets peuvent être abordés ?',
                'answer' => 'Je propose des formations sur la gestion de site web, l\'utilisation d\'outils numériques, les bonnes pratiques web, le référencement, et l\'utilisation d\'applications spécifiques.'
            ],
            [
                'question' => 'Les formations sont-elles personnalisées ?',
                'answer' => 'Oui, chaque formation est adaptée à vos besoins, votre niveau et vos objectifs. Je prépare un programme sur mesure après un échange préalable.'
            ],
            [
                'question' => 'Où se déroulent les formations ?',
                'answer' => 'Les formations peuvent se dérouler dans vos locaux, à distance par visioconférence, ou dans un espace de coworking à Libourne selon votre préférence.'
            ]
        ],
        'integration' => [
            [
                'question' => 'Quels types d\'outils pouvez-vous intégrer ?',
                'answer' => 'Je peux intégrer des CRM, outils marketing, systèmes de paiement, plateformes e-commerce, outils d\'analyse, et la plupart des services disposant d\'une API.'
            ],
            [
                'question' => 'Est-ce que cela nécessite de refaire mon site ?',
                'answer' => 'Pas nécessairement. Dans la plupart des cas, je peux intégrer de nouvelles fonctionnalités à votre site existant sans refonte complète.'
            ],
            [
                'question' => 'Comment savoir si mon projet est réalisable ?',
                'answer' => 'Je propose une étude préalable pour évaluer la faisabilité technique, les contraintes éventuelles et vous proposer la solution la plus adaptée.'
            ],
            [
                'question' => 'Que faire si les outils que j\'utilise n\'ont pas d\'API ?',
                'answer' => 'Selon les cas, nous pouvons explorer des solutions alternatives comme l\'automatisation via Zapier/Make, ou envisager une solution sur mesure si le besoin le justifie.'
            ]
        ],
        'maintenance' => [
            [
                'question' => 'Que comprend exactement la maintenance ?',
                'answer' => 'La maintenance inclut les mises à jour de sécurité, sauvegardes régulières, surveillance des performances, corrections de bugs et support technique selon la formule choisie.'
            ],
            [
                'question' => 'Puis-je faire appel à vous ponctuellement ?',
                'answer' => 'Oui, je propose des interventions ponctuelles pour des besoins spécifiques, même sans contrat de maintenance régulier.'
            ],
            [
                'question' => 'Quel est le délai d\'intervention en cas de problème ?',
                'answer' => 'Pour les clients sous contrat de maintenance, j\'interviens sous 24 à 48h selon la gravité du problème. Les interventions critiques sont traitées en priorité.'
            ],
            [
                'question' => 'Est-ce que la maintenance inclut des évolutions fonctionnelles ?',
                'answer' => 'La formule Premium inclut un crédit d\'heures mensuel pour des petites évolutions. Les développements plus importants font l\'objet de devis spécifiques.'
            ],
            [
                'question' => 'Comment se passe la transition si mon site est géré par quelqu\'un d\'autre ?',
                'answer' => 'J\'organise une transition en douceur : audit technique, récupération des accès, documentation de l\'existant et mise en place progressive des bonnes pratiques.'
            ]
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::FAQS as $serviceKey => $faqs) {
            /** @var Service $service */
            $service = $this->getReference('service-' . $serviceKey, Service::class);

            foreach ($faqs as $faqData) {
                $faq = new Faq();
                $faq->setQuestion($faqData['question']);
                $faq->setAnswer($faqData['answer']);
                $faq->setService($service);

                $manager->persist($faq);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ServiceFixtures::class,
        ];
    }
}
