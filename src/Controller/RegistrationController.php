<?php

namespace App\Controller;

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

        if ($form->isSubmitted() && $form->isValid()){

			$student
				->setCategorieId(rand(1,4))
				->setDateCreation(new \DateTime())
				->setArchivee(0);

			$user = new Utilisateur();
			$user
				->setEmail($student->GetEmail())
				->setPassword($this->encoder->encodePassword($user, 'azerty'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
			$entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
