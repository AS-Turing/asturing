<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $excerpt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $client = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sector = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $year = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $duration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $challenge = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $solution = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $results = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $content = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $testimonial = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $technologies = [];

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private array $features = [];

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $images = null;

    #[ORM\Column]
    private ?bool $featured = false;

    #[ORM\Column]
    private ?bool $isPublished = true;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageText = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $challengeImage = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $solutionImage = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $resultsImage = null;

    #[ORM\Column(length: 100)]
    private ?string $bgGradient = null;

    #[ORM\Column(length: 100)]
    private ?string $imageGradient = null;

    #[ORM\Column(length: 50)]
    private ?string $dotColor = null;

    #[ORM\Column(length: 100)]
    private ?string $categoryColor = null;

    #[ORM\Column(length: 100)]
    private ?string $descColor = null;

    #[ORM\Column(length: 100)]
    private ?string $techClass = null;

    #[ORM\Column(length: 100)]
    private ?string $linkColor = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $position = 0;

    #[ORM\Column]
    private ?bool $isActive = true;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getExcerpt(): ?string
    {
        return $this->excerpt;
    }

    public function setExcerpt(?string $excerpt): static
    {
        $this->excerpt = $excerpt;
        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(?string $client): static
    {
        $this->client = $client;
        return $this;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function setSector(?string $sector): static
    {
        $this->sector = $sector;
        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): static
    {
        $this->year = $year;
        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration): static
    {
        $this->duration = $duration;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;
        return $this;
    }

    public function getChallenge(): ?string
    {
        return $this->challenge;
    }

    public function setChallenge(?string $challenge): static
    {
        $this->challenge = $challenge;
        return $this;
    }

    public function getSolution(): ?string
    {
        return $this->solution;
    }

    public function setSolution(?string $solution): static
    {
        $this->solution = $solution;
        return $this;
    }

    public function getResults(): ?string
    {
        return $this->results;
    }

    public function setResults(?string $results): static
    {
        $this->results = $results;
        return $this;
    }

    public function getContent(): ?array
    {
        return $this->content;
    }

    public function setContent(?array $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function getTestimonial(): ?array
    {
        return $this->testimonial;
    }

    public function setTestimonial(?array $testimonial): static
    {
        $this->testimonial = $testimonial;
        return $this;
    }

    public function getFeatures(): array
    {
        return $this->features ?? [];
    }

    public function setFeatures(?array $features): static
    {
        $this->features = $features ?? [];
        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(?array $images): static
    {
        $this->images = $images;
        return $this;
    }

    public function isFeatured(): ?bool
    {
        return $this->featured;
    }

    public function setFeatured(bool $featured): static
    {
        $this->featured = $featured;
        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;
        return $this;
    }

    public function getTechnologies(): array
    {
        return $this->technologies;
    }

    public function setTechnologies(array $technologies): static
    {
        $this->technologies = $technologies;
        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getImageText(): ?string
    {
        return $this->imageText;
    }

    public function setImageText(?string $imageText): static
    {
        $this->imageText = $imageText;
        return $this;
    }

    public function getChallengeImage(): ?string
    {
        return $this->challengeImage;
    }

    public function setChallengeImage(?string $challengeImage): static
    {
        $this->challengeImage = $challengeImage;
        return $this;
    }

    public function getSolutionImage(): ?string
    {
        return $this->solutionImage;
    }

    public function setSolutionImage(?string $solutionImage): static
    {
        $this->solutionImage = $solutionImage;
        return $this;
    }

    public function getResultsImage(): ?string
    {
        return $this->resultsImage;
    }

    public function setResultsImage(?string $resultsImage): static
    {
        $this->resultsImage = $resultsImage;
        return $this;
    }

    public function getBgGradient(): ?string
    {
        return $this->bgGradient;
    }

    public function setBgGradient(string $bgGradient): static
    {
        $this->bgGradient = $bgGradient;
        return $this;
    }

    public function getImageGradient(): ?string
    {
        return $this->imageGradient;
    }

    public function setImageGradient(string $imageGradient): static
    {
        $this->imageGradient = $imageGradient;
        return $this;
    }

    public function getDotColor(): ?string
    {
        return $this->dotColor;
    }

    public function setDotColor(string $dotColor): static
    {
        $this->dotColor = $dotColor;
        return $this;
    }

    public function getCategoryColor(): ?string
    {
        return $this->categoryColor;
    }

    public function setCategoryColor(string $categoryColor): static
    {
        $this->categoryColor = $categoryColor;
        return $this;
    }

    public function getDescColor(): ?string
    {
        return $this->descColor;
    }

    public function setDescColor(string $descColor): static
    {
        $this->descColor = $descColor;
        return $this;
    }

    public function getTechClass(): ?string
    {
        return $this->techClass;
    }

    public function setTechClass(string $techClass): static
    {
        $this->techClass = $techClass;
        return $this;
    }

    public function getLinkColor(): ?string
    {
        return $this->linkColor;
    }

    public function setLinkColor(string $linkColor): static
    {
        $this->linkColor = $linkColor;
        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;
        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
