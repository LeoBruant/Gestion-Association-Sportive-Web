<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Monolog\Handler\Curl\Util;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Length;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		// Classes

		$levels = [
			'labels' => [
				'Seconde',
				'Première',
				'Terminale',
				'BTS-1',
				'BTS-2',
				'Licence',
				'Master 1',
				'Master 2',
			],

			'values' => [],
		];

		for ($i = 0; $i < (count($levels['labels'])); $i++){
			
			$level = new Classe();

			$level
				->setNom($levels['labels'][$i]);

			$levels['values'][] = $level;

			$manager->persist($level);
		}

		$manager->flush();
	}
}