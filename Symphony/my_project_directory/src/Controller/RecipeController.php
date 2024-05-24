<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class RecipeController extends AbstractController
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }


    #[Route('/recipe', name: 'recipe.index')]
    public function index(Request $request , RecipeRepository $repository): Response
    {
        $Recipes=$repository->findAll();
        return $this->render('recipe/index.html.twig',[
            'recipes'=>$Recipes
        ]);
    }

    #[Route('/recipe/{slug}-{id}', name: 'recipe.show', requirements : ['id'=>'\d+' , 'slug' => '[a-z0-9-]+'])]
    public function show(Request $request , int $id , string $slug , RecipeRepository $repository): Response
    {
        $recipe=$repository->find($id);
        if ($recipe->getslug()!== $slug) {
            return $this->redirectToRoute('recipe.show',['slug'=> $recipe->slug , 'id'=>$id]);
        }

        //pour l'adresse "http://localhost:8000/recipe/pate-bolognaise-32" id = 30 et slug = pate-bolognaise
        //dd($request->attributes->get('id'),$request->attributes->get('slug'));
        //dd($id,$slug); //Les deux lignes sont identiques  grace au parametre dans index ATTENTION les parametre dans la methode Index et Route doivent etre identique
        return $this->render('recipe/show.html.twig',[
            'slug'=>$slug,
            'id'=>$id,
            'recipe'=> $recipe
        ]);
    }

    #[Route('/recipe/{id}/edit', name: 'recipe.edit', requirements : ['id'=>'\d+'])]
    public function edit(Recipe $recipe, Request $request , EntityManagerInterface $em): Response
    {
        $form = $this->createForm(RecipeType::class,$recipe);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->addFlash('success','La recette a bien été modifiée');
            return $this->redirectToRoute('recipe.show',['slug'=>$recipe->getslug(),'id'=> $recipe->getid()]);
        }

        return $this->render('recipe/edit.html.twig',[
            'recipe'=> $recipe,
            'form'=>$form
        ]);
    }
    #[Route('/recipe/new', name: 'recipe.new')]
    public function new(Request $request , EntityManagerInterface $em): Response
    {
        $form = $this->createForm(RecipeType::class,new Recipe());
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $recipe=$form->getData();
            $recipe->setCreatedAt(new \DateTimeImmutable("now", new \DateTimeZone('Europe/Paris')));
            $slug = $this->slugger->slug($recipe->getTitle())->lower();
            $recipe->setSlug($slug);
            $em->persist($recipe);
            $em->flush();
            $this->addFlash('success','La recette a bien été créée');
            return $this->redirectToRoute('recipe.show',['slug'=>$recipe->getslug(),'id'=> $recipe->getid()]);
        }

        return $this->render('recipe/new.html.twig',[
            'form'=>$form
        ]);
    }
}
