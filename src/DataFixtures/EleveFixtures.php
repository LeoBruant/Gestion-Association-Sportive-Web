<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Classe;
use App\Entity\Eleve;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Monolog\Handler\Curl\Util;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Length;

class EleveFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
		// Catégories

		$categories = [
			'labels' => [
				'Cadet',
				'Cadette',
				'Junior homme',
				'Junior femme',
			],

			'values' => [],
		];

		for ($i = 0; $i < (count($categories['labels'])); $i++){
			
			$category = new Categorie();

			$category
				->setLibelle($categories['labels'][$i]);

			$categories['values'][] = $category;

			$manager->persist($category);
		}

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

        for ($i = 0; $i < 10; $i++){

			// Eleves

			$genders = [
				'Homme',
				'Femme',
				'Non-binaire',
			];

			$student = new Eleve();

			$student
				->setEmail('eleve '.$i.'@gmail.com')
				->setCategorie($categories['values'][rand(0,3)])
                ->setDateNaissance(new \DateTime(''.rand(1995,2021).'/'.rand(1,12).'/'.rand(1,30)))
                ->setNom('nom-'.($i+1))
                ->setPrenom('prenom '.($i+1))
				->setClasse($levels['values'][rand(0,7)])
				->setGenre($genders[rand(0,2)])
				->setDateCreation(new \DateTime())
				->setArchivee(0);

			$manager->persist($student);
		}
	}
}