<?php

namespace App\Command;

use App\Entity\Project;
use App\Entity\Service;
use App\Entity\ServiceSolution;
use App\Entity\ServiceProcessStep;
use App\Entity\ServiceTechnology;
use App\Entity\ServiceFaq;
use App\Entity\BlogPost;
use App\Entity\Client;
use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:import-incremental',
    description: 'Import data from JSON files incrementally without overwriting existing data',
)]
class ImportIncrementalCommand extends Command
{
    private const DATA_PATH = __DIR__ . '/../DataFixtures/data/';

    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Import incrémental des données depuis JSON');

        $stats = [
            'services' => ['added' => 0, 'skipped' => 0],
            'projects' => ['added' => 0, 'skipped' => 0],
            'blogs' => ['added' => 0, 'skipped' => 0],
            'clients' => ['added' => 0, 'skipped' => 0],
            'locations' => ['added' => 0, 'skipped' => 0],
        ];

        // Import Services
        $io->section('Import des Services');
        $this->importServices($io, $stats);

        // Import Projects
        $io->section('Import des Projects');
        $this->importProjects($io, $stats);

        // Import Blog Posts
        $io->section('Import des Blog Posts');
        $this->importBlogPosts($io, $stats);

        // Import Clients
        $io->section('Import des Clients');
        $this->importClients($io, $stats);

        // Import Locations
        $io->section('Import des Locations');
        $this->importLocations($io, $stats);

        // Afficher les statistiques
        $io->success('Import incrémental terminé !');
        $this->displayStats($io, $stats);

