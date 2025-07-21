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

    /**
     * @var Collection<int, MicroService>
     */
    #[ORM\OneToMany(targetEntity: MicroService::class, mappedBy: 'service')]
    private Collection $micro_service;

    public function __construct()
    {
        $this->micro_service = new ArrayCollection();
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

    /**
     * @return Collection<int, MicroService>
     */
    public function getMicroService(): Collection
    {
        return $this->micro_service;
    }

    public function addMicroService(MicroService $microService): static
    {
        if (!$this->micro_service->contains($microService)) {
            $this->micro_service->add($microService);
            $microService->setService($this);
        }

        return $this;
    }

    public function removeMicroService(MicroService $microService): static
    {
        if ($this->micro_service->removeElement($microService)) {
            // set the owning side to null (unless already changed)
            if ($microService->getService() === $this) {
                $microService->setService(null);
            }
        }

        return $this;
    }
}
