<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Monolog\Handler\Curl\Util;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Length;

class CategorieFixtures extends Fixture
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

		$manager->flush();
	}
}