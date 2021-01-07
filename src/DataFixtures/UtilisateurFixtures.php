<?php


namespace App\DataFixtures;

use App\Entity\Eleve;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Monolog\Handler\Curl\Util;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
	}
	
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {

			// Eleve

			$student = new Eleve();

			$student
				->setEmail('eleve-'.$i.'@gmail.com')
				->setCategorieId(rand(0,3))
                ->setDateNaissance(new \DateTime(''.rand(1995,2021).'/'.rand(1,12).'/'.rand(1,30)))
                ->setNom('nom-'.($i+1))
                ->setPrenom('prenom'.$i)
				->setClasse('classe'.rand(1,5));

			$manager->persist($student);
			$manager->flush();

			// Utilisateur

            $utilisateur = new Utilisateur();
			$password = '123456';
			
			$isStudent = rand(0,1);

			$studentId = NULL;

			if($isStudent == 1){
				$studentId = $student->GetId();
			}

			$utilisateur
				->setEleve($studentId)
                ->setEmail('user-'.$i.'@gmail.com')
				->setPassword($this->encoder->encodePassword($utilisateur, $password));

			$manager->persist($utilisateur);
			$manager->flush();
        }
    }
}