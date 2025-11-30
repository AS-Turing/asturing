<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Persistence\ObjectManager;

class BlogPostFixtures
{
    public function load(ObjectManager $manager): void
    {
        $jsonPath = __DIR__ . '/data/blogs.json';
        $jsonData = json_decode(file_get_contents($jsonPath), true);

        foreach ($jsonData['blogs'] as $data) {
            $post = new BlogPost();
            $post->setTitle($data['title']);
            $post->setSlug($data['slug']);
            $post->setExcerpt($data['excerpt']);
            $post->setContent($data['content']);
            $post->setCategory($data['category']);
            $post->setCategoryClass($data['categoryClass']);
            $post->setImageGradient($data['imageGradient']);
            $post->setImageText($data['imageText']);
            $post->setPublishedAt(new \DateTimeImmutable($data['publishedAt']));
            $post->setIsPublished($data['isPublished']);

            $manager->persist($post);
        }

        $manager->flush();
    }
}
