<?php

namespace App\DataFixtures;

use App\Entity\Eleve;
use App\Entity\Utilisateur;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Monolog\Handler\Curl\Util;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Length;

class UtilisateurFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
	}
	
    public function load(ObjectManager $manager)
    {
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
				->setCategorieId(rand(0,3))
                ->setDateNaissance(new \DateTime(''.rand(1995,2021).'/'.rand(1,12).'/'.rand(1,30)))
                ->setNom('nom-'.($i+1))
                ->setPrenom('prenom '.($i+1))
				->setClasseId(rand(0,7))
				->setGenre($genders[rand(0,2)])
				->setDateCreation(new \DateTime())
				->setArchivee(0);

			$manager->persist($student);

			// Utilisateurs

            $utilisateur = new Utilisateur();
			$password = '123456';
			
			$isStudent = rand(0,1);

			$studentId = NULL;

			if($isStudent == 1){
				$studentId = $student->GetId();
			}

			$utilisateur
				->setEleveId($studentId)
                ->setEmail('user-'.$i.'@gmail.com')
				->setPassword($this->encoder->encodePassword($utilisateur, $password));

			$manager->persist($utilisateur);
		}
		
		$manager->flush();
    }
}