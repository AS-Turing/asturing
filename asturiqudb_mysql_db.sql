-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: asturingdb.mysql.db
-- Generation Time: Nov 18, 2025 at 02:11 PM
-- Server version: 8.0.43-34
-- PHP Version: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asturingdb`
--
CREATE DATABASE IF NOT EXISTS `asturingdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `asturingdb`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Informations personnelles'),
(2, 'Entreprise'),
(3, 'Objectifs du projet'),
(4, 'Cibles & utilisateurs'),
(5, 'Contenu'),
(6, 'Design & expérience utilisateur'),
(7, 'Fonctionnalités attendues'),
(8, 'Marketing & référencement'),
(9, 'Technique & infrastructure'),
(10, 'Sécurité & conformité'),
(11, 'Collaboration & suivi'),
(12, 'Maintenance & évolution'),
(13, 'Contraintes & remarques'),
(14, 'Budget'),
(15, 'Planification');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tva_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `siret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_naf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `web_site` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `email`, `firstname`, `lastname`, `phone`, `company`, `tva_number`, `siret`, `code_naf`, `address`, `zip_code`, `country`, `web_site`) VALUES
(1, 'j.doe@mail.fr', 'John', 'Doe', '0123456789', 'Test Company', '123456789', '123456789', '123456789', 'Test adresse', '123456789', 'Test country', 'http://www.test.fr'),
(2, '', 'Jane', 'Doe', '0123456789', 'Test Company', '123456789', '123456789', '123456789', 'Test adresse', '123456789', 'Test country', 'http://www.test.fr');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int NOT NULL,
  `service_id` int NOT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `service_id`, `question`, `answer`) VALUES
(1, 1, 'Proposez-vous des sites internet adaptés aux mobiles ?', 'Oui, tous les sites que je développe sont conçus pour être 100 % responsives, afin d\'offrir une expérience optimale sur mobile, tablette et ordinateur.'),
(2, 1, 'Est-ce que vous travaillez uniquement avec des entreprises locales ?', 'Je suis basé à Libourne, mais j\'accompagne des clients partout en France. Un échange à distance ou en présentiel est toujours possible selon vos besoins.'),
(3, 1, 'Le référencement est-il inclus dans la prestation ?', 'Oui, un socle d\'optimisation SEO est intégré à chaque projet : structure propre, balises bien configurées, performance, etc. Pour aller plus loin, un accompagnement dédié est possible.'),
(4, 1, 'Puis-je gérer le contenu de mon site moi-même ?', 'Bien sûr ! Je propose une formation après la livraison pour vous apprendre à modifier votre site en toute autonomie.'),
(5, 1, 'Quels types de sites réalisez-vous ?', 'Site vitrine, blog, landing page, site institutionnel ou sur mesure : je m\'adapte à vos objectifs pour proposer un site adapté à vos attentes.'),
(6, 1, 'À qui s\'adresse ce service ?', 'Ce service est conçu pour les porteurs de projets, freelances, TPE ou associations qui ont besoin d\'y voir plus clair dans leurs choix digitaux.'),
(7, 1, 'Faut-il avoir un projet déjà lancé ?', 'Pas du tout ! Je peux vous accompagner dès la phase d\'idée pour vous aider à structurer et poser les bonnes bases.'),
(8, 1, 'Est-ce que l\'accompagnement peut inclure du développement ?', 'Ce service est orienté conseil, mais peut être complété par une prestation de développement si besoin, sur devis personnalisé.'),
(9, 2, 'Combien de temps faut-il pour créer un site internet ?', 'Le délai varie selon la complexité du projet : de 2-3 semaines pour une landing page à 2-3 mois pour un site complet avec fonctionnalités avancées.'),
(10, 2, 'Quelles technologies utilisez-vous ?', 'Je travaille principalement avec des technologies modernes comme Vue.js, React, Node.js, PHP/Symfony, et WordPress selon les besoins du projet.'),
(11, 2, 'Faut-il fournir les textes et images ?', 'Idéalement oui, car vous connaissez mieux votre activité. Je peux cependant vous conseiller sur la structure et vous orienter vers des ressources adaptées si besoin.'),
(12, 2, 'Le site sera-t-il référencé sur Google ?', 'Tous mes sites sont développés avec les bonnes pratiques SEO. Le référencement naturel s\'améliore avec le temps, mais je mets en place tous les éléments techniques nécessaires.'),
(13, 2, 'Proposez-vous l\'hébergement du site ?', 'Je peux vous conseiller et mettre en place l\'hébergement adapté à votre projet, ou travailler avec votre hébergeur actuel si vous en avez déjà un.'),
(14, 3, 'Quels types d\'applications développez-vous ?', 'Je développe principalement des applications web, des interfaces d\'administration, des outils métier, des API et des intégrations entre différents systèmes.'),
(15, 3, 'Comment se déroule un projet de développement ?', 'Le processus comprend : analyse des besoins, proposition technique, développement par itérations avec validations régulières, tests, déploiement et formation.'),
(16, 3, 'Puis-je faire évoluer l\'application plus tard ?', 'Absolument ! Je conçois les applications de façon modulaire et évolutive. Vous pouvez ajouter des fonctionnalités au fil du temps selon vos besoins.'),
(17, 3, 'Quelle est la différence avec un site internet classique ?', 'Une application web offre des fonctionnalités interactives plus avancées qu\'un site vitrine : espaces membres, tableaux de bord, traitement de données, automatisations...'),
(18, 3, 'Proposez-vous un support après la livraison ?', 'Oui, je propose différentes formules de maintenance et support technique pour assurer le bon fonctionnement de votre application dans la durée.'),
(19, 4, 'À qui s\'adressent vos formations ?', 'Mes formations s\'adressent aux débutants comme aux utilisateurs intermédiaires : entrepreneurs, équipes marketing, chargés de communication, ou toute personne souhaitant gagner en autonomie numérique.'),
(20, 4, 'Quels sujets peuvent être abordés ?', 'Je propose des formations sur la gestion de site web, l\'utilisation d\'outils numériques, les bonnes pratiques web, le référencement, et l\'utilisation d\'applications spécifiques.'),
(21, 4, 'Les formations sont-elles personnalisées ?', 'Oui, chaque formation est adaptée à vos besoins, votre niveau et vos objectifs. Je prépare un programme sur mesure après un échange préalable.'),
(22, 4, 'Où se déroulent les formations ?', 'Les formations peuvent se dérouler dans vos locaux, à distance par visioconférence, ou dans un espace de coworking à Libourne selon votre préférence.'),
(23, 5, 'Quels types d\'outils pouvez-vous intégrer ?', 'Je peux intégrer des CRM, outils marketing, systèmes de paiement, plateformes e-commerce, outils d\'analyse, et la plupart des services disposant d\'une API.'),
(24, 5, 'Est-ce que cela nécessite de refaire mon site ?', 'Pas nécessairement. Dans la plupart des cas, je peux intégrer de nouvelles fonctionnalités à votre site existant sans refonte complète.'),
(25, 5, 'Comment savoir si mon projet est réalisable ?', 'Je propose une étude préalable pour évaluer la faisabilité technique, les contraintes éventuelles et vous proposer la solution la plus adaptée.'),
(26, 5, 'Que faire si les outils que j\'utilise n\'ont pas d\'API ?', 'Selon les cas, nous pouvons explorer des solutions alternatives comme l\'automatisation via Zapier/Make, ou envisager une solution sur mesure si le besoin le justifie.'),
(27, 6, 'Que comprend exactement la maintenance ?', 'La maintenance inclut les mises à jour de sécurité, sauvegardes régulières, surveillance des performances, corrections de bugs et support technique selon la formule choisie.'),
(28, 6, 'Puis-je faire appel à vous ponctuellement ?', 'Oui, je propose des interventions ponctuelles pour des besoins spécifiques, même sans contrat de maintenance régulier.'),
(29, 6, 'Quel est le délai d\'intervention en cas de problème ?', 'Pour les clients sous contrat de maintenance, j\'interviens sous 24 à 48h selon la gravité du problème. Les interventions critiques sont traitées en priorité.'),
(30, 6, 'Est-ce que la maintenance inclut des évolutions fonctionnelles ?', 'La formule Premium inclut un crédit d\'heures mensuel pour des petites évolutions. Les développements plus importants font l\'objet de devis spécifiques.'),
(31, 6, 'Comment se passe la transition si mon site est géré par quelqu\'un d\'autre ?', 'J\'organise une transition en douceur : audit technique, récupération des accès, documentation de l\'existant et mise en place progressive des bonnes pratiques.');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int NOT NULL,
  `specification_book_id` int DEFAULT NULL,
  `quote_id` int DEFAULT NULL,
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `path` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `specification_book_id`, `quote_id`, `filename`, `uploaded_at`, `path`) VALUES
(1, 1, NULL, 'cahier-des-charges-08-07-2025.pdf', '2020-07-20 00:00:00', 'upload/cdc/cahier-des-charges-08-07-2025.pdf'),
(2, 2, NULL, 'cahier-des-charges-08-2025.pdf', '2020-08-20 00:00:00', 'upload/cdc/cahier-des-charges-08-2025.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_url` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `map` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `city`, `slug`, `title`, `description`, `og_title`, `og_description`, `og_url`, `map`) VALUES
(1, 'Libourne', 'libourne', 'Création site Web à Libourne | AS-Turing', 'Développeur web freelance à Libourne, je conçois des sites sur mesure pour les commerçants, artisans et entreprises locales. Misez sur un site performant et bien référencé.', 'Création de site internet à Libourne - AS-Turing', 'Création de site vitrine ou e-commerce à Libourne. Accompagnement technique, design moderne, visibilité locale assurée.', 'https://www.as-turing.fr/localisation/developpeur-web-libourne', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d45208.543372073655!2d-0.27397474494844604!3d44.912475843844156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd55494f167006fb%3A0x40665174816e1f0!2s33500%20Libourne!5e0!3m2!1sfr!2sfr!4v1745504738400!5m2!1sfr!2sfr'),
(2, 'Bordeaux', 'bordeaux', 'Création site Web à Bordeaux | Site internet moderne & SEO | AS-Turing', 'Vous êtes une startup, PME ou indépendant à Bordeaux ? Je développe des sites web rapides, scalables et orientés conversion.', 'Développement web à Bordeaux - Freelance NuxtJS | AS-Turing', 'Sites internet professionnels à Bordeaux : performance, UX, référencement local et conseils sur mesure.', 'https://www.as-turing.fr/localisation/developpeur-web-bordeaux', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d45246.887366404226!2d-0.6272113453529491!3d44.86371044389325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5527e8f751ca81%3A0x796386037b397a89!2sBordeaux!5e0!3m2!1sfr!2sfr!4v1745504786304!5m2!1sfr!2sfr'),
(3, 'Saint-Émilion', 'saint-emilion', 'Création site Web à Saint-Émilion | Site vitrine & sur-mesure | AS-Turing', 'Artisans, vignerons, restaurateurs : donnez une vitrine digitale à votre activité à Saint-Émilion avec un site rapide, élégant et facile à mettre à jour.', 'Création de site web à Saint-Émilion - AS-Turing', 'Développement de sites sur mesure pour les acteurs touristiques et viticoles à Saint-Émilion. Optimisé pour le référencement local.', 'https://www.as-turing.fr/localisation/developpeur-web-saint-emilion', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d40171.112464582155!2d-0.17954929574682138!3d44.88378148797172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd554e2eb27a19c9%3A0x54e9faa56dddb980!2sSaint-%C3%89milion!5e0!3m2!1sfr!2sfr!4v1745504827513!5m2!1sfr!2sfr'),
(4, 'Créon', 'creon', 'Création site Web à Créon | Site internet performant | AS-Turing', 'Création de site web à Créon pour artisans, commerçants et indépendants. Sites modernes, rapides et bien référencés.', 'Création site internet à Créon - AS-Turing', 'Développeur freelance à Créon : site vitrine, site sur-mesure, SEO local et accompagnement personnalisé.', 'https://www.as-turing.fr/localisation/developpeur-web-creon', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11330.36214317317!2d-0.35468986180232814!3d44.76876483713605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd55392cf7bf4f97%3A0xbc44e4cc47e9346!2s33670%20Cr%C3%A9on!5e0!3m2!1sfr!2sfr!4v1745505047674!5m2!1sfr!2sfr'),
(5, 'Sauveterre-de-Guyenne', 'sauveterre-de-guyenne', 'Création site Web à Sauveterre-de-Guyenne | Création de site internet | AS-Turing', 'Développement de site internet à Sauveterre-de-Guyenne : vitrine, e-commerce ou sur-mesure. Qualité, rapidité et référencement local.', 'Site internet à Sauveterre-de-Guyenne - AS-Turing', 'Besoin d\'un site web à Sauveterre-de-Guyenne ? Je conçois des solutions efficaces et adaptées à vos besoins.', 'https://www.as-turing.fr/localisation/developpeur-web-sauveterre-de-guyenne', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d45374.60257034619!2d-0.1506723213100677!3d44.7009820475564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd555e002f9a1aa7%3A0x40665174816d220!2s33540%20Sauveterre-de-Guyenne!5e0!3m2!1sfr!2sfr!4v1745505074032!5m2!1sfr!2sfr');

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int NOT NULL,
  `service_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `includes` json DEFAULT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `service_id`, `name`, `includes`, `price`) VALUES
(1, 1, 'Consultation Express', '[\"Échange d\'une heure (visio ou téléphone)\", \"Compte rendu synthétique avec recommandations\", \"Support par mail pendant 7 jours\"]', '99 € (TVA non applicable – art. 293 B)'),
(2, 1, 'Accompagnement Projet', '[\"Audit approfondi\", \"Sessions régulières de suivi\", \"Conseils techniques personnalisés\", \"Rédaction de livrables (cahier des charges, roadmap...)\"]', 'à partir de 350 € (TVA non applicable – art. 293 B)'),
(3, 1, 'Coaching Digital', '[\"10h d\'accompagnement à utiliser librement\", \"Support continu pendant 30 jours\", \"Sessions planifiées selon votre planning\", \"Suivi d\'avancement et conseils actionnables\"]', '990 € (TVA non applicable – art. 293 B)'),
(4, 2, 'Site Vitrine Essentiel', '[\"Site responsive jusqu\'à 5 pages\", \"Design moderne et personnalisé\", \"Formulaire de contact\", \"Optimisation SEO de base\", \"Formation à l\'utilisation\"]', 'à partir de 1 200 € (TVA non applicable – art. 293 B)'),
(5, 2, 'Site Pro', '[\"Site responsive jusqu\'à 10 pages\", \"Design sur mesure\", \"Formulaires avancés\", \"Optimisation SEO complète\", \"Intégration de médias riches\", \"Formation et support 30 jours\"]', 'à partir de 2 800 € (TVA non applicable – art. 293 B)'),
(6, 2, 'Landing Page', '[\"Page unique optimisée conversion\", \"Design persuasif\", \"Formulaire de capture\", \"Optimisation performance\", \"Compatibilité tous appareils\"]', 'à partir de 790 € (TVA non applicable – art. 293 B)'),
(7, 3, 'Développement Fonctionnalité', '[\"Analyse des besoins\", \"Développement sur mesure\", \"Tests et déploiement\", \"Documentation technique\", \"Garantie 3 mois\"]', 'sur devis'),
(8, 3, 'Application Web Complète', '[\"Cahier des charges détaillé\", \"Développement full-stack\", \"Interface administration\", \"Tests et optimisation\", \"Formation utilisateurs\", \"Support technique 6 mois\"]', 'sur devis'),
(9, 4, 'Formation Individuelle', '[\"Session personnalisée 3h\", \"Support de formation\", \"Exercices pratiques\", \"Suivi post-formation\"]', '290 € (TVA non applicable – art. 293 B)'),
(10, 4, 'Pack Formation Équipe', '[\"Formation sur site 1 journée\", \"Jusqu\'à 5 participants\", \"Supports personnalisés\", \"Ateliers pratiques\", \"Assistance 30 jours\"]', 'à partir de 990 € (TVA non applicable – art. 293 B)'),
(11, 5, 'Intégration Simple', '[\"Configuration d\'un outil externe\", \"Connexion à votre site/application\", \"Tests de fonctionnement\", \"Documentation utilisateur\"]', 'à partir de 490 € (TVA non applicable – art. 293 B)'),
(12, 5, 'Intégration Complexe', '[\"Analyse workflow existant\", \"Intégration multi-plateformes\", \"Synchronisation de données\", \"Automatisation de processus\", \"Formation et documentation\"]', 'sur devis'),
(13, 6, 'Maintenance Essentielle', '[\"Mises à jour de sécurité\", \"Sauvegardes régulières\", \"Surveillance uptime\", \"Support email\"]', 'à partir de 59 €/mois (TVA non applicable – art. 293 B)'),
(14, 6, 'Maintenance Premium', '[\"Toutes les prestations Essentielles\", \"Mises à jour fonctionnelles\", \"Optimisation performances\", \"Temps de développement mensuel (2h)\", \"Support prioritaire\"]', 'à partir de 149 €/mois (TVA non applicable – art. 293 B)'),
(15, 6, 'Intervention Ponctuelle', '[\"Diagnostic de problème\", \"Correction de bugs\", \"Petites modifications\", \"Rapport d\'intervention\"]', '90 € / heure (TVA non applicable – art. 293 B)'),
(16, 3, 'Journée de régie', '[\"Développement planifié (7h)\", \"Suivi GitHub/Notion\", \"Compte-rendu de fin de journée\"]', '520 € / jour (TVA non applicable – art. 293 B)');

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

CREATE TABLE `quote` (
  `id` int NOT NULL,
  `client_id` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE `seo` (
  `id` int NOT NULL,
  `service_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo`
--

INSERT INTO `seo` (`id`, `service_id`, `title`, `description`, `og_title`, `og_description`, `og_url`) VALUES
(1, 1, 'Conseil & accompagnement digital | AS-Turing', 'Audit, stratégie, choix techniques et suivi de projet — bénéficiez de conseils personnalisés pour faire les bons choix digitaux avec AS-Turing.', 'Conseil digital sur mesure | AS-Turing', 'Freelance web à Libourne, j\'accompagne les professionnels dans leurs décisions techniques, stratégiques et organisationnelles.', 'https://www.as-turing.fr/services/conseil-accompagnement-digital'),
(2, 2, 'Création de site internet | AS-Turing', 'Création de sites web professionnels, responsive et optimisés pour le référencement. Sites vitrines, landing pages et sites sur mesure à Libourne et partout en France.', 'Création de sites web professionnels | AS-Turing', 'Développeur freelance à Libourne, je crée des sites internet modernes, performants et adaptés à vos objectifs commerciaux.', 'https://www.as-turing.fr/services/creation-site-internet'),
(3, 3, 'Développement sur mesure | AS-Turing', 'Applications web, outils métier et solutions personnalisées pour optimiser vos processus. Développement sur mesure adapté à vos besoins spécifiques.', 'Développement d\'applications web sur mesure | AS-Turing', 'Développeur full-stack à Libourne, je conçois des solutions web personnalisées pour répondre précisément à vos besoins métier.', 'https://www.as-turing.fr/services/developpement-sur-mesure'),
(4, 4, 'Formation & vulgarisation | AS-Turing', 'Formations personnalisées pour maîtriser vos outils numériques. Gagnez en autonomie avec des sessions adaptées à votre niveau et vos objectifs.', 'Formations web et numérique | AS-Turing', 'Formateur à Libourne, je propose des sessions personnalisées pour vous aider à comprendre et maîtriser vos outils digitaux.', 'https://www.as-turing.fr/services/formation-vulgarisation'),
(5, 5, 'Intégration de solutions externes | AS-Turing', 'Connectez vos outils et plateformes pour un écosystème digital cohérent. Intégration de CRM, e-commerce, paiement et autres solutions externes.', 'Intégration d\'outils et API | AS-Turing', 'Développeur à Libourne, j\'intègre et synchronise vos différents outils pour créer un système d\'information efficace et cohérent.', 'https://www.as-turing.fr/services/integration-solutions-externes'),
(6, 6, 'Maintenance & support | AS-Turing', 'Assurez la pérennité et la sécurité de vos outils digitaux. Maintenance préventive, support technique et évolutions de vos sites et applications.', 'Maintenance web et support technique | AS-Turing', 'Développeur à Libourne, je propose des services de maintenance et support pour garantir la sécurité et le bon fonctionnement de vos outils web.', 'https://www.as-turing.fr/services/maintenance-support');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `micro_services` json DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `slug`, `title`, `description`, `micro_services`, `img`, `icon`) VALUES
(1, 'conseil-accompagnement-digital', 'Conseil & accompagnement digital', 'Profitez d\'un accompagnement sur mesure pour faire les bons choix techniques et stratégiques dans votre projet web ou digital.', '[\"Audit de votre site ou projet existant\", \"Recommandations techniques et stratégiques\", \"Conseils sur l\'accessibilité, la performance et l\'ergonomie\", \"Choix d\'outils et de technologies adaptés à vos besoins\", \"Accompagnement dans la rédaction de cahiers des charges\", \"Suivi de projet ou accompagnement ponctuel sur demande\"]', '/images/cons-accomp.png', 'lucide:messages-square'),
(2, 'creation-site-internet', 'Création de site internet', 'Un site internet professionnel, performant et adapté à vos besoins, pour valoriser votre activité et atteindre vos objectifs.', '[\"Sites vitrines pour présenter votre activité\", \"Sites institutionnels pour votre entreprise\", \"Landing pages pour vos campagnes marketing\", \"Blogs et sites de contenu\", \"Sites sur-mesure selon vos besoins spécifiques\", \"Intégration de solutions de paiement, formulaires, etc.\"]', '/images/crea-web.png', 'lucide:layout-template'),
(3, 'developpement-sur-mesure', 'Développement sur mesure', 'Des solutions web personnalisées pour répondre précisément à vos besoins spécifiques et optimiser vos processus métier.', '[\"Applications web sur mesure\", \"Interfaces d\'administration personnalisées\", \"Intégration de systèmes tiers (API, services externes)\", \"Automatisation de tâches et de processus\", \"Développement de fonctionnalités spécifiques\", \"Solutions de gestion de contenu adaptées à vos besoins\"]', '/images/dev-surmesur.png', 'lucide:code-2'),
(4, 'formation-vulgarisation', 'Formation & vulgarisation', 'Apprenez à maîtriser vos outils numériques et comprenez les enjeux techniques pour gagner en autonomie et faire les bons choix.', '[\"Formation à l\'utilisation de votre site ou application\", \"Ateliers d\'initiation aux technologies web\", \"Accompagnement à la prise en main d\'outils numériques\", \"Vulgarisation de concepts techniques complexes\", \"Documentation personnalisée et supports de formation\", \"Conseils pour votre montée en compétences digitales\"]', '/images/form-vulga.png', 'lucide:book-open-check'),
(5, 'integration-solutions-externes', 'Intégration de solutions externes', 'Connectez et synchronisez vos différents outils et plateformes pour un écosystème digital cohérent et efficace.', '[\"Intégration de CRM, ERP et autres logiciels métier\", \"Mise en place de solutions e-commerce\", \"Configuration d\'outils marketing et d\'analyse\", \"Synchronisation de données entre différentes plateformes\", \"Intégration de systèmes de paiement et de réservation\", \"Mise en place de workflows automatisés entre vos outils\"]', '/images/inte-ext.png', 'lucide:plug'),
(6, 'maintenance-support-technique', 'Maintenance & support', 'Un accompagnement continu pour garantir le bon fonctionnement, la sécurité et l\'évolution de vos outils digitaux.', '[\"Mises à jour régulières de sécurité\", \"Surveillance et optimisation des performances\", \"Sauvegardes et plans de reprise d\'activité\", \"Support technique et résolution de problèmes\", \"Évolutions et améliorations continues\", \"Maintenance préventive et corrective\"]', '/images/maint-st.png', 'lucide:settings');

-- --------------------------------------------------------

--
-- Table structure for table `specification`
--

CREATE TABLE `specification` (
  `id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `placeholder` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL,
  `pattern` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `min` int DEFAULT NULL,
  `max` int DEFAULT NULL,
  `error_message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tooltip` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `display_order` int NOT NULL,
  `type_options` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specification`
--

INSERT INTO `specification` (`id`, `category_id`, `label`, `type`, `placeholder`, `required`, `pattern`, `min`, `max`, `error_message`, `tooltip`, `display_order`, `type_options`) VALUES
(1, 1, 'Quel est votre prénom ?', 'text', 'Entrez votre prénom', 1, '^[A-Za-zÀ-ÖØ-öø-ÿ\\s]{1,50}$', NULL, NULL, 'Veuillez entrer un prénom valide', 'Votre prénom sera utilisé pour personnaliser nos échanges.', 1, NULL),
(2, 1, 'Quel est votre nom de famille ?', 'text', 'Entrez votre nom', 1, '^[A-Za-zÀ-ÖØ-öø-ÿ\\s\'-]{1,50}$', NULL, NULL, 'Veuillez entrer un nom valide', 'Utilisé pour l\'identification dans le document final.', 2, NULL),
(3, 1, 'Quelle est votre adresse e-mail ?', 'email', 'exemple@domaine.com', 1, '^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$', NULL, NULL, 'Veuillez entrer une adresse e-mail valide', 'Pour vous recontacter facilement.', 3, NULL),
(4, 1, 'Quel est votre numéro de téléphone ?', 'tel', 'Ex: 0601020304', 1, '^\\+?\\d{7,15}$', NULL, NULL, 'Veuillez entrer un numéro de téléphone valide', 'Pour un contact plus rapide si nécessaire.', 4, NULL),
(5, 2, 'Quel est le nom de votre entreprise ou organisation ?', 'text', 'Nom de l\'entreprise', 1, '', NULL, NULL, '', 'Utilisé pour contextualiser le projet.', 5, NULL),
(6, 2, 'Dans quel secteur d\'activité évoluez-vous ?', 'text', 'Ex : Restauration, Éducation, Industrie...', 1, '', NULL, NULL, '', 'Permet d\'adapter les recommandations à votre secteur.', 6, NULL),
(7, 2, 'Quelle est la taille de votre structure ?', 'select', 'Sélectionnez', 1, '', NULL, NULL, '', 'Nous permet d\'estimer les ressources disponibles et l\'organisation du projet.', 7, '[{\"label\": \"Auto-entrepreneur\", \"value\": \"Auto-entrepreneur\"}, {\"label\": \"TPE (1-10 personnes)\", \"value\": \"TPE\"}, {\"label\": \"PME (10-250 personnes)\", \"value\": \"PME\"}, {\"label\": \"Grande entreprise\", \"value\": \"Grande entreprise\"}, {\"label\": \"Association\", \"value\": \"Association\"}, {\"label\": \"Collectivité\", \"value\": \"Collectivité\"}]'),
(8, 3, 'Quel est l\'objectif principal de votre projet ?', 'textarea', 'Décrivez votre but (vendre en ligne, présenter vos services, générer des leads...)', 1, '', NULL, NULL, '', 'Un bon objectif permet d\'orienter tout le reste du projet.', 8, NULL),
(9, 3, 'Y a-t-il d\'autres objectifs secondaires ?', 'textarea', 'Ex : Améliorer l\'image de marque, fidéliser les clients, etc.', 0, '', NULL, NULL, '', 'Listez les objectifs annexes éventuels.', 9, NULL),
(10, 3, 'Quelle problématique essayez-vous de résoudre avec ce projet ?', 'textarea', 'Décrivez le problème que votre site web doit résoudre', 0, '', NULL, NULL, '', 'Comprendre le problème nous aide à proposer la bonne solution.', 10, NULL),
(11, 4, 'Qui sont vos cibles principales ?', 'textarea', 'Ex : Particuliers, professionnels, étudiants...', 1, '', NULL, NULL, '', 'Cela influencera fortement le design et le contenu.', 11, NULL),
(12, 4, 'Quels sont leurs besoins spécifiques ?', 'textarea', 'Décrivez ce que vos utilisateurs recherchent', 1, '', NULL, NULL, '', 'Comprendre les besoins des utilisateurs est essentiel pour créer une expérience adaptée.', 12, NULL),
(13, 5, 'Disposez-vous déjà de contenu (textes, images, vidéos...) ?', 'radio', '', 1, '', NULL, NULL, '', 'Le contenu est souvent un point critique dans un projet.', 13, '[{\"label\": \"Oui\", \"value\": \"oui\"}, {\"label\": \"Partiellement\", \"value\": \"partiellement\"}, {\"label\": \"Non\", \"value\": \"non\"}]'),
(14, 5, 'Avez-vous déjà une idée du nombre et type de pages souhaitées ?', 'textarea', 'Ex : Accueil, À propos, Contact, Blog, Boutique...', 1, '', NULL, NULL, '', 'Donne une première estimation du périmètre.', 14, NULL),
(15, 5, 'Souhaitez-vous un accompagnement à la rédaction ?', 'select', 'Oui / Non / Je ne sais pas', 1, '', NULL, NULL, '', '', 15, '[{\"label\": \"Oui\", \"value\": \"Oui\"}, {\"label\": \"Non\", \"value\": \"Non\"}, {\"label\": \"À déterminer\", \"value\": \"À déterminer\"}]'),
(16, 5, 'Des contenus sont-ils déjà existants à importer ? (Produits, articles...)', 'textarea', 'Précisez le type, la quantité et le format si possible', 0, '', NULL, NULL, '', 'Cela permet d\'anticiper les efforts de migration ou d\'intégration.', 16, NULL),
(17, 5, 'Y a-t-il un besoin de traduction ou multilingue ?', 'textarea', 'Précisez les langues nécessaires', 0, '', NULL, NULL, '', 'Important pour l\'architecture du site et son référencement.', 17, NULL),
(18, 6, 'Avez-vous une charte graphique existante ?', 'radio', '', 1, '', NULL, NULL, '', 'Permet de savoir s\'il faut intégrer un travail graphique au projet.', 18, '[{\"label\": \"Oui\", \"value\": \"oui\"}, {\"label\": \"Non\", \"value\": \"non\"}, {\"label\": \"En cours de création\", \"value\": \"En cours de création\"}]'),
(19, 6, 'Souhaitez-vous un design sur mesure ou basé sur un modèle ?', 'radio', '', 1, '', NULL, NULL, '', '', 19, '[{\"label\": \"Sur mesure\", \"value\": \"Sur mesure\"}, {\"label\": \"Modèle\", \"value\": \"Modèle\"}, {\"label\": \"À déterminer\", \"value\": \"À déterminer\"}]'),
(20, 6, 'Quelles émotions/valeurs voulez-vous que le design véhicule ?', 'textarea', '', 0, '', NULL, NULL, '', '', 20, NULL),
(21, 6, 'Avez-vous des exemples de sites que vous aimez (ou détestez) ?', 'textarea', 'Listez les URLs ou noms, avec un commentaire si possible.', 0, '', NULL, NULL, '', 'Cela guide l\'ergonomie et l\'univers graphique.', 21, NULL),
(22, 7, 'Quelles fonctionnalités souhaitez-vous intégrer ?', 'checkbox', '', 0, '', NULL, NULL, '', 'C\'est une base pour déterminer le périmètre technique.', 22, '[{\"label\": \"Blog\", \"value\": \"blog\"}, {\"label\": \"E-commerce\", \"value\": \"ecommerce\"}, {\"label\": \"Formulaire de contact\", \"value\": \"formulaire\"}, {\"label\": \"Système de réservation\", \"value\": \"reservation\"}, {\"label\": \"Espace client / membre\", \"value\": \"compte_client\"}, {\"label\": \"Site multilingue\", \"value\": \"multilingue\"}, {\"label\": \"Autre (à préciser dans le champ suivant)\", \"value\": \"autre\"}]'),
(23, 7, 'Autres fonctionnalités à préciser', 'textarea', 'Décrivez toute autre idée ou besoin technique.', 0, '', NULL, NULL, '', 'À utiliser si les options précédentes ne suffisent pas.', 23, NULL),
(24, 7, 'Listez les fonctionnalités indispensables (MVP).', 'textarea', 'Les fonctionnalités sans lesquelles le site ne peut pas être lancé', 1, '', NULL, NULL, '', 'Ces fonctionnalités seront prioritaires dans le développement.', 24, NULL),
(25, 7, 'Quelles fonctionnalités seraient un plus mais pas vitales ?', 'textarea', 'Fonctionnalités qui pourraient être développées dans un second temps', 0, '', NULL, NULL, '', 'Nous aide à planifier les phases de développement.', 25, NULL),
(26, 7, 'Y a-t-il des fonctionnalités techniques précises à intégrer ?', 'textarea', 'Ex: paiement, carte interactive...', 0, '', NULL, NULL, '', 'Précisez les aspects techniques spécifiques nécessaires.', 26, NULL),
(27, 8, 'Souhaitez-vous optimiser le site pour le référencement naturel (SEO) ?', 'radio', '', 1, '', NULL, NULL, '', 'Important pour la visibilité sur les moteurs de recherche.', 27, '[{\"label\": \"Oui\", \"value\": \"oui\"}, {\"label\": \"Non\", \"value\": \"non\"}, {\"label\": \"À préciser\", \"value\": \"À préciser\"}]'),
(28, 8, 'Souhaitez-vous intégrer des réseaux sociaux ?', 'checkbox', '', 0, '', NULL, NULL, '', 'Pour lier votre site à votre présence sociale.', 28, '[{\"label\": \"Facebook\", \"value\": \"facebook\"}, {\"label\": \"Instagram\", \"value\": \"instagram\"}, {\"label\": \"LinkedIn\", \"value\": \"linkedin\"}, {\"label\": \"X / Twitter\", \"value\": \"x\"}, {\"label\": \"TikTok\", \"value\": \"tiktok\"}]'),
(29, 9, 'Avez-vous une préférence technologique ou CMS ?', 'textarea', 'Ex: WordPress, Shopify, développement sur mesure...', 0, '', NULL, NULL, '', 'Nous aide à orienter les choix techniques.', 29, NULL),
(30, 10, 'Votre site collectera-t-il des données personnelles ?', 'radio', '', 1, '', NULL, NULL, '', 'Pour anticiper les obligations légales (RGPD).', 30, '[{\"label\": \"Oui\", \"value\": \"oui\"}, {\"label\": \"Non\", \"value\": \"non\"}, {\"label\": \"À déterminer\", \"value\": \"À déterminer\"}]'),
(31, 10, 'Souhaitez-vous que nous gérions la rédaction des mentions légales et CGU/CGV ?', 'radio', '', 1, '', NULL, NULL, '', 'Les mentions légales et CGU/CGV sont obligatoires pour tout site professionnel. Nous pouvons vous accompagner pour rédiger ces documents de manière conforme (RGPD, e-commerce, collecte de données…).', 30, '[{\"label\": \"Oui\", \"value\": \"oui\"}, {\"label\": \"Non\", \"value\": \"non\"}, {\"label\": \"À déterminer\", \"value\": \"À déterminer\"}]'),
(32, 10, 'Souhaitez-vous un accompagnement sur la conformité RGPD ?', 'radio', '', 1, '', NULL, NULL, '', 'Nous pouvons vous aider à mettre en place les éléments nécessaires à la conformité.', 31, '[{\"label\": \"Oui\", \"value\": \"oui\"}, {\"label\": \"Non\", \"value\": \"non\"}]'),
(33, 10, 'Souhaitez-vous que le site soit conforme aux normes d\'accessibilité (WCAG) ?', 'radio', '', 1, '', NULL, NULL, '', 'Notamment pour les personnes en situation de handicap.', 32, '[{\"label\": \"Oui\", \"value\": \"oui\"}, {\"label\": \"Non\", \"value\": \"non\"}, {\"label\": \"À déterminer\", \"value\": \"À déterminer\"}]'),
(34, 11, 'Avez-vous une équipe projet ou un interlocuteur dédié ?', 'text', 'Précisez qui sera impliqué côté client', 1, '', NULL, NULL, '', 'Nous aide à comprendre avec qui nous collaborerons.', 33, NULL),
(35, 5, 'Souhaitez-vous être accompagné pour la rédaction de contenu ?', 'radio', '', 0, '', NULL, NULL, '', 'Textes optimisés SEO, storytelling, mise en page, etc.', 35, '[{\"label\": \"Oui\", \"value\": \"oui\"}, {\"label\": \"Non\", \"value\": \"non\"}, {\"label\": \"Partiellement\", \"value\": \"partiellement\"}]'),
(36, 8, 'Quels mots-clés aimeriez-vous cibler pour votre référencement ?', 'textarea', 'Listez quelques expressions importantes pour votre activité.', 0, '', NULL, NULL, '', 'Aide à orienter la stratégie de contenu et de référencement.', 36, NULL),
(37, 9, 'Avez-vous déjà un nom de domaine ?', 'radio', '', 1, '', NULL, NULL, '', 'Élément essentiel pour la mise en ligne du site.', 37, '[{\"label\": \"Oui\", \"value\": \"oui\"}, {\"label\": \"Non\", \"value\": \"non\"}, {\"label\": \"Je souhaite que vous m\'aidiez à en choisir un\", \"value\": \"À acheter\"}]'),
(38, 9, 'Disposez-vous déjà d\'un hébergement web ?', 'radio', '', 1, '', NULL, NULL, '', 'Nécessaire pour la mise en ligne du site.', 38, '[{\"label\": \"Oui\", \"value\": \"oui\"}, {\"label\": \"Non\", \"value\": \"non\"}, {\"label\": \"Oui, mais je souhaite migrer\", \"value\": \"À migrer\"}]'),
(39, 11, 'À quelle fréquence souhaitez-vous des points d\'avancement ?', 'radio', 'Ex: hebdomadaire, bi-mensuel...', 1, '', NULL, NULL, '', 'Permet d\'établir un rythme de communication adapté.', 39, '[{\"label\": \"Hebdomadaire\", \"value\": \"Hebdomadaire\"}, {\"label\": \"Mensuel\", \"value\": \"Mensuel\"}, {\"label\": \"bimensuel\", \"value\": \"Bimensuel\"}, {\"label\": \"À déterminer\", \"value\": \"À déterminer\"}]'),
(40, 11, 'Avez-vous déjà travaillé avec des prestataires externes ? Comment cela s\'est-il passé ?', 'textarea', 'Partagez votre expérience précédente', 0, '', NULL, NULL, '', 'Nous aide à adapter notre approche à vos attentes.', 40, NULL),
(41, 11, 'Souhaitez-vous une formation pour gérer le site (CMS, contenu, etc.) ?', 'radio', '', 1, '', NULL, NULL, '', 'Pour être autonome après la livraison du site.', 41, '[{\"label\": \"Oui\", \"value\": \"oui\"}, {\"label\": \"Non\", \"value\": \"non\"}]'),
(42, 12, 'Souhaitez-vous un Service de maintenance après la mise en ligne ?', 'radio', '', 1, '', NULL, NULL, '', 'Mise à jour du site, correctifs, évolutions futures...', 42, '[{\"label\": \"Oui\", \"value\": \"oui\"}, {\"label\": \"Non\", \"value\": \"non\"}, {\"label\": \"À déterminer\", \"value\": \"À déterminer\"}]'),
(43, 12, 'Avez-vous déjà en tête des évolutions futures du projet ?', 'textarea', 'Ex : ajout d\'un blog, nouvelles fonctionnalités...', 0, '', NULL, NULL, '', 'Nous aide à concevoir une architecture évolutive.', 43, NULL),
(44, 13, 'Y a-t-il des contraintes techniques, juridiques, ou autres à prendre en compte ?', 'textarea', 'Normes, RGPD, hébergement, accessibilité, etc.', 1, '', NULL, NULL, '', 'Toute contrainte spécifique qui pourrait impacter le projet.', 44, NULL),
(45, 13, 'Souhaitez-vous ajouter autre chose ?', 'textarea', 'Remarques ou demandes spécifiques...', 0, '', NULL, NULL, '', 'Tout élément supplémentaire qui vous semble important.', 45, NULL),
(46, 14, 'Quel est votre budget approximatif ?', 'number', 'En euros', 1, '', 1000, 100000, 'Le budget doit être compris entre 1 000 et 100 000 euros', 'Indiquez une fourchette pour cadrer les solutions proposées.', 46, NULL),
(47, 15, 'Quel est votre délai idéal de livraison ?', 'date', 'Choisissez une date', 1, '', NULL, NULL, '', 'Permet de planifier la charge de travail.', 47, NULL),
(48, 15, 'Quelles sont les dates clés à respecter ?', 'textarea', '', 0, '', NULL, NULL, '', 'Indiquez les dates et évènements liés à respecter', 48, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `specification_book`
--

CREATE TABLE `specification_book` (
  `id` int NOT NULL,
  `client_id` int DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specification_book`
--

INSERT INTO `specification_book` (`id`, `client_id`, `description`, `created_at`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet', '2025-07-29 13:02:03'),
(2, 2, 'Lorem ipsum dolor sit amet', '2025-07-29 13:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fingerprint` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `requires_validation` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `fingerprint`, `created_at`, `updated_at`, `requires_validation`) VALUES
(1, 'Alexandre', 'Salé', 'alexandre@as-turing.fr', '$argon2id$v=19$m=65536,t=4,p=1$TTdDdHFBVlFDWUlYOWtWNg$tWqWT78fMcvqfrHXULz3S9ldUIzye2axX7P50fFsyf0', 'a88d5b3ff21267d47ba86933091fd410', '2025-07-29 13:02:03', '2025-07-29 13:02:03', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E8FF75CCED5CA9E6` (`service_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8C9F36105518325C` (`specification_book_id`),
  ADD KEY `IDX_8C9F3610DB805178` (`quote_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CAC822D9ED5CA9E6` (`service_id`);

--
-- Indexes for table `quote`
--
ALTER TABLE `quote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6B71CBF419EB6921` (`client_id`);

--
-- Indexes for table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6C71EC30ED5CA9E6` (`service_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specification`
--
ALTER TABLE `specification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E3F1A9A12469DE2` (`category_id`);

--
-- Indexes for table `specification_book`
--
ALTER TABLE `specification_book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8366D44319EB6921` (`client_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `quote`
--
ALTER TABLE `quote`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `specification`
--
ALTER TABLE `specification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `specification_book`
--
ALTER TABLE `specification_book`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `FK_E8FF75CCED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `FK_8C9F36105518325C` FOREIGN KEY (`specification_book_id`) REFERENCES `specification_book` (`id`),
  ADD CONSTRAINT `FK_8C9F3610DB805178` FOREIGN KEY (`quote_id`) REFERENCES `quote` (`id`);

--
-- Constraints for table `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `FK_CAC822D9ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Constraints for table `quote`
--
ALTER TABLE `quote`
  ADD CONSTRAINT `FK_6B71CBF419EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

--
-- Constraints for table `seo`
--
ALTER TABLE `seo`
  ADD CONSTRAINT `FK_6C71EC30ED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Constraints for table `specification`
--
ALTER TABLE `specification`
  ADD CONSTRAINT `FK_E3F1A9A12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `specification_book`
--
ALTER TABLE `specification_book`
  ADD CONSTRAINT `FK_8366D44319EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
