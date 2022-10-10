<?php

namespace App\DataFixtures;

use App\Entity\Cours;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CoursFixtures extends Fixture
{
    public const JAVASCRIPT = 'javascript';
    public const HTML = 'html';
    public const CSS = 'css';
    public const PHP = 'php';
    public const BOOTSTRAP = 'bootstrap';

    public function load(ObjectManager $manager): void
    {
        $cours = new Cours();
        $cours -> setModule('Javascript');
        $manager->persist($cours);
        $this->addReference(self::JAVASCRIPT, $cours);

        $cours = new Cours();
        $cours -> setModule('Html');
        $manager->persist($cours);
        $this->addReference(self::HTML, $cours);

        $cours = new Cours();
        $cours -> setModule('Css');
        $manager->persist($cours);
        $this->addReference(self::CSS, $cours);

        $cours = new Cours();
        $cours -> setModule('Php');
        $manager->persist($cours);
        $this->addReference(self::PHP, $cours);

        $cours = new Cours();
        $cours -> setModule('Bootstrap');
        $manager->persist($cours);
        $this->addReference(self::BOOTSTRAP, $cours);

        $manager->flush();
    }
}
