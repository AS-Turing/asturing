<?php

namespace App\Entity;

use App\Repository\ContactPageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactPageRepository::class)]
class ContactPage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $heroBadge = null;

    #[ORM\Column(length: 255)]
    private ?string $heroTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $heroSubtitle = null;

    #[ORM\Column(length: 255)]
    private ?string $formTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $formDescription = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $formPrivacyText = null;

    #[ORM\Column(length: 255)]
    private ?string $formPrivacyLink = null;

    #[ORM\Column(length: 255)]
    private ?string $formSubmitButton = null;

    #[ORM\Column(length: 255)]
    private ?string $formSubmittingButton = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $formSuccessMessage = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $formErrorMessage = null;

    #[ORM\Column(type: Types::JSON)]
    private array $contactInfo = [];

    #[ORM\Column(length: 255)]
    private ?string $urgentCtaTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $urgentCtaDescription = null;

    #[ORM\Column(length: 255)]
    private ?string $urgentCtaButtonText = null;

    #[ORM\Column(length: 255)]
    private ?string $urgentCtaButtonLink = null;

    #[ORM\Column(length: 100)]
    private ?string $urgentCtaButtonIcon = null;

    #[ORM\Column(length: 255)]
    private ?string $faqTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $faqDescription = null;

    #[ORM\Column(type: Types::JSON)]
    private array $faqItems = [];

    #[ORM\Column(length: 255)]
    private ?string $seoTitle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $seoDescription = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeroBadge(): ?string
    {
        return $this->heroBadge;
    }

    public function setHeroBadge(string $heroBadge): static
    {
        $this->heroBadge = $heroBadge;
        return $this;
    }

    public function getHeroTitle(): ?string
    {
        return $this->heroTitle;
    }

    public function setHeroTitle(string $heroTitle): static
    {
        $this->heroTitle = $heroTitle;
        return $this;
    }

    public function getHeroSubtitle(): ?string
    {
        return $this->heroSubtitle;
    }

    public function setHeroSubtitle(string $heroSubtitle): static
    {
        $this->heroSubtitle = $heroSubtitle;
        return $this;
    }

    public function getFormTitle(): ?string
    {
        return $this->formTitle;
    }

    public function setFormTitle(string $formTitle): static
    {
        $this->formTitle = $formTitle;
        return $this;
    }

    public function getFormDescription(): ?string
    {
        return $this->formDescription;
    }

    public function setFormDescription(string $formDescription): static
    {
        $this->formDescription = $formDescription;
        return $this;
    }

    public function getFormPrivacyText(): ?string
    {
        return $this->formPrivacyText;
    }

    public function setFormPrivacyText(string $formPrivacyText): static
    {
        $this->formPrivacyText = $formPrivacyText;
        return $this;
    }

    public function getFormPrivacyLink(): ?string
    {
        return $this->formPrivacyLink;
    }

    public function setFormPrivacyLink(string $formPrivacyLink): static
    {
        $this->formPrivacyLink = $formPrivacyLink;
        return $this;
    }

    public function getFormSubmitButton(): ?string
    {
        return $this->formSubmitButton;
    }

    public function setFormSubmitButton(string $formSubmitButton): static
    {
        $this->formSubmitButton = $formSubmitButton;
        return $this;
    }

    public function getFormSubmittingButton(): ?string
    {
        return $this->formSubmittingButton;
    }

    public function setFormSubmittingButton(string $formSubmittingButton): static
    {
        $this->formSubmittingButton = $formSubmittingButton;
        return $this;
    }

    public function getFormSuccessMessage(): ?string
    {
        return $this->formSuccessMessage;
    }

    public function setFormSuccessMessage(string $formSuccessMessage): static
    {
        $this->formSuccessMessage = $formSuccessMessage;
        return $this;
    }

    public function getFormErrorMessage(): ?string
    {
        return $this->formErrorMessage;
    }

    public function setFormErrorMessage(string $formErrorMessage): static
    {
        $this->formErrorMessage = $formErrorMessage;
        return $this;
    }

    public function getContactInfo(): array
    {
        return $this->contactInfo;
    }

    public function setContactInfo(array $contactInfo): static
    {
        $this->contactInfo = $contactInfo;
        return $this;
    }

    public function getUrgentCtaTitle(): ?string
    {
        return $this->urgentCtaTitle;
    }

    public function setUrgentCtaTitle(string $urgentCtaTitle): static
    {
        $this->urgentCtaTitle = $urgentCtaTitle;
        return $this;
    }

    public function getUrgentCtaDescription(): ?string
    {
        return $this->urgentCtaDescription;
    }

    public function setUrgentCtaDescription(string $urgentCtaDescription): static
    {
        $this->urgentCtaDescription = $urgentCtaDescription;
        return $this;
    }

    public function getUrgentCtaButtonText(): ?string
    {
        return $this->urgentCtaButtonText;
    }

    public function setUrgentCtaButtonText(string $urgentCtaButtonText): static
    {
        $this->urgentCtaButtonText = $urgentCtaButtonText;
        return $this;
    }

    public function getUrgentCtaButtonLink(): ?string
    {
        return $this->urgentCtaButtonLink;
    }

    public function setUrgentCtaButtonLink(string $urgentCtaButtonLink): static
    {
        $this->urgentCtaButtonLink = $urgentCtaButtonLink;
        return $this;
    }

    public function getUrgentCtaButtonIcon(): ?string
    {
        return $this->urgentCtaButtonIcon;
    }

    public function setUrgentCtaButtonIcon(string $urgentCtaButtonIcon): static
    {
        $this->urgentCtaButtonIcon = $urgentCtaButtonIcon;
        return $this;
    }

    public function getFaqTitle(): ?string
    {
        return $this->faqTitle;
    }

    public function setFaqTitle(string $faqTitle): static
    {
        $this->faqTitle = $faqTitle;
        return $this;
    }

    public function getFaqDescription(): ?string
    {
        return $this->faqDescription;
    }

    public function setFaqDescription(string $faqDescription): static
    {
        $this->faqDescription = $faqDescription;
        return $this;
    }

    public function getFaqItems(): array
    {
        return $this->faqItems;
    }

    public function setFaqItems(array $faqItems): static
    {
        $this->faqItems = $faqItems;
        return $this;
    }

    public function getSeoTitle(): ?string
    {
        return $this->seoTitle;
    }

    public function setSeoTitle(string $seoTitle): static
    {
        $this->seoTitle = $seoTitle;
        return $this;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seoDescription;
    }

    public function setSeoDescription(string $seoDescription): static
    {
        $this->seoDescription = $seoDescription;
        return $this;
    }
}
