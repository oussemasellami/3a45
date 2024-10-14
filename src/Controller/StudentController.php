<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    #[Route('/showstudent', name: 'showstudent')]
    public function showstudent(StudentRepository $rep): Response
    {

        $student=$rep->findAll();
        return $this->render('student/showstudent.html.twig', [
            'tabstudent' => $student,
        ]);
    }


    #[Route('/addstudent', name: 'addstudent')]
    public function addstudent(ManagerRegistry $m,Request $req): Response
    {
        $em=$m->getManager();
        $s=new Student();
        $f=$this->createForm(StudentType::class,$s);
$f->handleRequest($req);
        if($f->isSubmitted() && $f->isValid()){
            $em->persist($s);
            $em->flush();
        }
        
        return $this->render('student/addstudent.html.twig', [
            'form' => $f,
        ]);
    }




    #[Route('/updateformstudent/{id}', name: 'updateformstudent')]
    public function updateformstudent($id,ManagerRegistry $manager,Request $req,StudentRepository $rep): Response
    {
        $em = $manager->getManager();
        $authors = $rep->find($id);
        $form = $this->createForm(StudentType::class, $authors);
$form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($authors);
            $em->flush();
        }
        return $this->render('student/addstudent.html.twig', [
            'form' => $form,
        ]);
    }
}