<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Student ;
use App\Repository\StudentRepository;
use App\Form\StudentType;
use Symfony\Component\HttpFoundation\Request;
class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

 /**
     * @Route("/lists", name="lists")
     */
    public function lists(): Response
    { 
        $rep=$this->getDoctrine()->getRepository(Student::class);
        
        $student =$rep-> findAll();
      
        return $this->render('student/lists.html.twig', [
            'stud' => $student,
           
        ]);
    }

    
    /**
     * @Route("/adds", name="adds")
     */
    public function adds(Request $request): Response
    {
        $student=new Student() ; // nouvelle instance 
        $form=$this->createForm(StudentType::class,$student);
        $form->handleRequest($request);
if ($form->isSubmitted())
{
$student=$form->getData();
$em=$this->getDoctrine()->getManager();
$em->persist($student);
$em->flush();
return $this->redirectToRoute('lists');
}


        return $this->render('student/adds.html.twig', [
            'formA' => $form->createView(),
        ]);
        

    }

    
     /**
     * @Route("/updates/{nsc}", name="updates")
     */
    public function updates(Request $request, $nsc): Response
    { $rep=$this->getDoctrine()->getRepository(Student::class);
        $student=$rep->find($nsc); // nouvelle instance 
        $form=$this->createForm(StudentType::class,$student);
        $form->handleRequest($request);
if ($form->isSubmitted())
{

$em=$this->getDoctrine()->getManager();
$em->flush();
return $this->redirectToRoute('lists');
}


        return $this->render('student/updates.html.twig', [
            'formA' => $form->createView(),
        ]);
        

    }

    
    /**
     * @Route("/deletes/{nsc}", name="deletes")
     */
    public function deletes($nsc): Response
    { $rep=$this->getDoctrine()->getRepository(Student::class);
      $em=$this->getDoctrine()->getManager();
      $student=$rep->find($nsc);
      $em->remove($student);
      $em->flush(); 

        return $this->redirectToRoute('lists');
       
    }
   /**
     * @Route("/find", name="find")
     */
    public function listFind(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Student::class);

        $student =$rep-> showAllStudentByNsc();

        return $this->render('student/find.html.twig', [
            'stud' => $student,
        ]);
    }
    /**
     * @Route("/join/{id}", name="join")
     */
    public function listJoin($id): Response
    {
        $rep=$this->getDoctrine()->getRepository(Student::class);

        $student =$rep->listStudentByClass($id);

        return $this->render('student/join.html.twig', [
            'stud' => $student,
        ]);
    }
     /**
     * @Route("/tri", name="tri")
     */
    public function tri(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Student::class);

        $student =$rep->findStudentByEmail();

        return $this->render('student/tri.html.twig', [
            'stud' => $student,
        ]);
    }
     /**
     * @Route("/triD", name="triD")
     */
    public function triD(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Student::class);

        $student =$rep->findStudentByEmail2();

        return $this->render('student/tri.html.twig', [
            'stud' => $student,
        ]);
    }
     /**
     * @Route("/date", name="date")
     */
    public function rechDate(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Student::class);

        $student =$rep->findStudentByDate();

        return $this->render('student/date.html.twig', [
            'stud' => $student,
        ]);
    }
     /**
     * @Route("/enabled", name="enabled")
     */
    public function rechEnabled(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Student::class);

        $student =$rep->findStudentByEnabled();

        return $this->render('student/enabled.html.twig', [
            'stud' => $student,
        ]);
    }
     /**
     * @Route("/datec", name="datec")
     */
    public function rechDateC(): Response
    {
        $rep=$this->getDoctrine()->getRepository(Student::class);

        $student =$rep->findStudentByDateC();

        return $this->render('student/datec.html.twig', [
            'stud' => $student,
        ]);
    }
    /**
     * @Route("/moy/{id}", name="moy")
     */
    public function rechMoyC($id): Response
    {
        $num=$this->getDoctrine()->getRepository(Student::class)

        ->findMoyenneByClass($id);

        return $this->render('student/moy.html.twig', [
            'moy' => $num,
        ]);
    }
     /**
     * @Route("/redoublant/{id}", name="redoublant")
     */
    public function rechEtudiantRedoublant($id): Response
    {
        $num=$this->getDoctrine()->getRepository(Student::class)

        ->findRedoublantByClass($id);

        return $this->render('student/redoublant.html.twig', [
            'num' => $num,
        ]);
    }
  
}
