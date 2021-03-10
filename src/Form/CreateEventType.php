<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Sport;
use App\Entity\Categorie;
use App\Entity\Type;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
            ])
            ->add('description', TextareaType::class,[
                'required' => true,
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('nombre_places', IntegerType::class,[
                'required' => true,
                ])
            ->add('image', FileType::class,[
                'required' => true,
            ])
            ->add('vignette', FileType::class,[
                'required' => true,
            ])
            ->add('sport', EntityType::class, [
			    'class' => Sport::class,
                'choice_label' => 'nom',
                'required' => true,
			])
            ->add('type', EntityType::class, [
			    'class' => Type::class,
                'choice_label' => 'nom',
                'required' => true,
			])
            ->add('categorie', EntityType::class, [
			    'class' => Categorie::class,
                'choice_label' => 'libelle',
                'required' => true,
			])
			->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}