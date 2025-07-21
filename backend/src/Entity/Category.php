<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Specification>
     */
    #[ORM\OneToMany(targetEntity: Specification::class, mappedBy: 'category')]
    private Collection $Specification;

    public function __construct()
    {
        $this->Specification = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Specification>
     */
    public function getSpecification(): Collection
    {
        return $this->Specification;
    }

    public function addSpecification(Specification $specification): static
    {
        if (!$this->Specification->contains($specification)) {
            $this->Specification->add($specification);
            $specification->setCategory($this);
        }

        return $this;
    }

    public function removeSpecification(Specification $specification): static
    {
        if ($this->Specification->removeElement($specification)) {
            // set the owning side to null (unless already changed)
            if ($specification->getCategory() === $this) {
                $specification->setCategory(null);
            }
        }

        return $this;
    }
}
