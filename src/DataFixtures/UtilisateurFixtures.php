<?php


namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
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
        for ($i = 0; $i < 2; $i++) {
            $utilisateur = new Utilisateur();
            $password = '123456';

            $utilisateur
                ->setEmail('user-'.$i.'@gmail.com')
                ->setPassword($this->encoder->encodePassword($utilisateur, $password))
                ->setRoles(2);

            $manager->persist($utilisateur);

        }
        $manager->flush();
    }
}