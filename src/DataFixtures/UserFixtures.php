<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\User\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
    {
        // $user = new User();
        // $user->setNom("Loto");
        // $user->setPrenom("Lutu");
        // $user->setTelephone("010101");
        // $user->setMail();
        // $user->setCouleur();
        
        // $manager->persist($user);

        $manager->flush();
    }
}

public function getDependencies()
{
    return [
        UserFixtures::class,
    ];
}
};
