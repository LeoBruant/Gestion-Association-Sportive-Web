<?php


namespace App\DataFixtures;

use App\Entity\Eleve;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Monolog\Handler\Curl\Util;


class EleveFixtures extends Fixture
{
    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
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
        }
        $manager->flush();
    }
}