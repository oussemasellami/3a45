<?php

namespace App\Controller;

use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;

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
    public function showauthors(AuthorRepository $authorrepo): Response
    {

        $a = $authorrepo->findAll();

        return $this->render('authors/showauthors.html.twig', [
            'tabauthor' => $a,
        ]);
    }


    #[Route('/addauthors', name: 'app_addauthors')]
    public function addauthors(ManagerRegistry $manager): Response
    {
        $em = $manager->getManager();
        $authors = new Author();
        $authors->setUsername("3a45");
        $authors->setEmail("3a45@esprit.tn");
        $em->persist($authors);
        $em->flush();

        return $this->redirect('/showauthors');
    }

    #[Route('/addformauthors', name: 'app_addformauthors')]
    public function addformauthors(): Response
    {
        return $this->render('authors/addformauthors.html.twig', [
            'controller_name' => 'AuthorsController',
        ]);
    }
}
