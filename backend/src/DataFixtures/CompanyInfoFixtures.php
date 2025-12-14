<?php

namespace App\DataFixtures;

use App\Entity\CompanyInfo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompanyInfoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $companyInfo = new CompanyInfo();
        $companyInfo->setCompanyName('AS-Turing');
        $companyInfo->setTagline('Agence digitale spécialisée dans la création de solutions web');
        $companyInfo->setDescription('Agence digitale spécialisée dans la création de solutions web innovantes et performantes.');
        $companyInfo->setPhone('07 83 07 00 52');
        $companyInfo->setEmail('contact@as-turing.fr');
        $companyInfo->setAddress('Place Abel Surchamp');
        $companyInfo->setCity('Libourne');
        $companyInfo->setZipCode('33500');
        $companyInfo->setRegion('Nouvelle-Aquitaine');
        $companyInfo->setCountry('France');
        $companyInfo->setSocialNetworks([
            'github' => 'https://github.com/as-turing',
            'linkedin' => 'https://linkedin.com/company/as-turing',
            'twitter' => null,
            'facebook' => 'https://www.facebook.com/people/AS-Turing/61580387595689/',
        ]);
        $companyInfo->setLogoPath('/images/logo2.png');
        $companyInfo->setSiret('97897758500014');
        $companyInfo->setTva('FR38978977585');
        $companyInfo->setBusinessHours([
            'monday' => ['open' => '08:00', 'close' => '18:30'],
            'tuesday' => ['open' => '08:00', 'close' => '18:30'],
            'wednesday' => ['open' => '08:00', 'close' => '18:30'],
            'thursday' => ['open' => '08:00', 'close' => '18:30'],
            'friday' => ['open' => '08:00', 'close' => '18:30'],
            'saturday' => ['open' => '08:00', 'close' => '12:00'],
            'sunday' => null,
        ]);

        $manager->persist($companyInfo);
        $manager->flush();
    }
}
