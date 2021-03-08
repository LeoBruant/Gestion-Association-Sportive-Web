<?php

namespace App\DataFixtures;


use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $types = [
            'Handi-sport',
            'Multi-sport',
            'Compétition',
            'Découverte',

        ];
        for ($i = 0; $i < (count($types)); $i++){

            $type = new Type();

            $type
                ->setNom($types[$i]);

            $manager->persist($type);
            $this->addReference('type '.$i, $type);
        }

        $manager->flush();
    }
}