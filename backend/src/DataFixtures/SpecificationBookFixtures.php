<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\SpecificationBook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SpecificationBookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $specificationBook = new SpecificationBook();
        $specificationBook->setDescription('Lorem ipsum dolor sit amet');
        $specificationBook->setCreatedAt(new \DateTimeImmutable());
        $specificationBook->setClient($this->getReference('client-1', Client::class));
        $manager->persist($specificationBook);
        $this->addReference('specification-book-' . 1, $specificationBook);

        $specificationBook = new SpecificationBook();
        $specificationBook->setDescription('Lorem ipsum dolor sit amet');
        $specificationBook->setCreatedAt(new \DateTimeImmutable());
        $specificationBook->setClient($this->getReference('client-2', Client::class));
        $manager->persist($specificationBook);
        $this->addReference('specification-book-' . 2, $specificationBook);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ClientFixtures::class,
        ];
    }
}
