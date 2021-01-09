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
		$categories = [
			'Junior homme',
			'Cadet',
			'Junior femme',
			'Cadette',
		];

		for ($i = 0; $i < (count($categories)); $i++){
			
			$category = new Categorie();

			$category
				->setLibelle($categories[$i]);

			$manager->persist($category);
			$this->addReference('category '.$i, $category);
		}

		$manager->flush();
	}
}