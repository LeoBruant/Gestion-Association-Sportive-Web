<?php

namespace App\Form;

use App\Entity\Document;
use App\Entity\DocumentCategorie;
use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('lien', FileType::class)
            ->add('description', TextareaType::class)
            ->add('dateAjout', DateType::class)
            ->add('documentCategorie', EntityType::class, [
				'class' => DocumentCategorie::class,
                'choice_label' => 'nom',
			])
            ->add('evenement', TextareaType::class, [
				'class' => Evenement::class,
                'choice_label' => 'nom',
			])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
