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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('description', TextareaType::class)
            ->add('date', DateType::class, ['widget' => 'single_text', 'format' => 'yyyy-MM-dd'])
            ->add('nombre_places', TextType::class)
            ->add('image', FileType::class)
            ->add('vignette', FileType::class)
            ->add('sport', EntityType::class, [
			    'class' => Sport::class,
                'choice_label' => 'nom',
			])
            ->add('type', EntityType::class, [
			'class' => Type::class,
            'choice_label' => 'nom',
			])
            ->add('categorie', EntityType::class, [
			    'class' => Categorie::class,
                'choice_label' => 'libelle',
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