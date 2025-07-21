<?php

namespace App\Entity;

use App\Repository\ServicePriceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicePriceRepository::class)]
class ServicePrice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'servicePrices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $service = null;
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    /**
     * @var Collection<int, ServicePriceInclude>
     */
    #[ORM\OneToMany(targetEntity: ServicePriceInclude::class, mappedBy: 'service_price')]
    private Collection $servicePriceInclude;

    public function __construct()
    {
        $this->servicePriceInclude = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, ServicePriceInclude>
     */
    public function getServicePriceInclude(): Collection
    {
        return $this->servicePriceInclude;
    }

    public function addServicePriceInclude(ServicePriceInclude $servicePriceInclude): static
    {
        if (!$this->servicePriceInclude->contains($servicePriceInclude)) {
            $this->servicePriceInclude->add($servicePriceInclude);
            $servicePriceInclude->setServicePriceId($this);
        }

        return $this;
    }

    public function removeServicePriceInclude(ServicePriceInclude $servicePriceInclude): static
    {
        if ($this->servicePriceInclude->removeElement($servicePriceInclude)) {
            // set the owning side to null (unless already changed)
            if ($servicePriceInclude->getServicePriceId() === $this) {
                $servicePriceInclude->setServicePriceId(null);
            }
        }

        return $this;
    }
}
