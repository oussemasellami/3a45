<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{

    private $authors = array(
        array('id' => 1, 'picture' => '/image/residence1.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/image/residence2.jpg', 'username' => ' William Shakespeare', 'email' =>  ' william.shakespeare@gmail.com', 'nb_books' => 200),
        array('id' => 3, 'picture' => '/image/residence3.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
    );

    
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {

        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }


    #[Route('/showauthor', name: 'app_showauthor')]
    public function showauthor(): Response
    {

        return $this->render('author/showauthor.html.twig', [
            'tabauthor' => $this->authors,
        ]);
    }



    #[Route('/authordetails/{id}', name: 'app_authordetails')]
    public function authordetails($id): Response
    {
        $author=null;
        foreach(  $this->authors  as $element){
        if($element['id']==$id){
        $author=$element;
        }
        }
        //var_dump($author) . die();
        return $this->render('author/authordetails.html.twig', [
            'author' => $author,
        ]);
    }
}