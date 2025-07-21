<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $company = null;

    #[ORM\Column(length: 255)]
    private ?string $tva_number = null;

    #[ORM\Column(length: 255)]
    private ?string $siret = null;

    #[ORM\Column(length: 255)]
    private ?string $code_naf = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $zip_code = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $web_site = null;

    /**
     * @var Collection<int, Quote>
     */
    #[ORM\OneToMany(targetEntity: Quote::class, mappedBy: 'client')]
    private Collection $quotes;

    /**
     * @var Collection<int, SpecificationBook>
     */
    #[ORM\OneToMany(targetEntity: SpecificationBook::class, mappedBy: 'client')]
    private Collection $specificationBooks;

    public function __construct()
    {
        $this->quotes = new ArrayCollection();
        $this->specificationBooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getTvaNumber(): ?string
    {
        return $this->tva_number;
    }

    public function setTvaNumber(string $tva_number): static
    {
        $this->tva_number = $tva_number;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): static
    {
        $this->siret = $siret;

        return $this;
    }

    public function getCodeNaf(): ?string
    {
        return $this->code_naf;
    }

    public function setCodeNaf(string $code_naf): static
    {
        $this->code_naf = $code_naf;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }

    public function setZipCode(string $zip_code): static
    {
        $this->zip_code = $zip_code;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getWebSite(): ?string
    {
        return $this->web_site;
    }

    public function setWebSite(string $web_site): static
    {
        $this->web_site = $web_site;

        return $this;
    }

    /**
     * @return Collection<int, Quote>
     */
    public function getQuotes(): Collection
    {
        return $this->quotes;
    }

    public function addQuote(Quote $quote): static
    {
        if (!$this->quotes->contains($quote)) {
            $this->quotes->add($quote);
            $quote->setClient($this);
        }

        return $this;
    }

    public function removeQuote(Quote $quote): static
    {
        if ($this->quotes->removeElement($quote)) {
            // set the owning side to null (unless already changed)
            if ($quote->getClient() === $this) {
                $quote->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SpecificationBook>
     */
    public function getSpecificationBooks(): Collection
    {
        return $this->specificationBooks;
    }

    public function addSpecificationBook(SpecificationBook $specificationBook): static
    {
        if (!$this->specificationBooks->contains($specificationBook)) {
            $this->specificationBooks->add($specificationBook);
            $specificationBook->setClient($this);
        }

        return $this;
    }

    public function removeSpecificationBook(SpecificationBook $specificationBook): static
    {
        if ($this->specificationBooks->removeElement($specificationBook)) {
            // set the owning side to null (unless already changed)
            if ($specificationBook->getClient() === $this) {
                $specificationBook->setClient(null);
            }
        }

        return $this;
    }
}
