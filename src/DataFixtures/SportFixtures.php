<?php

namespace App\DataFixtures;

use App\Entity\Sport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SportFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $sports = [
            'Football',
            'Rugby',
            'Badminton',
            'Basketball',
            'Tennis de table',
            'Handball',
            'Step',
            "Course d'orientation",
        ];
        for ($i = 0; $i < (count($sports)); $i++){

            $sport = new Sport();

            $sport
                ->setNom($sports[$i]);

            $manager->persist($sport);
            $this->addReference('sport '.$i, $sport);
        }

        $manager->flush();
    }
}