<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Monolog\Handler\Curl\Util;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Length;

class UtilisateurFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

	public function getDependencies()
    {
        return array(
			EleveFixtures::class,
        );
	}

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
	}
	
    public function load(ObjectManager $manager)
    {
		for ($i = 0; $i < 10; $i++)
		{
            $utilisateur = new Utilisateur();
			$password = '123456';
			
			$isStudent = rand(0,1);

			$student = NULL;

			if($isStudent == 1){
				$student = $this->getReference('student '.$i);
			}

			$utilisateur
				->setEleve($student)
                ->setEmail('utilisateur-'.($i+1).'@gmail.com')
				->setPassword($this->encoder->encodePassword($utilisateur, $password));

			$manager->persist($utilisateur);
		}

		$manager->flush();
    }
}