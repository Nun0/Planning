<?php

namespace App\DataFixtures;

use App\Entity\Centre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CentreFixtures extends Fixture
{
    public const NEXT = 'nextformation';

    public function load(ObjectManager $manager): void
    {
        $centre = new Centre();
        $centre->setNom('Nextformation');
        $centre->setAdresse('Nextformation - adresse');
        $centre->setCodePostal('Nextformation - codepostal');
        $centre->setMail('Nextformation - mail');
        $centre->setTelephone('Nextformation - telephone');
        $centre->setResponsable('Nextformation - respondable');
        $centre->setHoraire('9:00 - 12:00');
        $centre->setHoraireApresMidi('13:00 - 14:00');
        $centre->setCouleur('Nextformation - couleur');
        $manager->persist($centre);
        $this->addReference(self::NEXT, $centre);

        $manager->flush();
    }
}
