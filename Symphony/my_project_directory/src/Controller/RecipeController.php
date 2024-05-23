<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{



    #[Route('/recipe', name: 'recipe.index')]
    public function index(Request $request): Response
    {
        return new Response("Ici est l'index des toute les recettes . . .");
    }

    #[Route('/recipe/{slug}-{id}', name: 'recipe.show', requirements : ['id'=>'\d+' , 'slug' => '[a-z0-9-]+'])]
    public function show(Request $request , int $id , string $slug): Response
    {
        //pour l'adresse "http://localhost:8000/recipe/pate-bolognaise-32" id = 30 et slug = pate-bolognaise
        //dd($request->attributes->get('id'),$request->attributes->get('slug'));
        //dd($id,$slug); //Les deux lignes sont identiques  grace au parametre dans index ATTENTION les parametre dans la methode Index et Route doivent etre identique
        return new Response("Vous etes sur la recette : " . $slug);
    }
}
