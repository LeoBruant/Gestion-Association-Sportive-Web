<?php


namespace App\DataFixtures;

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
        $roles = [
            Utilisateur::ROLE_UTILISATEUR,
            Utilisateur::ROLE_ADMIN,
        ];

        for ($i = 0; $i < 2; $i++) {
            $utilisateur = new Utilisateur();
            $password = '123456';

            $utilisateur
                ->setEmail('user-'.$i.'@gmail.com')
                ->setPassword($this->encoder->encodePassword($utilisateur, $password))
                ->setRoles($roles[1]);

            $manager->persist($utilisateur);

        }
        $manager->flush();
    }
}