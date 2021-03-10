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
			$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

			$evenements = $this->getDoctrine()->getRepository(Evenement::class)->findAll();
        }

		return $this->render('admin/events.html.twig', [
            'event_form' => $form->createView(),
            'evenements'=> $evenements,
        ]);
    }

	/**
     * @Route("/admin/types", name="types")
     */
    public function types(Request $request): Response
    {
        $type = new Type();

        $form = $this->createForm(CreateTypeType::class, $type);
		$form->handleRequest($request);

		$types = $this->getDoctrine()->getRepository(Type::class)->findAll();
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
        ]);
    }

    /**
<<<<<<< HEAD
     * @Route("/admin/delete-event/{id}",name="delete-event")
     *
=======
     * @Route("/admin/delete-event", name="delete-event")
>>>>>>> 95b2f9807e4072d6ee0594a642665b2f2893d801
     */
    public function removeEvent(Evenement $event){
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($event);
        $manager->flush();

        return $this->render('admin/delete-event.html.twig', [
            'event'=> $event,
        ]);
    }
    /**
     * @Route("/admin/delete-categorie/{id}",name="delete-categorie")
     *
     */
    public function removeCategorie(Categorie $categorie){
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($categorie);
        $manager->flush();

        return $this->render('admin/delete-categorie.html.twig', [
            'event'=> $categorie,
        ]);
    }
    /**
     * @Route("/admin/delete-sport/{id}",name="delete-sport")
     *
     */
    public function removeSport(Sport $sport){
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($sport);
        $manager->flush();

        return $this->render('admin/delete-sport.html.twig', [
            'event'=> $sport,
        ]);
    }
    /**
     * @Route("/admin/delete-type/{id}",name="delete-type")
     *
     */
    public function removeType(Type $type){
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($type);
        $manager->flush();

        return $this->render('admin/delete-type.html.twig', [
            'event'=> $type,
        ]);
    }

}