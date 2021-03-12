<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{
	/**
     * @Route("/events", name="event-list")
     *
     */
    public function eventList(){
		$events = $this->getDoctrine()->getRepository(Evenement::class)->findAll();

		$admin = false;

		if($this->getUser() !== null){
			$user = $this->getDoctrine()->getRepository(Utilisateur::class)->find($this->getUser()->getId());

			if($user->getEleve() === null){
				$admin = true;
			}
		}

        return $this->render('events/index.html.twig', [
			'events' => $events,
			'admin' => $admin,
		]);
    }

	/**
     * @Route("/event-detail/{id}", name="event-detail")
     *
     */
    public function eventDetail(Evenement $event){
		if($this->getUser() !== null){
			$user = $this->getDoctrine()->getRepository(Utilisateur::class)->find($this->getUser()->getId());

			if($user->getEleve() === null){
				$admin = true;
			}
		}

		$documents = [];

        return $this->render('events/event.html.twig', [
			'event' => $event,
			'admin' => $admin,
			'documents' => $documents,
		]);
    }
}