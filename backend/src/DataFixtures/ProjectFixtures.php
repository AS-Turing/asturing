<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures
{
    public function load(ObjectManager $manager): void
    {
        $jsonPath = __DIR__ . '/data/projects.json';
        $jsonData = json_decode(file_get_contents($jsonPath), true);

        foreach ($jsonData['projects'] as $data) {
            $project = new Project();
            $project->setTitle($data['title']);
            $project->setSlug($data['slug']);
            $project->setCategory($data['category']);
            $project->setDescription($data['description']);
            
            // Nouveaux champs détaillés
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
            
            // Champs existants
            $project->setTechnologies($data['technologies']);
            $project->setTechIcons($data['techIcons'] ?? []);
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

            $manager->persist($project);
        }

        $manager->flush();
    }
}
