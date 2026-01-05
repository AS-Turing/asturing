<?php

namespace App\Entity;

use App\Repository\SpecificationAnswerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecificationAnswerRepository::class)]
#[ORM\Table(name: 'specification_answer')]
class SpecificationAnswer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: SpecificationBook::class, inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SpecificationBook $specificationBook = null;

    #[ORM\ManyToOne(targetEntity: Specification::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Specification $specification = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $answerValue = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSpecification(): ?Specification
    {
        return $this->specification;
    }

    public function setSpecification(?Specification $specification): static
    {
        $this->specification = $specification;
        return $this;
    }

    public function getAnswerValue(): ?string
    {
        return $this->answerValue;
    }

    public function setAnswerValue(?string $answerValue): static
    {
        $this->answerValue = $answerValue;
        return $this;
    }
}
