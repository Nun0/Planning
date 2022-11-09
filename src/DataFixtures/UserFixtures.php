<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface

{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->encoder = $userPasswordHasherInterface;
    }
    
    public function load(ObjectManager $manager): void
    {
    {
        $user = new User();
        $user->setNom("Loto");
        $user->setPrenom("Lutu");
        $user->setTelephone("010101");
        $user->setEmail("lulu@gmail.com");
        $user->setCouleur("#ff6622");
        $user->setRoles(["ROLE_USER"]);
        $user->setPlainPassword('password');
        $user->setPassword($this->encoder->hashPassword($user, 'password'));
        $manager->persist($user);
        
        $user = new User();
        $user->setNom("Toto");
        $user->setPrenom("Titi");
        $user->setTelephone("010101");
        $user->setEmail("toto@gmail.com");
        $user->setCouleur("#9B9797");
        $user->setRoles(["ROLE_USER"]);
        $user->setPlainPassword('password');
        $user->setPassword($this->encoder->hashPassword($user, 'password'));
        $manager->persist($user);

        $user = new User();
        $user->setNom("Tutu");
        $user->setPrenom("Lili");
        $user->setTelephone("010101");
        $user->setEmail("Tutu@gmail.com");
        $user->setCouleur("#ffdd11");
        $user->setRoles(["ROLE_USER"]);
        $user->setPlainPassword('password');
        $user->setPassword($this->encoder->hashPassword($user, 'password'));
        $manager->persist($user);

        $user = new User();
        $user->setNom("Admin");
        $user->setPrenom("Example");
        $user->setTelephone("010101");
        $user->setEmail("admin@gmail.com");
        $user->setCouleur("#ffaa22");
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $user->setPlainPassword('password');
        $user->setPassword($this->encoder->hashPassword($user, 'password'));
        $manager->persist($user);

        $user = new User();
        $user->setNom("Stempert");
        $user->setPrenom("Pauline");
        $user->setTelephone("010101");
        $user->setEmail("pauline.stempert@groupe-sr3.com");
        $user->setCouleur("#ff24d7");
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $user->setPlainPassword('password');
        $user->setPassword($this->encoder->hashPassword($user, 'password'));
        $manager->persist($user);

        $user = new User();
        $user->setNom("Vanbavinckhove");
        $user->setPrenom("Remy");
        $user->setTelephone("010101");
        $user->setEmail("remy.vanbavinckhove@groupe-sr3.com");
        $user->setCouleur("#3d4aff");
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $user->setPlainPassword('Sr3001');
        $user->setPassword($this->encoder->hashPassword($user, 'Sr3001'));
        $manager->persist($user);
        
        $user = new User();
        $user->setNom("Borka");
        $user->setPrenom("Marlene");
        $user->setTelephone("010101");
        $user->setEmail("marlene.borka@groupe-sr3.com");
        $user->setCouleur("#fff71a");
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $user->setPlainPassword('Sr3002');
        $user->setPassword($this->encoder->hashPassword($user, 'Sr3002'));
        $manager->persist($user);

        $user = new User();
        $user->setNom("Singh");
        $user->setPrenom("Mathias");
        $user->setTelephone("010101");
        $user->setEmail("mathias.singh@groupe-sr3.com");
        $user->setCouleur("#ff0000");
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $user->setPlainPassword('Sr3003');
        $user->setPassword($this->encoder->hashPassword($user, 'Sr3003'));
        $manager->persist($user);

        $manager->flush();
    }
}
public static function getGroups(): array
    {
        return ['group1'];
    }
}

