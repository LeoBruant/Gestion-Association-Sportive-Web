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

			$studentId = NULL;

			$student = $this->getReference('student '.rand(0,9));

			if($isStudent == 1){
				$studentId = $student->GetId();
			}

			$utilisateur
				->setEleve($studentId)
                ->setEmail('user-'.$i.'@gmail.com')
				->setPassword($this->encoder->encodePassword($utilisateur, $password));

			$manager->persist($utilisateur);
		}

		$manager->flush();
    }
}