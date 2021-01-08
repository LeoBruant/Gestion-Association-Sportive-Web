<?php

namespace App\DataFixtures;

use App\Entity\Eleve;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Monolog\Handler\Curl\Util;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Length;

class EleveFixtures extends Fixture implements DependentFixtureInterface
{
	public function getDependencies()
    {
        return array(
			CategorieFixtures::class,
			ClasseFixtures::class,
        );
	}
	
    public function load(ObjectManager $manager)
    {
		for ($i = 0; $i < 10; $i++)
		{
			$genders = [
				'Homme',
				'Femme',
				'Non-binaire',
			];

			$student = new Eleve();

			$category = $this->getReference('category '.rand(0,3));
			$level = $this->getReference('level '.rand(0,7));

			$student
				->setEmail('eleve-'.$i.'@gmail.com')
				->setCategorie($category)
                ->setDateNaissance(new \DateTime(''.rand(1995,2021).'/'.rand(1,12).'/'.rand(1,30)))
                ->setNom('nom-'.($i+1))
                ->setPrenom('prenom-'.($i+1))
				->setClasse($level)
				->setGenre($genders[rand(0,2)])
				->setDateCreation(new \DateTime())
				->setArchivee(0);

			$manager->persist($student);
			$this->addReference('student '.$i, $student);

			dump($student);
		}

		$manager->flush();
	}
}