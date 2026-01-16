<?php

namespace App\Command;

use App\Entity\Location;
use App\Entity\Project;
use App\Entity\Service;
use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:update-fixtures',
    description: 'Update existing data from JSON files',
)]
class UpdateFixturesCommand extends Command
{
    private const DATA_PATH = __DIR__ . '/../DataFixtures/data/';

    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption('entity', null, InputOption::VALUE_REQUIRED, 'Entity to update (location, service, project, blog)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Mise à jour des données depuis JSON');

        $entityType = $input->getOption('entity');

        $stats = [
            'locations' => ['updated' => 0, 'notfound' => 0],
            'services' => ['updated' => 0, 'notfound' => 0],
            'projects' => ['updated' => 0, 'notfound' => 0],
            'blogs' => ['updated' => 0, 'notfound' => 0],
        ];

        if ($entityType === 'location' || !$entityType) {
            $io->section('Mise à jour des Locations');
            $this->updateLocations($io, $stats);
        }

        if ($entityType === 'service' || !$entityType) {
            $io->section('Mise à jour des Services');
            $this->updateServices($io, $stats);
        }

        if ($entityType === 'project' || !$entityType) {
            $io->section('Mise à jour des Projects');
            $this->updateProjects($io, $stats);
        }

        if ($entityType === 'blog' || !$entityType) {
            $io->section('Mise à jour des Blog Posts');
            $this->updateBlogPosts($io, $stats);
        }

        $io->success('Mise à jour terminée !');
        $this->displayStats($io, $stats);