        return Command::SUCCESS;
    }

    private function importServices(SymfonyStyle $io, array &$stats): void
    {
        $jsonPath = self::DATA_PATH . 'services.json';
        if (!file_exists($jsonPath)) {
            $io->warning("Fichier $jsonPath non trouvé");
            return;
        }

        $jsonData = json_decode(file_get_contents($jsonPath), true);
        $serviceRepo = $this->entityManager->getRepository(Service::class);

        foreach ($jsonData['services'] as $serviceData) {
            $slug = $serviceData['slug'];
            
            // Vérifier si le service existe déjà
            $existingService = $serviceRepo->findOneBy(['slug' => $slug]);
            
            if ($existingService) {
                $io->text("  ⏭️  Service '{$serviceData['title']}' (slug: $slug) existe déjà - ignoré");
                $stats['services']['skipped']++;
                continue;
            }

            // Créer le nouveau service
            $service = new Service();
            $service->setTitle($serviceData['title']);
            $service->setSlug($slug);
            $service->setDescription($serviceData['shortDescription']);
            $service->setShortDescription($serviceData['shortDescription']);
            $service->setLongDescription($serviceData['description']);
            $service->setIcon($serviceData['icon']);
            $service->setIconGradient($serviceData['iconGradient']);
            $service->setBorderColor($serviceData['borderColor']);
            $service->setLinkColor($serviceData['linkColor']);
            $service->setPosition($serviceData['position']);
            $service->setIsActive(true);
            $service->setHeroTitle($serviceData['heroTitle']);
            $service->setHeroSubtitle($serviceData['heroSubtitle']);
            $service->setHeroDescription($serviceData['heroDescription'] ?? null);
            $service->setAuditDuration($serviceData['auditDuration']);
            $service->setCta($serviceData['cta'] ?? null);
            
            if (isset($serviceData['audience'])) {
                $service->setAudience($serviceData['audience']);
            }
            if (isset($serviceData['outcomes'])) {
                $service->setOutcomes($serviceData['outcomes']);
            }
            if (isset($serviceData['ctaSoft'])) {
                $service->setCtaSoft($serviceData['ctaSoft']);
            }
            if (isset($serviceData['deliveryTime'])) {
                $service->setDeliveryTime($serviceData['deliveryTime']);
            }
            if (isset($serviceData['startingPrice'])) {
                $service->setStartingPrice($serviceData['startingPrice']);
            }
            if (isset($serviceData['metaTitle'])) {
                $service->setMetaTitle($serviceData['metaTitle']);
            }
            if (isset($serviceData['metaDescription'])) {
                $service->setMetaDescription($serviceData['metaDescription']);
            }
            if (isset($serviceData['metaKeywords'])) {
                $service->setMetaKeywords($serviceData['metaKeywords']);
            }
            if (isset($serviceData['ogImage'])) {
                $service->setOgImage($serviceData['ogImage']);
            }

            $this->entityManager->persist($service);

            // Ajouter les solutions
            foreach ($serviceData['solutions'] as $index => $solutionData) {
                $solution = new ServiceSolution();
                $solution->setTitle($solutionData['title']);
                $solution->setDescription($solutionData['description']);
                $solution->setFeatures($solutionData['features']);
                if (isset($solutionData['startingPrice'])) {
                    $solution->setStartingPrice($solutionData['startingPrice']);
                }
                if (isset($solutionData['deliveryTime'])) {
                    $solution->setDeliveryTime($solutionData['deliveryTime']);
                }
                if (isset($solutionData['price'])) {
                    $solution->setPrice($solutionData['price']);
                }
                if (isset($solutionData['priceEngagement'])) {
                    $solution->setPriceEngagement($solutionData['priceEngagement']);
                }
                if (isset($solutionData['icon'])) {
                    $solution->setIcon($solutionData['icon']);
                }
                $solution->setPosition($index);
                $solution->setService($service);
                $this->entityManager->persist($solution);
            }

            // Ajouter les étapes du processus
            foreach ($serviceData['process'] as $index => $processData) {
                $step = new ServiceProcessStep();
                $step->setTitle($processData['title']);
                $step->setDescription($processData['description']);
                $step->setPosition($index);
                $step->setService($service);
                $this->entityManager->persist($step);
            }

            // Ajouter les technologies
            if (isset($serviceData['technologies'])) {
                foreach ($serviceData['technologies'] as $techData) {
                    $tech = new ServiceTechnology();
                    $tech->setName($techData['name']);
                    $tech->setDescription($techData['description']);
                    if (isset($techData['icon'])) {
                        $tech->setIcon($techData['icon']);
                    }
                    $tech->setService($service);
                    $this->entityManager->persist($tech);
                }
            }

            // Ajouter les FAQs
            foreach ($serviceData['faqs'] as $index => $faqData) {
                $faq = new ServiceFaq();
                $faq->setQuestion($faqData['question']);
                $faq->setAnswer($faqData['answer']);
                $faq->setPosition($index);
                $faq->setService($service);
                $this->entityManager->persist($faq);
            }

            $this->entityManager->flush();
            $io->text("  ✅ Service '{$serviceData['title']}' ajouté avec succès");
            $stats['services']['added']++;
        }
    }

    private function importProjects(SymfonyStyle $io, array &$stats): void
    {
        $jsonPath = self::DATA_PATH . 'projects.json';
        if (!file_exists($jsonPath)) {
            $io->warning("Fichier $jsonPath non trouvé");
            return;
        }

        $jsonData = json_decode(file_get_contents($jsonPath), true);
        $projectRepo = $this->entityManager->getRepository(Project::class);

        foreach ($jsonData['projects'] as $data) {
            $slug = $data['slug'];
            
            // Vérifier si le projet existe déjà
            $existingProject = $projectRepo->findOneBy(['slug' => $slug]);
            
            if ($existingProject) {
                $io->text("  ⏭️  Projet '{$data['title']}' (slug: $slug) existe déjà - ignoré");
                $stats['projects']['skipped']++;
                continue;
            }

            // Créer le nouveau projet
            $project = new Project();
            $project->setTitle($data['title']);
            $project->setSlug($slug);
            $project->setCategory($data['category']);
            $project->setDescription($data['description']);
            $project->setExcerpt($data['excerpt'] ?? null);
            $project->setClient($data['client'] ?? null);
            $project->setSector($data['sector'] ?? null);
            $project->setYear($data['year'] ?? null);
            $project->setDuration($data['duration'] ?? null);
            $project->setStatus($data['status'] ?? null);
            $project->setUrl($data['url'] ?? null);
            $project->setChallenge($data['challenge'] ?? null);
            $project->setSolution($data['solution'] ?? null);
            $project->setResults($data['results'] ?? null);
            $project->setContent($data['content'] ?? null);
            $project->setTestimonial($data['testimonial'] ?? null);
            $project->setFeatures($data['features'] ?? []);
            $project->setImages($data['images'] ?? []);
            $project->setFeatured($data['featured'] ?? false);
            $project->setIsPublished($data['isPublished'] ?? true);
            $project->setTechnologies($data['technologies']);
            $project->setTechIcons($data['techIcons'] ?? []);
            $project->setImageUrl($data['imageUrl'] ?? null);
            $project->setImageText($data['imageText']);
            $project->setBgGradient($data['bgGradient']);
            $project->setImageGradient($data['imageGradient']);
            $project->setDotColor($data['dotColor']);
            $project->setCategoryColor($data['categoryColor']);
            $project->setDescColor($data['descColor']);
            $project->setTechClass($data['techClass']);
            $project->setLinkColor($data['linkColor']);
            $project->setPosition($data['position']);
            $project->setIsActive(true);

            $this->entityManager->persist($project);
            $this->entityManager->flush();
            
            $io->text("  ✅ Projet '{$data['title']}' ajouté avec succès");
            $stats['projects']['added']++;
        }
    }

    private function importBlogPosts(SymfonyStyle $io, array &$stats): void
    {
        $jsonPath = self::DATA_PATH . 'blogs.json';
        if (!file_exists($jsonPath)) {
            $io->warning("Fichier $jsonPath non trouvé");
            return;
        }

        $jsonData = json_decode(file_get_contents($jsonPath), true);
        $blogRepo = $this->entityManager->getRepository(BlogPost::class);

        foreach ($jsonData['blogs'] as $data) {
            $slug = $data['slug'];
            
            // Vérifier si le blog existe déjà
            $existingBlog = $blogRepo->findOneBy(['slug' => $slug]);
            
            if ($existingBlog) {
                $io->text("  ⏭️  Blog '{$data['title']}' (slug: $slug) existe déjà - ignoré");
                $stats['blogs']['skipped']++;
                continue;
            }

            // Créer le nouveau blog post
            $blog = new BlogPost();
            $blog->setTitle($data['title']);
            $blog->setSlug($slug);
            $blog->setExcerpt($data['excerpt']);
            $blog->setContent($data['content']);
            $blog->setImageUrl($data['imageUrl']);
            $blog->setAuthor($data['author']);
            $blog->setReadingTime($data['readingTime']);
            $blog->setPublishedAt(new \DateTimeImmutable($data['publishedAt']));
            $blog->setIsPublished($data['isPublished'] ?? true);

            if (isset($data['category'])) {
                $blog->setCategory($data['category']);
            }
            if (isset($data['tags'])) {
                $blog->setTags($data['tags']);
            }

            $this->entityManager->persist($blog);
            $this->entityManager->flush();
            
            $io->text("  ✅ Blog '{$data['title']}' ajouté avec succès");
            $stats['blogs']['added']++;
        }
    }

    private function importClients(SymfonyStyle $io, array &$stats): void
    {
        $jsonPath = self::DATA_PATH . 'clients.json';
        if (!file_exists($jsonPath)) {
            $io->warning("Fichier $jsonPath non trouvé");
            return;
        }

        $jsonData = json_decode(file_get_contents($jsonPath), true);
        $clientRepo = $this->entityManager->getRepository(Client::class);

        foreach ($jsonData['clients'] as $data) {
            // Vérifier si le client existe déjà (par nom)
            $existingClient = $clientRepo->findOneBy(['name' => $data['name']]);
            
            if ($existingClient) {
                $io->text("  ⏭️  Client '{$data['name']}' existe déjà - ignoré");
                $stats['clients']['skipped']++;
                continue;
            }

            // Créer le nouveau client
            $client = new Client();
            $client->setName($data['name']);
            $client->setLogoUrl($data['logoUrl']);
            $client->setPosition($data['position']);
            $client->setIsActive(true);

            $this->entityManager->persist($client);
            $this->entityManager->flush();
            
            $io->text("  ✅ Client '{$data['name']}' ajouté avec succès");
            $stats['clients']['added']++;
        }
    }

    private function importLocations(SymfonyStyle $io, array &$stats): void
    {
        $locationsDir = self::DATA_PATH . 'locations';
        if (!is_dir($locationsDir)) {
            $io->warning("Répertoire $locationsDir non trouvé");
            return;
        }

        $locationRepo = $this->entityManager->getRepository(Location::class);
        $jsonFiles = glob($locationsDir . '/*.json');

        foreach ($jsonFiles as $jsonFile) {
            $jsonData = json_decode(file_get_contents($jsonFile), true);
            
            if (!isset($jsonData['slug'])) {
                continue;
            }

            $slug = $jsonData['slug'];
            
            // Vérifier si la location existe déjà
            $existingLocation = $locationRepo->findOneBy(['slug' => $slug]);
            
            if ($existingLocation) {
                $io->text("  ⏭️  Location '{$jsonData['ville']}' (slug: $slug) existe déjà - ignorée");
                $stats['locations']['skipped']++;
                continue;
            }

            // Créer la nouvelle location
            $location = new Location();
            $location->setVille($jsonData['ville']);
            $location->setSlug($slug);
            $location->setDepartement($jsonData['departement']);
            $location->setCodePostal($jsonData['codePostal']);
            $location->setRegion($jsonData['region']);
            $location->setCoordinates($jsonData['coordinates'] ?? null);
            $location->setMeta($jsonData['meta']);
            $location->setHero($jsonData['hero']);
            $location->setWhyChoose($jsonData['whyChoose']);
            $location->setServices($jsonData['services']);
            $location->setSectors($jsonData['sectors'] ?? null);
            $location->setProjects($jsonData['projects'] ?? null);
            $location->setProcess($jsonData['process']);
            $location->setFaq($jsonData['faq']);
            $location->setCta($jsonData['cta']);
            $location->setContact($jsonData['contact'] ?? null);
            $location->setIsActive(true);

            $this->entityManager->persist($location);
            $this->entityManager->flush();
            
            $io->text("  ✅ Location '{$jsonData['ville']}' ajoutée avec succès");
            $stats['locations']['added']++;
        }
    }

    private function displayStats(SymfonyStyle $io, array $stats): void
    {
        $io->section('📊 Statistiques d\'import');
        
        $io->table(
            ['Type', 'Ajoutés', 'Ignorés (déjà existants)'],
            [
                ['Services', $stats['services']['added'], $stats['services']['skipped']],
                ['Projets', $stats['projects']['added'], $stats['projects']['skipped']],
                ['Blog Posts', $stats['blogs']['added'], $stats['blogs']['skipped']],
                ['Clients', $stats['clients']['added'], $stats['clients']['skipped']],
                ['Locations', $stats['locations']['added'], $stats['locations']['skipped']],
            ]
        );

        $totalAdded = array_sum(array_column($stats, 'added'));
        $totalSkipped = array_sum(array_column($stats, 'skipped'));

        $io->text("📈 Total : $totalAdded ajouté(s), $totalSkipped ignoré(s)");
    }
}
