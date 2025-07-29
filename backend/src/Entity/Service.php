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
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?array $microServices = null;

    /**
     * @var Collection<int, Faq>
     */
    #[ORM\OneToMany(targetEntity: Faq::class, mappedBy: 'service')]
    private Collection $faqs;

    #[ORM\OneToMany(targetEntity: Price::class, mappedBy: 'service')]
    private Collection $prices;
    #[ORM\OneToOne(mappedBy: 'service', cascade: ['persist', 'remove'])]
    private ?Seo $seo = null;

    public function __construct()
    {
        $this->prices = new ArrayCollection();
        $this->faqs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getMicroServices(): ?array
    {
        return $this->microServices;
    }

    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function setPrices(Collection $prices): void
    {
        $this->prices = $prices;
    }

    public function setMicroServices(?array $microServices): static
    {
        $this->microServices = $microServices;

        return $this;
    }

    /**
     * @return Collection<int, Faq>
     */
    public function getFaqs(): Collection
    {
        return $this->faqs;
    }

    public function addFaq(Faq $faq): static
    {
        if (!$this->faqs->contains($faq)) {
            $this->faqs->add($faq);
            $faq->setService($this);
        }

        return $this;
    }

    public function removeFaq(Faq $faq): static
    {
        if ($this->faqs->removeElement($faq)) {
            // set the owning side to null (unless already changed)
            if ($faq->getService() === $this) {
                $faq->setService(null);
            }
        }

        return $this;
    }

    public function getSeo(): ?Seo
    {
        return $this->seo;
    }

    public function setSeo(Seo $seo): static
    {
        // set the owning side of the relation if necessary
        if ($seo->getService() !== $this) {
            $seo->setService($this);
        }

        $this->seo = $seo;

        return $this;
    }
}