        return Command::SUCCESS;
    }

    private function updateLocations(SymfonyStyle $io, array &$stats): void
    {
        $locationsDir = self::DATA_PATH . 'locations/';
        if (!is_dir($locationsDir)) {
            $io->warning("Dossier $locationsDir non trouvé");
            return;
        }

        $files = glob($locationsDir . '*.json');
        $io->progressStart(count($files));

        foreach ($files as $file) {
            $data = json_decode(file_get_contents($file), true);
            
            $slug = $data['slug'];
            $location = $this->entityManager->getRepository(Location::class)->findOneBy(['slug' => $slug]);

            if (!$location) {
                $io->note("Location non trouvée en BDD : $slug - Ignorée");
                $stats['locations']['notfound']++;
                $io->progressAdvance();
                continue;
            }

            // Mise à jour des données
            if (isset($data['ville'])) {
                $location->setVille($data['ville']);
            }
            if (isset($data['departement'])) {
                $location->setDepartement($data['departement']);
            }
            if (isset($data['codePostal'])) {
                $location->setCodePostal($data['codePostal']);
            }
            if (isset($data['region'])) {
                $location->setRegion($data['region']);
            }

            // Mise à jour des coordonnées
            if (isset($data['coordinates'])) {
                $location->setCoordinates($data['coordinates']);
            }

            // Mise à jour meta (tableau complet)
            if (isset($data['meta'])) {
                $location->setMeta($data['meta']);
            }

            // Mise à jour hero (tableau complet)
            if (isset($data['hero'])) {
                $location->setHero($data['hero']);
            }

            // Mise à jour whyChoose
            if (isset($data['whyChoose'])) {
                $location->setWhyChoose($data['whyChoose']);
            }

            // Mise à jour services
            if (isset($data['services'])) {
                $location->setServices($data['services']);
            }

            // Mise à jour sectors
            if (isset($data['sectors'])) {
                $location->setSectors($data['sectors']);
            }

            // Mise à jour projects
            if (isset($data['projects'])) {
                $location->setProjects($data['projects']);
            }

            // Mise à jour process
            if (isset($data['process'])) {
                $location->setProcess($data['process']);
            }

            // Mise à jour faq
            if (isset($data['faq'])) {
                $location->setFaq($data['faq']);
            }

            // Mise à jour cta
            if (isset($data['cta'])) {
                $location->setCta($data['cta']);
            }

            // Mise à jour contact
            if (isset($data['contact'])) {
                $location->setContact($data['contact']);
            }

            $stats['locations']['updated']++;
            $io->progressAdvance();
        }

        $io->progressFinish();
        $this->entityManager->flush();
    }

    private function updateServices(SymfonyStyle $io, array &$stats): void
    {
        $jsonPath = self::DATA_PATH . 'services.json';
        if (!file_exists($jsonPath)) {
            $io->warning("Fichier $jsonPath non trouvé");
            return;
        }

        $data = json_decode(file_get_contents($jsonPath), true);
        $services = $data['services'] ?? [];

        $io->progressStart(count($services));

        foreach ($services as $serviceData) {
            $slug = $serviceData['slug'];
            $service = $this->entityManager->getRepository(Service::class)->findOneBy(['slug' => $slug]);

            if (!$service) {
                $io->note("Service non trouvé en BDD : $slug - Ignoré");
                $stats['services']['notfound']++;
                $io->progressAdvance();
                continue;
            }

            // Mise à jour des données principales
            if (isset($serviceData['title'])) {
                $service->setTitle($serviceData['title']);
            }
            if (isset($serviceData['description'])) {
                $service->setDescription($serviceData['description']);
            }
            if (isset($serviceData['price'])) {
                $service->setPrice($serviceData['price']);
            }
            if (isset($serviceData['duration'])) {
                $service->setDuration($serviceData['duration']);
            }

            // Mise à jour SEO
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

            $stats['services']['updated']++;
            $io->progressAdvance();
        }

        $io->progressFinish();
        $this->entityManager->flush();
    }

    private function updateProjects(SymfonyStyle $io, array &$stats): void
    {
        $jsonPath = self::DATA_PATH . 'projects.json';
        if (!file_exists($jsonPath)) {
            $io->warning("Fichier $jsonPath non trouvé");
            return;
        }

        $data = json_decode(file_get_contents($jsonPath), true);
        $projects = $data['projects'] ?? [];

        $io->progressStart(count($projects));

        foreach ($projects as $projectData) {
            $slug = $projectData['slug'];
            $project = $this->entityManager->getRepository(Project::class)->findOneBy(['slug' => $slug]);

            if (!$project) {
                $io->note("Project non trouvé en BDD : $slug - Ignoré");
                $stats['projects']['notfound']++;
                $io->progressAdvance();
                continue;
            }

            // Mise à jour des données principales
            if (isset($projectData['title'])) {
                $project->setTitle($projectData['title']);
            }
            if (isset($projectData['description'])) {
                $project->setDescription($projectData['description']);
            }

            // Mise à jour SEO
            if (isset($projectData['metaTitle'])) {
                $project->setMetaTitle($projectData['metaTitle']);
            }
            if (isset($projectData['metaDescription'])) {
                $project->setMetaDescription($projectData['metaDescription']);
            }
            if (isset($projectData['metaKeywords'])) {
                $project->setMetaKeywords($projectData['metaKeywords']);
            }
            if (isset($projectData['ogImage'])) {
                $project->setOgImage($projectData['ogImage']);
            }

            $stats['projects']['updated']++;
            $io->progressAdvance();
        }

        $io->progressFinish();
        $this->entityManager->flush();
    }

    private function updateBlogPosts(SymfonyStyle $io, array &$stats): void
    {
        $jsonPath = self::DATA_PATH . 'blogs.json';
        if (!file_exists($jsonPath)) {
            $io->warning("Fichier $jsonPath non trouvé");
            return;
        }

        $data = json_decode(file_get_contents($jsonPath), true);
        $blogs = $data['posts'] ?? [];

        $io->progressStart(count($blogs));

        foreach ($blogs as $blogData) {
            $slug = $blogData['slug'];
            $blog = $this->entityManager->getRepository(BlogPost::class)->findOneBy(['slug' => $slug]);

            if (!$blog) {
                $io->note("Blog non trouvé en BDD : $slug - Ignoré");
                $stats['blogs']['notfound']++;
                $io->progressAdvance();
                continue;
            }

            // Mise à jour des données principales
            if (isset($blogData['title'])) {
                $blog->setTitle($blogData['title']);
            }
            if (isset($blogData['content'])) {
                $blog->setContent($blogData['content']);
            }

            // Mise à jour SEO
            if (isset($blogData['metaTitle'])) {
                $blog->setMetaTitle($blogData['metaTitle']);
            }
            if (isset($blogData['metaDescription'])) {
                $blog->setMetaDescription($blogData['metaDescription']);
            }
            if (isset($blogData['metaKeywords'])) {
                $blog->setMetaKeywords($blogData['metaKeywords']);
            }
            if (isset($blogData['ogImage'])) {
                $blog->setOgImage($blogData['ogImage']);
            }

            $stats['blogs']['updated']++;
            $io->progressAdvance();
        }

        $io->progressFinish();
        $this->entityManager->flush();
    }

    private function displayStats(SymfonyStyle $io, array $stats): void
    {
        $io->section('Statistiques');

        $rows = [];
        foreach ($stats as $entity => $data) {
            $rows[] = [
                ucfirst($entity),
                $data['updated'],
                $data['notfound']
            ];
        }

        $io->table(
            ['Entité', 'Mises à jour', 'Non trouvées'],
            $rows
        );
    }
}
