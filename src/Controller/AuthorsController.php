<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
       // $a = $authorrepo->findorderby();

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
    public function addformauthors(ManagerRegistry $manager, Request $req): Response
    {
        $em = $manager->getManager();
        $authors = new Author();
        $form = $this->createForm(AuthorType::class, $authors);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($authors);
            $em->flush();
        }
        return $this->render('authors/addformauthors.html.twig', [
            'formadd' => $form->createView(),
        ]);
    }

    #[Route('/updateformauthors/{id}', name: 'app_addformauthors')]
    public function updateformauthors($id, ManagerRegistry $manager, Request $req, AuthorRepository $rep): Response
    {
        $em = $manager->getManager();
        $authors = $rep->find($id);
        $form = $this->createForm(AuthorType::class, $authors);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($authors);
            $em->flush();
        }
        return $this->render('authors/addformauthors.html.twig', [
            'formadd' => $form->createView(),
        ]);
    }

    #[Route('/deleteformauthors/{id}', name: 'app_deleteformauthors')]
    public function deleteformauthors($id, ManagerRegistry $manager, Request $req, AuthorRepository $rep): Response
    {
        $em = $manager->getManager();
        $authors = $rep->find($id);
        $em->remove($authors);
        $em->flush();

        return $this->redirect('/showauthors');
    }
}