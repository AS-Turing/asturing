<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @Groups({"file:read", "specification:read"})
     */
    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $uploaded_at = null;

    #[ORM\ManyToOne(inversedBy: 'file')]
    private ?SpecificationBook $specificationBook = null;

    #[ORM\ManyToOne(inversedBy: 'file')]
    private ?Quote $quote = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;

        return $this;
    }

    public function getUploadedAt(): ?\DateTimeImmutable
    {
        return $this->uploaded_at;
    }

    public function setUploadedAt(\DateTimeImmutable $uploaded_at): static
    {
        $this->uploaded_at = $uploaded_at;

        return $this;
    }

    public function getSpecificationBook(): ?SpecificationBook
    {
        return $this->specificationBook;
    }

    public function setSpecificationBook(?SpecificationBook $specificationBook): static
    {
        $this->specificationBook = $specificationBook;

        return $this;
    }

    public function getQuote(): ?Quote
    {
        return $this->quote;
    }

    public function setQuote(?Quote $quote): static
    {
        $this->quote = $quote;

        return $this;
    }
    /**
     * @Groups({"specification:read", "file:read"})
     */
    public function getFileUrl(): ?string
    {
        return '/api/uploads/cdc' . $this->filename;
    }
}
