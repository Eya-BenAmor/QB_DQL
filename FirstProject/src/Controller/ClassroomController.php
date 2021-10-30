<?php

namespace App\Controller;
use App\Controller\StudentController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Classroom ;
use App\Repository\ClassroomRepository ;
use App\Form\ClassroomType;
use Symfony\Component\HttpFoundation\Request;
class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
     /**
     * @Route("/list", name="list")
     */
    public function list(): Response
    {$rep=$this->getDoctrine()->getRepository(classroom::class);

        $classrooms =$rep-> findAll();

        return $this->render('classroom/list.html.twig', [
            'class' => $classrooms,
        ]);
    }

    
    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request): Response
    {
        $classroom=new classroom() ; // nouvelle instance 
        $form=$this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($request);
if ($form->isSubmitted())
{
$classroom=$form->getData();
$em=$this->getDoctrine()->getManager();
$em->persist($classroom);
$em->flush();
return $this->redirectToRoute('list');
}


        return $this->render('classroom/add.html.twig', [
            'formA' => $form->createView(),
        ]);
        

    }

    
     /**
     * @Route("/update/{id}", name="update")
     */
    public function update(Request $request, $id): Response
    { $rep=$this->getDoctrine()->getRepository(classroom::class);
        $classroom=$rep->find($id); // nouvelle instance 
        $form=$this->createForm(ClassroomType::class,$classroom);
        $form->handleRequest($request);
if ($form->isSubmitted())
{
//$classroom=$form->getData();
$em=$this->getDoctrine()->getManager();
$em->flush();
return $this->redirectToRoute('list');
}


        return $this->render('classroom/update.html.twig', [
            'formA' => $form->createView(),
        ]);
        

    }

    
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id): Response
    { $rep=$this->getDoctrine()->getRepository(classroom::class);
      $em=$this->getDoctrine()->getManager();
      $classroom=$rep->find($id);
      $em->remove($classroom);
      $em->flush(); //recuperation lkhedma yaani nabeetha ll database

        return $this->redirectToRoute('list');
       
    }
}
