<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
		$admin = false;

		if($this->getUser() !== null){
			$user = $this->getDoctrine()->getRepository(Utilisateur::class)->find($this->getUser()->getId());

			if($user->getEleve() === null){
				$admin = true;
			}
		}

        return $this->render('home/home.html.twig', [
			'admin' => $admin,
		]);
    }
}
