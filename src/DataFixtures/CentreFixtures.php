<?php

namespace App\DataFixtures;

use App\Entity\Centre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CentreFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $centre = new Centre();
        $centre->setNom('Nextformation');
        $centre->setAdresse('9 Av. de Paris');
        $centre->setCodePostal('94300 VINCENNES');
        $centre->setMail('paslevrai@mail.com');
        $centre->setTelephone('01 42 03 77 00');
        $centre->setResponsable('Daramony Tek');
        $centre->setHoraire('9H00 – 13H00');
        $centre->setHoraireApresMidi('14H00 – 17H00');
        $centre->setCouleur('#616161');
        $centre->addPromo($this->getReference(PromoFixtures::DWWM));
        $manager->persist($centre);

        $centre = new Centre();
        $centre->setNom('Aston');
        $centre->setAdresse('19-21 rue du 8 mai 1945');
        $centre->setCodePostal('94110 ARCEUIL');
        $centre->setMail('paslevrai@mail.com');
        $centre->setTelephone('01 45 36 15 20');
        $centre->setResponsable('Alain Bastardie');
        $centre->setHoraire('9H30 – 13H00');
        $centre->setHoraireApresMidi('14H00 – 17H30');
        $centre->setCouleur('#ffdd11');
        $centre->addPromo($this->getReference(PromoFixtures::DTTE));
        $manager->persist($centre);

        $centre = new Centre();
        $centre->setNom('Greta Massy');
        $centre->setAdresse('80 Rue de Versailles');
        $centre->setCodePostal('91300 MASSY');
        $centre->setMail('paslevrai@mail.com');
        $centre->setTelephone('01 69 53 74 75');
        $centre->setResponsable('Adeline Varin');
        $centre->setHoraire('9H00 – 12H00');
        $centre->setHoraireApresMidi('13H00 – 17H00');
        $centre->setCouleur('#ffaa22');
        $manager->persist($centre);

        $centre = new Centre();
        $centre->setNom('ILCI');
        $centre->setAdresse('4 rue Véronèse');
        $centre->setCodePostal('75013 PARIS');
        $centre->setMail('paslevrai@mail.com');
        $centre->setTelephone('01 45 87 16 35');
        $centre->setResponsable('Accueil');
        $centre->setHoraire('9H00 – 13H00');
        $centre->setHoraireApresMidi('14H00 – 18H00');
        $centre->setCouleur('#aacc88');
        $manager->persist($centre);

        $centre = new Centre();
        $centre->setNom('CESI Nanterre');
        $centre->setAdresse('93 BD de la Seine');
        $centre->setCodePostal('92000 NANTERRE');
        $centre->setMail('paslevrai@mail.com');
        $centre->setTelephone('01 55 17 80 00');
        $centre->setResponsable('Accueil');
        $centre->setHoraire('8H30 – 12H00');
        $centre->setHoraireApresMidi('13H00 – 16H30');
        $centre->setCouleur('#ff6622');
        $manager->persist($centre);

        $centre = new Centre();
        $centre->setNom('Nom du centr');
        $centre->setAdresse('100 Rue de Paris');
        $centre->setCodePostal('75012 PARIS');
        $centre->setMail('paslevrai@mail.com');
        $centre->setTelephone('01 02 03 04 05');
        $centre->setResponsable('Nom Responsable');
        $centre->setHoraire('9H00 – 12H00');
        $centre->setHoraireApresMidi('13H00 – 17H00');
        $centre->setCouleur('#ffaa22');
        $manager->persist($centre);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PromoFixtures::class,
        ];
    }
}
