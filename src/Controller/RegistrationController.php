<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Eleve;
use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use App\Security\LoginAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginAuthenticator $authenticator): Response
    {
        $student = new Eleve();
        $form = $this->createForm(RegistrationFormType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Catégories

            $categories = [
                'labels' => [
                    'Junior homme',
                    'Junior femme',
                ],

                'values' => [],
            ];

            for ($i = 0; $i < (count($categories['labels'])); $i++) {

                $category = new Categorie();

                $category
                    ->setLibelle($categories['labels'][$i]);

                $categories['values'][] = $category;
            }

            // Elève

            if ($student->GetGenre() == 'Homme') {
                $category = $categories['values'][0];
            } else {
                $category = $categories['values'][1];
            }

            $student
                ->setCategorie($category)
                ->setDateCreation(new \DateTime())
                ->setArchivee(0);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);

            // Utilisateur

            $user = new Utilisateur();

            $plainPassword = $student->getPrenom()[0].$student->getNom();

            $user
                ->setEleve($student)
                ->setEmail($student->GetEmail())
                ->setPassword($passwordEncoder->encodePassword($user, $plainPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            return $guardHandler->authenticateUserAndHandleSuccess(
                $student,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
