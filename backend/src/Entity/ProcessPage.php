<?php

namespace App\Entity;

use App\Repository\ProcessPageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProcessPageRepository::class)]
class ProcessPage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $heroBadge = null;

    #[ORM\Column(length: 255)]
    private ?string $heroTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $heroSubtitle = null;

    #[ORM\Column(length: 255)]
    private ?string $processTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $processDescription = null;

    #[ORM\Column(type: Types::JSON)]
    private array $processSteps = [];

    #[ORM\Column(length: 255)]
    private ?string $valuesTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $valuesDescription = null;

    #[ORM\Column(type: Types::JSON, name: '`values`')]
    private array $values = [];

    #[ORM\Column(length: 255)]
    private ?string $seoTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $seoDescription = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeroBadge(): ?string
    {
        return $this->heroBadge;
    }

    public function setHeroBadge(string $heroBadge): static
    {
        $this->heroBadge = $heroBadge;
        return $this;
    }

    public function getHeroTitle(): ?string
    {
        return $this->heroTitle;
    }

    public function setHeroTitle(string $heroTitle): static
    {
        $this->heroTitle = $heroTitle;
        return $this;
    }

    public function getHeroSubtitle(): ?string
    {
        return $this->heroSubtitle;
    }

    public function setHeroSubtitle(string $heroSubtitle): static
    {
        $this->heroSubtitle = $heroSubtitle;
        return $this;
    }

    public function getProcessTitle(): ?string
    {
        return $this->processTitle;
    }

    public function setProcessTitle(string $processTitle): static
    {
        $this->processTitle = $processTitle;
        return $this;
    }

    public function getProcessDescription(): ?string
    {
        return $this->processDescription;
    }

    public function setProcessDescription(string $processDescription): static
    {
        $this->processDescription = $processDescription;
        return $this;
    }

    public function getProcessSteps(): array
    {
        return $this->processSteps;
    }

    public function setProcessSteps(array $processSteps): static
    {
        $this->processSteps = $processSteps;
        return $this;
    }

    public function getValuesTitle(): ?string
    {
        return $this->valuesTitle;
    }

    public function setValuesTitle(string $valuesTitle): static
    {
        $this->valuesTitle = $valuesTitle;
        return $this;
    }

    public function getValuesDescription(): ?string
    {
        return $this->valuesDescription;
    }

    public function setValuesDescription(string $valuesDescription): static
    {
        $this->valuesDescription = $valuesDescription;
        return $this;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function setValues(array $values): static
    {
        $this->values = $values;
        return $this;
    }

    public function getSeoTitle(): ?string
    {
        return $this->seoTitle;
    }

    public function setSeoTitle(string $seoTitle): static
    {
        $this->seoTitle = $seoTitle;
        return $this;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seoDescription;
    }

    public function setSeoDescription(string $seoDescription): static
    {
        $this->seoDescription = $seoDescription;
        return $this;
    }
}
