<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Entity\Sport;
use App\Entity\Type;
use App\Form\CreateCategoryType;
use App\Form\CreateEventType;
use App\Form\CreateSportType;
use App\Form\CreateTypeType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('admin/index.html.twig');
    }

	/**
     * @Route("/admin/events", name="events")
     */
    public function events(Request $request): Response
    {
        $evenements = $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        $event = new Evenement();

        $form = $this->createForm(CreateEventType::class, $event);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$file = $form['vignette']->getData();
        	$file->move('vignettes', $file->getClientOriginalName());
			$event->setVignette($file->getClientOriginalName());

			$file = $form['image']->getData();
        	$file->move('images', $file->getClientOriginalName());
			$event->setImage($file->getClientOriginalName());

			$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

			$evenements = $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        }

		return $this->render('admin/events.html.twig', [
            'event_form' => $form->createView(),
            'evenements'=> $evenements,
			'admin' => true
        ]);
    }

	/**
     * @Route("/admin/types", name="types")
     */
    public function types(Request $request): Response
    {
        $types = $this->getDoctrine()->getRepository(Type::class)->findAll();
        $type = new Type();

        $form = $this->createForm(CreateTypeType::class, $type);
		$form->handleRequest($request);

		$type_names = [];

		foreach($types as $type){
			$type_list[] = $type->getNom();
		}

		if ($form->isSubmitted() && $form->isValid() && !in_array($type->getNom(), $type_names)) {
			$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type);
            $entityManager->flush();

			$types = $this->getDoctrine()->getRepository(Type::class)->findAll();
        }

		return $this->render('admin/types.html.twig', [
            'type_form' => $form->createView(),
			'types' => $types,
			'admin' => true
        ]);
    }

	/**
     * @Route("/admin/sports", name="sports")
     */
    public function sports(Request $request): Response
    {
        $sport = new Sport();

        $form = $this->createForm(CreateSportType::class, $sport);
		$form->handleRequest($request);

		$sports = $this->getDoctrine()->getRepository(Sport::class)->findAll();
		$sport_names = [];

		foreach($sports as $sport){
			$sport_list[] = $sport->getNom();
		}

		if ($form->isSubmitted() && $form->isValid() && !in_array($sport->getNom(), $sport_names)) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($sport);
			$entityManager->flush();

			$sports = $this->getDoctrine()->getRepository(Sport::class)->findAll();
        }

		return $this->render('admin/sports.html.twig', [
            'sport_form' => $form->createView(),
			'sports' => $sports,
			'admin' => true
        ]);
    }

	/**
     * @Route("/admin/categories", name="categories")
     */
    public function categories(Request $request): Response
    {
        $category = new Categorie();

        $form = $this->createForm(CreateCategoryType::class, $category);
		$form->handleRequest($request);

		$categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
		$category_names = [];

		foreach($categories as $category){
			$category_names[] = $category->getLibelle();
		}

		if ($form->isSubmitted() && $form->isValid() && !in_array($category->getLibelle(), $category_names)) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($category);
			$entityManager->flush();

			$categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        }

		return $this->render('admin/categories.html.twig', [
            'category_form' => $form->createView(),
			'categories' => $categories,
			'admin' => true
        ]);
    }

    /**
     * @Route("/admin/delete-event/{id}", name="delete-event")
     *
     */
    public function removeEvent(Evenement $event){
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($event);
        $manager->flush();

        return $this->redirectToRoute('events');
    }

    /**
     * @Route("/admin/delete-categorie/{id}", name="delete-categorie")
     *
     */
    public function removeCategorie(Categorie $category){
		$events = $this->getDoctrine()->getRepository(Evenement::class)->findAll();


		foreach($events as $event){
			if($event->getCategorie() === $category){
				$exist = true;
			}
		}

		if(!$exist){
			$manager = $this->getDoctrine()->getManager();
			$manager->remove($category);
			$manager->flush();
		}

        return $this->redirectToRoute('categories');
    }

    /**
     * @Route("/admin/delete-sport/{id}", name="delete-sport")
     *
     */
    public function removeSport(Sport $sport){
		$events = $this->getDoctrine()->getRepository(Evenement::class)->findAll();

		$exist = false;

		foreach($events as $event){
			if($event->getSport() === $sport){
				$exist = true;
			}
		}

		if(!$exist){
			$manager = $this->getDoctrine()->getManager();
			$manager->remove($sport);
			$manager->flush();
		}

        return $this->redirectToRoute('sports');
    }

    /**
     * @Route("/admin/delete-type/{id}", name="delete-type")
     *
     */
    public function removeType(Type $type){
		$events = $this->getDoctrine()->getRepository(Evenement::class)->findAll();

        $exist = false;

        foreach($events as $event){
            if($event->getType() === $type){
                $exist = true;
            }
        }

        if(!$exist){
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($type);
            $manager->flush();
        }

		return $this->redirectToRoute('types');
    }

    /**
     * @Route("/admin/modif-event/{id}", name="modif-event")
     *
     */
    public function modifEvent(Request $request, Evenement $event){
        $form = $this->createForm(CreateEventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			$file = $form['vignette']->getData();
        	$file->move('vignettes', $file->getClientOriginalName());
			$event->setVignette($file->getClientOriginalName());

			$file = $form['image']->getData();
        	$file->move('images', $file->getClientOriginalName());
			$event->setImage($file->getClientOriginalName());
			
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
        }
        return $this->render('admin/modif-event.html.twig', [
            'event_form' => $form->createView(),
            'event'=> $event,
			'admin' => true
        ]);
    }

    /**
         * @Route("/admin/modif-sport/{id}", name="modif-sport")
         *
         */
        public function modifSport(Request $request, Sport $sport)
        {
            $form = $this->createForm(CreateSportType::class, $sport);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($sport);
                $entityManager->flush();
            }
            return $this->render('admin/modif-sport.html.twig', [
                'sport_form' => $form->createView(),
                'sport' => $sport,
				'admin' => true
            ]);
        }

    /**
     * @Route("/admin/modif-categorie/{id}", name="modif-categorie")
     *
     */
    public function modifCategorie(Request $request, Categorie $categorie){
        $form = $this->createForm(CreateCategoryType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();
        }
        return $this->render('admin/modif-categorie.html.twig', [
            'category_form' => $form->createView(),
            'categorie'=> $categorie,
			'admin' => true
        ]);
    }

    /**
     * @Route("/admin/modif-type/{id}",name="modif-type")
     *
     */
    public function modifType(Request $request, Type $type){
        $form = $this->createForm(CreateTypeType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type);
            $entityManager->flush();
        }
        return $this->render('admin/modif-type.html.twig', [
            'type_form' => $form->createView(),
            'type'=> $type,
			'admin' => true
        ]);
    }

	/**
     * @Route("/events", name="event-list")
     *
     */
    public function eventList(){
		$events = $this->getDoctrine()->getRepository(Evenement::class)->findAll();

        return $this->render('events/index.html.twig', [
			'events' => $events
		]);
    }
}