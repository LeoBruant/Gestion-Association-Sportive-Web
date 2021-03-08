<?php

namespace App\Controller;

use Amp\Http\Client\Request;
use App\Entity\Evenement;
use App\Form\CreateEventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
	/**
     * @Route("/event", name="event")
     */
    public function new(): Response
    {
        $event = new Evenement();

        $form = $this->createForm(CreateEventType::class, $event);

		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
        }

		return $this->render('evenement/new.html.twig', [
            'event_form' => $form->createView(),
        ]);
    }
}