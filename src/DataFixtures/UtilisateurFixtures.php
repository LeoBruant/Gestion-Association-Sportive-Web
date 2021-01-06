<?php


namespace App\DataFixtures;

use App\Entity\Utilisateur;
use App\Entity\Eleve;
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
        $roles = [
			[
				Utilisateur::ROLE_UTILISATEUR,
			],

			[
				Utilisateur::ROLE_ADMIN,
			],
		];
		
        for ($i = 0; $i < 10; $i++) {
			$eleve = new Eleve();

			$eleve
                ->setEmail('eleve-'.$i.'@gmail.com')
                ->setDateNaissance(new \DateTime(''.rand(1995,2021).'/'.rand(1,12).'/'.rand(1,30)))
                ->setNom('nom-'.$i)
                ->setPrenom('prenom'.$i)
                ->setClasse('classe'.rand(1,5))
				->setCategorieId(rand(1,3));

			$manager->persist($eleve);

            $utilisateur = new Utilisateur();
            $password = '123456';

            $utilisateur
                ->setEmail('user-'.$i.'@gmail.com')
                ->setPassword($this->encoder->encodePassword($utilisateur, $password))
				->setRoles($roles[rand(0,1)]);

            $manager->persist($utilisateur);

        }
        $manager->flush();
    }
}