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
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Sequentially;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class , [
                'label'=> 'Titre de la recette',
                'constraints' => new Sequentially ([
                    new NotBlank()
                    ])
            ])
            ->add('duration',IntegerType::class,[
                'required' => false,
                'label' => "Combien de temps faut-il pour réaliser la recette ?"
            ])
            ->add('NbPersonne',IntegerType::class,[
                'required' => false,
                'label' => "Pour combien de personne la recette est-elle destinée ?"
            ])
            ->add('ingredients', TextareaType::class, [
                'label' => 'Liste des ingrédients pour la recette',
                'attr' => [
                    'rows' => 20,
                ],
                'required' => false
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
