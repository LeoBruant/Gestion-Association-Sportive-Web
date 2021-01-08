<?php

namespace App\Form;

use App\Entity\Eleve;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('dateNaissance', DateType::class, ['widget' => 'single_text', 'format' => 'yyyy-MM-dd',])
            ->add('classe', ChoiceType::class, [
				'choices' => [
					'Seconde' => 0,
					'Première' => 1,
					'Terminale' => 2,
					'Bts-1' => 3,
					'Bts-2' => 4,
					'Licence' => 5,
					'Master 1' => 6,
					'Master 2' => 7,
				]
			])
			->add('email', EmailType::class)
			->add('genre', ChoiceType::class, [
				'choices' => [
					'Homme' => 'Homme',
					'Femme' => 'Femme',
					'Non-binaire' => 'Non-binaire',
				],
			]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
