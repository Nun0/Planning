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
    public const DWWM = 'dwwm';
    public const DTTE = 'dtte';

    public function load(ObjectManager $manager): void
    {
        $promo = new Promo();
        $promo -> setNom('DWWM');
        $promo -> addCour($this->getReference(CoursFixtures::JAVASCRIPT));
        $promo -> addCour($this->getReference(CoursFixtures::HTML));
        $promo -> addCour($this->getReference(CoursFixtures::CSS));
        $manager->persist($promo);
        $this->addReference(self::DWWM, $promo);


        $promo = new Promo();
        $promo -> setNom('DTTE');
        $promo -> addCour($this->getReference(CoursFixtures::PHP));
        $promo -> addCour($this->getReference(CoursFixtures::BOOTSTRAP));
        $manager->persist($promo);
        $this->addReference(self::DTTE, $promo);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CoursFixtures::class,
        ];
    }
}
