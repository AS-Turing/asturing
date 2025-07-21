<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    CONST CLIENTS = [
        1 => [
            'email' => 'j.doe@mail.fr',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'phone' => '0123456789',
            'company' => 'Test Company',
            'tva_number' => '123456789',
            'siret' => '123456789',
            'code_naf' => '123456789',
            'address' => 'Test adresse',
            //            'city' => 'Test city',
            'zipcode' => '123456789',
            'country' => 'Test country',
            'website' => 'http://www.test.fr',
        ],
        2 => [
            'email' => '',
            'firstname' => 'Jane',
            'lastname' => 'Doe',
            'phone' => '0123456789',
            'company' => 'Test Company',
            'tva_number' => '123456789',
            'siret' => '123456789',
            'code_naf' => '123456789',
            'address' => 'Test adresse',
            //            'city' => 'Test city',
            'zipcode' => '123456789',
            'country' => 'Test country',
            'website' => 'http://www.test.fr',
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        $i = 1;
        foreach (self::CLIENTS as $clientData) {
            $client = new Client();
            $client->setEmail($clientData['email']);
            $client->setFirstname($clientData['firstname']);
            $client->setLastname($clientData['lastname']);
            $client->setPhone($clientData['phone']);
            $client->setCompany($clientData['company']);
            $client->setTvaNumber($clientData['tva_number']);
            $client->setSiret($clientData['siret']);
            $client->setCodeNaf($clientData['code_naf']);
            $client->setAddress($clientData['address']);
            $client->setZipCode($clientData['zipcode']);
            $client->setCountry($clientData['country']);
            $client->setWebSite($clientData['website']);
            $manager->persist($client);
            $this->addReference('client-' . $i, $client);
            $i++;
    }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
