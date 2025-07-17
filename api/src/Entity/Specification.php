<?php

namespace App\Entity;

use App\Repository\SpecificationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecificationRepository::class)]
class Specification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $placeholder = null;

    #[ORM\Column]
    private ?bool $required = null;

    #[ORM\Column(length: 255)]
    private ?string $pattern = null;

    #[ORM\Column(nullable: true)]
    private ?int $min = null;

    #[ORM\Column(nullable: true)]
    private ?int $max = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $error_message = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $tooltip = null;

    #[ORM\Column]
    private ?int $display_order = null;

    #[ORM\Column(nullable: true)]
    private ?array $type_options = null;

    #[ORM\ManyToOne(inversedBy: 'Specification')]
    private ?Cateogry $cateogry = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    public function setPlaceholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function isRequired(): ?bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): static
    {
        $this->required = $required;

        return $this;
    }

    public function getPattern(): ?string
    {
        return $this->pattern;
    }

    public function setPattern(string $pattern): static
    {
        $this->pattern = $pattern;

        return $this;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(?int $min): static
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(?int $max): static
    {
        $this->max = $max;

        return $this;
    }

    public function getErrorMessage(): ?string
    {
        return $this->error_message;
    }

    public function setErrorMessage(string $error_message): static
    {
        $this->error_message = $error_message;

        return $this;
    }

    public function getTooltip(): ?string
    {
        return $this->tooltip;
    }

    public function setTooltip(?string $tooltip): static
    {
        $this->tooltip = $tooltip;

        return $this;
    }

    public function getDisplayOrder(): ?int
    {
        return $this->display_order;
    }

    public function setDisplayOrder(int $display_order): static
    {
        $this->display_order = $display_order;

        return $this;
    }

    public function getTypeOptions(): ?array
    {
        return $this->type_options;
    }

    public function setTypeOptions(?array $type_options): static
    {
        $this->type_options = $type_options;

        return $this;
    }

    public function getCateogry(): ?Cateogry
    {
        return $this->cateogry;
    }

    public function setCateogry(?Cateogry $cateogry): static
    {
        $this->cateogry = $cateogry;

        return $this;
    }
}
