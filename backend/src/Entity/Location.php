<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $slug = null;

    #[ORM\Column(length: 100)]
    private ?string $departement = null;

    #[ORM\Column(length: 10)]
    private ?string $codePostal = null;

    #[ORM\Column(length: 100)]
    private ?string $region = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $coordinates = null;

    #[ORM\Column(type: Types::JSON)]
    private array $meta = [];

    #[ORM\Column(type: Types::JSON)]
    private array $hero = [];

    #[ORM\Column(type: Types::JSON)]
    private array $whyChoose = [];

    #[ORM\Column(type: Types::JSON)]
    private array $services = [];

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $sectors = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $projects = null;

    #[ORM\Column(type: Types::JSON)]
    private array $process = [];

    #[ORM\Column(type: Types::JSON)]
    private array $faq = [];

    #[ORM\Column(type: Types::JSON)]
    private array $cta = [];

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $contact = null;

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;
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

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): static
    {
        $this->departement = $departement;
        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): static
    {
        $this->codePostal = $codePostal;
        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): static
    {
        $this->region = $region;
        return $this;
    }

    public function getCoordinates(): ?array
    {
        return $this->coordinates;
    }

    public function setCoordinates(?array $coordinates): static
    {
        $this->coordinates = $coordinates;
        return $this;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function setMeta(array $meta): static
    {
        $this->meta = $meta;
        return $this;
    }

    public function getHero(): array
    {
        return $this->hero;
    }

    public function setHero(array $hero): static
    {
        $this->hero = $hero;
        return $this;
    }

    public function getWhyChoose(): array
    {
        return $this->whyChoose;
    }

    public function setWhyChoose(array $whyChoose): static
    {
        $this->whyChoose = $whyChoose;
        return $this;
    }

    public function getServices(): array
    {
        return $this->services;
    }

    public function setServices(array $services): static
    {
        $this->services = $services;
        return $this;
    }

    public function getSectors(): ?array
    {
        return $this->sectors;
    }

    public function setSectors(?array $sectors): static
    {
        $this->sectors = $sectors;
        return $this;
    }

    public function getProjects(): ?array
    {
        return $this->projects;
    }

    public function setProjects(?array $projects): static
    {
        $this->projects = $projects;
        return $this;
    }

    public function getProcess(): array
    {
        return $this->process;
    }

    public function setProcess(array $process): static
    {
        $this->process = $process;
        return $this;
    }

    public function getFaq(): array
    {
        return $this->faq;
    }

    public function setFaq(array $faq): static
    {
        $this->faq = $faq;
        return $this;
    }

    public function getCta(): array
    {
        return $this->cta;
    }

    public function setCta(array $cta): static
    {
        $this->cta = $cta;
        return $this;
    }

    public function getContact(): ?array
    {
        return $this->contact;
    }

    public function setContact(?array $contact): static
    {
        $this->contact = $contact;
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

    public function toArray(): array
    {
        return [
            'ville' => $this->ville,
            'slug' => $this->slug,
            'departement' => $this->departement,
            'codePostal' => $this->codePostal,
            'region' => $this->region,
            'meta' => $this->meta,
            'hero' => $this->hero,
            'whyChoose' => $this->whyChoose,
            'services' => $this->services,
            'sectors' => $this->sectors,
            'projects' => $this->projects,
            'process' => $this->process,
            'faq' => $this->faq,
            'cta' => $this->cta,
            'contact' => $this->contact,
        ];
    }
}
