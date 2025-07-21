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
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $og_title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $og_description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $og_url = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $map = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

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

    public function getOgTitle(): ?string
    {
        return $this->og_title;
    }

    public function setOgTitle(string $og_title): static
    {
        $this->og_title = $og_title;

        return $this;
    }

    public function getOgDescription(): ?string
    {
        return $this->og_description;
    }

    public function setOgDescription(string $og_description): static
    {
        $this->og_description = $og_description;

        return $this;
    }

    public function getOgUrl(): ?string
    {
        return $this->og_url;
    }

    public function setOgUrl(string $og_url): static
    {
        $this->og_url = $og_url;

        return $this;
    }

    public function getMap(): ?string
    {
        return $this->map;
    }

    public function setMap(string $map): static
    {
        $this->map = $map;

        return $this;
    }
}
