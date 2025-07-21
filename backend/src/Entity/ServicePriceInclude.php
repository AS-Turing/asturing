<?php

namespace App\Entity;

use App\Repository\ServicePriceIncludeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicePriceIncludeRepository::class)]
class ServicePriceInclude
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'servicePriceInclude')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ServicePrice $service_price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServicePriceId(): ?ServicePrice
    {
        return $this->service_price;
    }

    public function setServicePriceId(?ServicePrice $service_price): static
    {
        $this->service_price = $service_price;

        return $this;
    }
}
