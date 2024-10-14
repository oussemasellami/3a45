<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/showbook', name: 'app_showbook')]
    public function showbook(BookRepository $rb): Response
    {
        $book = $rb->findAll();
        return $this->render('book/showbook.html.twig', [
            'tabbook' => $book,
        ]);
    }

    #[Route('/addformbook', name: 'app_addformbook')]
    public function addformbook(ManagerRegistry $manager, Request $req): Response
    {
        $em = $manager->getManager();
        $authors = new Book();
        $form = $this->createForm(BookType::class, $authors);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $authors->setEnabled(false);
            $em->persist($authors);
            $em->flush();
            return $this->redirectToRoute('app_showbook');
        }
        return $this->render('book/addformbook.html.twig', [
            'formadd' => $form->createView(),
        ]);
    }


    #[Route('/deletebook/{id}', name: 'app_deletebook')]
    public function deletebook($id, ManagerRegistry $m, BookRepository $rb): Response
    {
        $em = $m->getManager();
        $datadelete = $rb->find($id);
        $em->remove($datadelete);
        $em->flush();
        return $this->redirectToRoute('app_showbook');
    }
}
