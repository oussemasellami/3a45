<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorsController extends AbstractController
{
    #[Route('/authors', name: 'app_authors')]
    public function index(): Response
    {
        return $this->render('authors/index.html.twig', [
            'controller_name' => 'AuthorsController',
        ]);
    }


    #[Route('/showauthors', name: 'app_showauthors')]
    public function showauthors(): Response
    {
        return $this->render('authors/index.html.twig', [
            'controller_name' => 'AuthorsController',
        ]);
    }
}