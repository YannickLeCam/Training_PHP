<?php

namespace App\Form;

use App\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class , [
                'label'=> 'Titre de la recette'
            ])
            ->add('duration',IntegerType::class)
            ->add('NbPersonne',IntegerType::class)
            ->add('ingredients', TextareaType::class, [
                'label' => 'Liste des ingrédients pour la recette',
                'attr' => [
                    'rows' => 20,
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Detail de la recette',
                'attr' => [
                    'rows' => 20,
                ]
            ])
            
            ->add('save', SubmitType::class , [
                'label'=>'Envoyer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
