<?php

namespace App\DataFixtures;

use App\Entity\Promo;
use App\DataFixtures\CoursFixtures;
use App\DataFixtures\CentreFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PromoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $promo = new Promo();
        $promo -> setNom('DWWM');
        $promo -> setCentre($this->getReference(CentreFixtures::NEXT));
        $promo -> addCour($this->getReference(CoursFixtures::JAVASCRIPT));
        $promo -> addCour($this->getReference(CoursFixtures::HTML));
        $manager->persist($promo);

        $promo = new Promo();
        $promo -> setNom('DTTE');
        $promo -> setCentre($this->getReference(CentreFixtures::ASTON));
        $promo -> addCour($this->getReference(CoursFixtures::PHP));
        $promo -> addCour($this->getReference(CoursFixtures::BOOTSTRAP));
        $manager->persist($promo);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CentreFixtures::class,
            CoursFixtures::class,
        ];
    }
}
