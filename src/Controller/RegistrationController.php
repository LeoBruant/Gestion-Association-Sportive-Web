<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Eleve;
use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $student = new Eleve();
        $form = $this->createForm(RegistrationFormType::class, $student);
		$form->handleRequest($request);

		$user = new Utilisateur();

        if ($form->isSubmitted() && $form->isValid()){

			// Catégories

			$categories = [
				'labels' => [
					'Junior homme',
					'Junior femme',
				],

				'values' => [],
			];

			for ($i = 0; $i < (count($categories['labels'])); $i++){
				
				$category = new Categorie();

				$category
					->setLibelle($categories['labels'][$i]);

				$categories['values'][] = $category;
			}

			// Elève

			if($student->GetGenre() == 'Homme'){
				$category = $categories['values'][0];
			}

			else{
				$category = $categories['values'][1];
			}

			$student
				->setCategorie($category)
				->setDateCreation(new \DateTime())
				->setArchivee(0);

			// Utilisateur
			
			$user
				->setEmail($student->GetEmail())
				->setPassword('azerty');

			$entityManager = $this->getDoctrine()->getManager();
			
			$entityManager->persist($student);
			$entityManager->persist($user);

			$entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
