<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('alexandre@as-turing.fr');
        $user->setFirstName('Alexandre');
        $user->setLastName('Salé');
        $user->setCreatedAt(new \DateTimeImmutable('now'));
        $user->setUpdatedAt(new \DateTimeImmutable('now'));
        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$TTdDdHFBVlFDWUlYOWtWNg$tWqWT78fMcvqfrHXULz3S9ldUIzye2axX7P50fFsyf0');
        $user->setFingerprint('a5e27be0cbdaf64c132b6088da22549c');
        $user->setRequiresValidation(false);
        $manager->persist($user);

        $manager->flush();
    }
}
