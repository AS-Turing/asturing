<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $longDescription = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $icon = null;

    #[ORM\Column(length: 100)]
    private ?string $iconGradient = null;

    #[ORM\Column(length: 100)]
    private ?string $borderColor = null;

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

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $heroImage = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $heroSubtitle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $heroDescription = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $shortDescription = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $cta = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $audience = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $outcomes = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $ctaSoft = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private array $stats = [];

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private array $techCategories = [];

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $auditDuration = '1h';

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $startingPrice = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $deliveryTime = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $heroTitle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $metaDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $metaTitle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $metaKeywords = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ogImage = null;

    #[ORM\OneToMany(targetEntity: ServiceSolution::class, mappedBy: 'service', cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\OrderBy(['position' => 'ASC'])]
    private Collection $solutions;

    #[ORM\OneToMany(targetEntity: ServiceProcessStep::class, mappedBy: 'service', cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\OrderBy(['position' => 'ASC'])]
    private Collection $processSteps;

    #[ORM\OneToMany(targetEntity: ServiceFaq::class, mappedBy: 'service', cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\OrderBy(['position' => 'ASC'])]
    private Collection $faqs;

    #[ORM\OneToMany(targetEntity: ServiceTechnology::class, mappedBy: 'service', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $technologies;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->solutions = new ArrayCollection();
        $this->processSteps = new ArrayCollection();
        $this->faqs = new ArrayCollection();
        $this->technologies = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(?string $longDescription): static
    {
        $this->longDescription = $longDescription;
        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): static
    {
        $this->icon = $icon;
        return $this;
    }

    public function getIconGradient(): ?string
    {
        return $this->iconGradient;
    }

    public function setIconGradient(string $iconGradient): static
    {
        $this->iconGradient = $iconGradient;
        return $this;
    }

    public function getBorderColor(): ?string
    {
        return $this->borderColor;
    }

    public function setBorderColor(string $borderColor): static
    {
        $this->borderColor = $borderColor;
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

    public function getHeroImage(): ?string
    {
        return $this->heroImage;
    }

    public function setHeroImage(?string $heroImage): static
    {
        $this->heroImage = $heroImage;
        return $this;
    }

    public function getHeroSubtitle(): ?string
    {
        return $this->heroSubtitle;
    }

    public function setHeroSubtitle(?string $heroSubtitle): static
    {
        $this->heroSubtitle = $heroSubtitle;
        return $this;
    }

    public function getStats(): array
    {
        return $this->stats ?? [];
    }

    public function setStats(?array $stats): static
    {
        $this->stats = $stats;
        return $this;
    }

    public function getTechCategories(): array
    {
        return $this->techCategories ?? [];
    }

    public function setTechCategories(?array $techCategories): static
    {
        $this->techCategories = $techCategories;
        return $this;
    }

    public function getAuditDuration(): ?string
    {
        return $this->auditDuration;
    }

    public function setAuditDuration(?string $auditDuration): static
    {
        $this->auditDuration = $auditDuration;
        return $this;
    }

    public function getStartingPrice(): ?string
    {
        return $this->startingPrice;
    }

    public function setStartingPrice(?string $startingPrice): static
    {
        $this->startingPrice = $startingPrice;
        return $this;
    }

    public function getDeliveryTime(): ?string
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime(?string $deliveryTime): static
    {
        $this->deliveryTime = $deliveryTime;
        return $this;
    }

    public function getHeroTitle(): ?string
    {
        return $this->heroTitle;
    }

    public function setHeroTitle(?string $heroTitle): static
    {
        $this->heroTitle = $heroTitle;
        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): static
    {
        $this->metaDescription = $metaDescription;
        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(?string $metaTitle): static
    {
        $this->metaTitle = $metaTitle;
        return $this;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords(?string $metaKeywords): static
    {
        $this->metaKeywords = $metaKeywords;
        return $this;
    }

    public function getOgImage(): ?string
    {
        return $this->ogImage;
    }

    public function setOgImage(?string $ogImage): static
    {
        $this->ogImage = $ogImage;
        return $this;
    }

    public function getHeroDescription(): ?string
    {
        return $this->heroDescription;
    }

    public function setHeroDescription(?string $heroDescription): static
    {
        $this->heroDescription = $heroDescription;
        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): static
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    public function getCta(): ?array
    {
        return $this->cta;
    }

    public function setCta(?array $cta): static
    {
        $this->cta = $cta;
        return $this;
    }

    public function getAudience(): ?array
    {
        return $this->audience;
    }

    public function setAudience(?array $audience): static
    {
        $this->audience = $audience;
        return $this;
    }

    public function getOutcomes(): ?array
    {
        return $this->outcomes;
    }

    public function setOutcomes(?array $outcomes): static
    {
        $this->outcomes = $outcomes;
        return $this;
    }

    public function getCtaSoft(): ?array
    {
        return $this->ctaSoft;
    }

    public function setCtaSoft(?array $ctaSoft): static
    {
        $this->ctaSoft = $ctaSoft;
        return $this;
    }

    /**
     * @return Collection<int, ServiceSolution>
     */
    public function getSolutions(): Collection
    {
        return $this->solutions;
    }

    public function addSolution(ServiceSolution $solution): static
    {
        if (!$this->solutions->contains($solution)) {
            $this->solutions->add($solution);
            $solution->setService($this);
        }
        return $this;
    }

    public function removeSolution(ServiceSolution $solution): static
    {
        if ($this->solutions->removeElement($solution)) {
            if ($solution->getService() === $this) {
                $solution->setService(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, ServiceProcessStep>
     */
    public function getProcessSteps(): Collection
    {
        return $this->processSteps;
    }

    public function addProcessStep(ServiceProcessStep $processStep): static
    {
        if (!$this->processSteps->contains($processStep)) {
            $this->processSteps->add($processStep);
            $processStep->setService($this);
        }
        return $this;
    }

    public function removeProcessStep(ServiceProcessStep $processStep): static
    {
        if ($this->processSteps->removeElement($processStep)) {
            if ($processStep->getService() === $this) {
                $processStep->setService(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, ServiceFaq>
     */
    public function getFaqs(): Collection
    {
        return $this->faqs;
    }

    public function addFaq(ServiceFaq $faq): static
    {
        if (!$this->faqs->contains($faq)) {
            $this->faqs->add($faq);
            $faq->setService($this);
        }
        return $this;
    }

    public function removeFaq(ServiceFaq $faq): static
    {
        if ($this->faqs->removeElement($faq)) {
            if ($faq->getService() === $this) {
                $faq->setService(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, ServiceTechnology>
     */
    public function getTechnologies(): Collection
    {
        return $this->technologies;
    }

    public function addTechnology(ServiceTechnology $technology): static
    {
        if (!$this->technologies->contains($technology)) {
            $this->technologies->add($technology);
            $technology->setService($this);
        }
        return $this;
    }

    public function removeTechnology(ServiceTechnology $technology): static
    {
        if ($this->technologies->removeElement($technology)) {
            if ($technology->getService() === $this) {
                $technology->setService(null);
            }
        }
        return $this;
    }
}
