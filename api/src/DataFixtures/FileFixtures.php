<?php

namespace App\DataFixtures;

use App\Entity\File;
use App\Entity\SpecificationBook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FileFixtures extends Fixture implements DependentFixtureInterface
{
    CONST FILES = [
        1 => [
            'specification_book_id' => 1,
            'filename' => 'cahier-des-charges-08-07-2025.pdf',
            'upload_at' => '2020-07-20',
        ],
        2 => [
            'specification_book_id' => 2,
            'filename' => 'cahier-des-charges-08-2025.pdf',
            'upload_at' => '2020-08-20',
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::FILES as $fileData) {
            $file = new File();
            $file->setFilename($fileData['filename']);
            $file->setSpecificationBook($this->getReference('specification-book-' .
                $fileData['specification_book_id'], SpecificationBook::class));
            $file->setUploadedAt(
                new \DateTimeImmutable($fileData['upload_at'])
            );
            $manager->persist($file);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SpecificationBookFixtures::class,
        ];
    }
}
