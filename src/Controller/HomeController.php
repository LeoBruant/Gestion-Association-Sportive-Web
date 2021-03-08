<?php

namespace App\Controller;

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
        return $this->render('home/home.html.twig');
    }

	/**
     * @Route("/event", name="event")
     */
    public function event(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('evenement/create.html.twig');
    }
}
