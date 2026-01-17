<?php

namespace App\Controller\Api;

use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/blog')]
class BlogPostController extends AbstractController
{
    #[Route('/posts', name: 'api_blog_posts_list', methods: ['GET'])]
    public function list(BlogPostRepository $blogPostRepository): JsonResponse
    {
        $posts = $blogPostRepository->findPublishedOrderedByPublishedAtDesc();

        $data = array_map(function($post) {
            return [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'slug' => $post->getSlug(),
                'excerpt' => $post->getExcerpt(),
                'category' => $post->getCategory(),
                'categoryClass' => $post->getCategoryClass(),
                'imageUrl' => $post->getImageUrl(),
                'imageGradient' => $post->getImageGradient(),
                'imageText' => $post->getImageText(),
                'publishedAt' => $post->getPublishedAt()?->format('Y-m-d'),
            ];
        }, $posts);

        return $this->json($data);
    }

    #[Route('/posts/{slug}', name: 'api_blog_posts_show', methods: ['GET'])]
    public function show(string $slug, BlogPostRepository $blogPostRepository): JsonResponse
    {
        $post = $blogPostRepository->findOnePublishedBySlug($slug);

        if (!$post) {
            return $this->json(['error' => 'Blog post not found'], 404);
        }

        return $this->json([
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'slug' => $post->getSlug(),
            'excerpt' => $post->getExcerpt(),
            'content' => $post->getContent(),
            'category' => $post->getCategory(),
            'categoryClass' => $post->getCategoryClass(),
            'imageUrl' => $post->getImageUrl(),
            'imageGradient' => $post->getImageGradient(),
            'imageText' => $post->getImageText(),
            'publishedAt' => $post->getPublishedAt()?->format('Y-m-d'),
        ]);
    }
}
