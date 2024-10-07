<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/showproduct/{id}', name: 'app_showproduct')]
    public function showproduct($id): Response
    {
        //var_dump($id) . die();
        $name = "hello";
        return $this->render('product/showproduct.html.twig', [
            'name3a45' => $name,
        ]);
    }
}