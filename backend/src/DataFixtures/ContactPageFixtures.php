<?php

namespace App\DataFixtures;

use App\Entity\ContactPage;
use Doctrine\Persistence\ObjectManager;

class ContactPageFixtures
{
    public function load(ObjectManager $manager): void
    {
        $jsonPath = __DIR__ . '/data/contact.json';
        $jsonData = json_decode(file_get_contents($jsonPath), true);
        $data = $jsonData['contact'];

        $contactPage = new ContactPage();
        
        // Hero
        $contactPage->setHeroBadge($data['hero']['badge']);
        $contactPage->setHeroTitle($data['hero']['title']);
        $contactPage->setHeroSubtitle($data['hero']['subtitle']);
        
        // Form
        $contactPage->setFormTitle($data['form']['title']);
        $contactPage->setFormDescription($data['form']['description']);
        $contactPage->setFormPrivacyText($data['form']['privacyText']);
        $contactPage->setFormPrivacyLink($data['form']['privacyLink']);
        $contactPage->setFormSubmitButton($data['form']['submitButton']);
        $contactPage->setFormSubmittingButton($data['form']['submittingButton']);
        $contactPage->setFormSuccessMessage($data['form']['successMessage']);
        $contactPage->setFormErrorMessage($data['form']['errorMessage']);
        
        // Contact Info
        $contactPage->setContactInfo($data['contactInfo']);
        
        // Urgent CTA
        $contactPage->setUrgentCtaTitle($data['urgentCta']['title']);
        $contactPage->setUrgentCtaDescription($data['urgentCta']['description']);
        $contactPage->setUrgentCtaButtonText($data['urgentCta']['buttonText']);
        $contactPage->setUrgentCtaButtonLink($data['urgentCta']['buttonLink']);
        $contactPage->setUrgentCtaButtonIcon($data['urgentCta']['buttonIcon']);
        
        // FAQ
        $contactPage->setFaqTitle($data['faq']['title']);
        $contactPage->setFaqDescription($data['faq']['description']);
        $contactPage->setFaqItems($data['faq']['items']);
        
        // SEO
        $contactPage->setSeoTitle($data['seo']['title']);
        $contactPage->setSeoDescription($data['seo']['description']);

        $manager->persist($contactPage);
        $manager->flush();
    }
}
