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
            $project->setTechnologies($data['technologies']);
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
