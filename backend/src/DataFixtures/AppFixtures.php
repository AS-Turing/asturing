<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Projects
        $projects = [
            [
                'title' => 'E-commerce de mode responsable',
                'slug' => 'ecommerce-mode-responsable',
                'category' => 'E-commerce',
                'description' => 'Plateforme e-commerce complète avec système de paiement sécurisé et gestion des stocks en temps réel.',
                'technologies' => ['Symfony', 'Vue.js', 'Stripe'],
                'bgGradient' => 'from-primary to-secondary',
                'imageGradient' => 'from-blue-500 to-purple-600',
                'imageText' => 'EM',
                'dotColor' => 'bg-green-400',
                'categoryColor' => 'text-blue-300',
                'descColor' => 'text-white/90',
                'techClass' => 'bg-white/20 text-white',
                'linkColor' => 'text-white'
            ],
            [
                'title' => 'Application de gestion RH',
                'slug' => 'application-gestion-rh',
                'category' => 'Application Web',
                'description' => 'Solution SaaS pour la gestion des ressources humaines avec tableau de bord analytique avancé.',
                'technologies' => ['Laravel', 'React', 'PostgreSQL'],
                'bgGradient' => 'from-coral to-primary',
                'imageGradient' => 'from-orange-500 to-pink-600',
                'imageText' => 'RH',
                'dotColor' => 'bg-yellow-400',
                'categoryColor' => 'text-orange-300',
                'descColor' => 'text-white/90',
                'techClass' => 'bg-white/20 text-white',
                'linkColor' => 'text-white'
            ]
        ];

        foreach ($projects as $data) {
            $project = new Project();
            $project->setTitle($data['title']);
            $project->setSlug($data['slug']);
            $project->setCategory($data['category']);
            $project->setDescription($data['description']);
            $project->setTechnologies($data['technologies']);
            $project->setBgGradient($data['bgGradient']);
            $project->setImageGradient($data['imageGradient']);
            $project->setImageText($data['imageText']);
            $project->setDotColor($data['dotColor']);
            $project->setCategoryColor($data['categoryColor']);
            $project->setDescColor($data['descColor']);
            $project->setTechClass($data['techClass']);
            $project->setLinkColor($data['linkColor']);
            
            $manager->persist($project);
        }

        // Blog Posts
        $posts = [
            [
                'title' => 'Les tendances du développement web en 2024',
                'slug' => 'tendances-developpement-web-2024',
                'category' => 'Développement',
                'categoryClass' => 'bg-primary/10 text-primary',
                'excerpt' => 'Découvrez les technologies et pratiques qui façonnent le web moderne.',
                'content' => 'Contenu complet de l\'article...',
                'imageGradient' => 'from-primary to-secondary',
                'imageText' => 'TW',
                'isPublished' => true,
                'publishedAt' => new \DateTimeImmutable('-10 days')
            ],
            [
                'title' => 'Comment choisir son CMS ?',
                'slug' => 'comment-choisir-cms',
                'category' => 'Conseil',
                'categoryClass' => 'bg-coral/10 text-coral',
                'excerpt' => 'Guide complet pour sélectionner la meilleure solution CMS pour votre projet.',
                'content' => 'Contenu complet de l\'article...',
                'imageGradient' => 'from-coral to-primary',
                'imageText' => 'CMS',
                'isPublished' => true,
                'publishedAt' => new \DateTimeImmutable('-5 days')
            ],
            [
                'title' => 'Optimiser les performances de votre site',
                'slug' => 'optimiser-performances-site',
                'category' => 'Performance',
                'categoryClass' => 'bg-secondary/10 text-secondary',
                'excerpt' => 'Techniques avancées pour améliorer la vitesse et l\'expérience utilisateur.',
                'content' => 'Contenu complet de l\'article...',
                'imageGradient' => 'from-secondary to-primary',
                'imageText' => 'PERF',
                'isPublished' => true,
                'publishedAt' => new \DateTimeImmutable('-2 days')
            ]
        ];

        foreach ($posts as $data) {
            $post = new BlogPost();
            $post->setTitle($data['title']);
            $post->setSlug($data['slug']);
            $post->setCategory($data['category']);
            $post->setCategoryClass($data['categoryClass']);
            $post->setExcerpt($data['excerpt']);
            $post->setContent($data['content']);
            $post->setImageGradient($data['imageGradient']);
            $post->setImageText($data['imageText']);
            $post->setIsPublished($data['isPublished']);
            $post->setPublishedAt($data['publishedAt']);
            
            $manager->persist($post);
        }

        $manager->flush();
    }
}
