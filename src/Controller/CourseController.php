<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Teacher;
use App\Form\CourseType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourseController extends AbstractController
{
    #[Route('/course', name: 'course_index')]
    public function courseIndex()
    {

       $course=$this->getDoctrine()->getRepository(Course::class)->findAll();
        if (!$course) {
            throw $this->createNotFoundException(
                'No students found in the database.'
            );
        }
        return $this->render('course/index.html.twig', [
            'course' => $course,
        ]);
       
    }
     #[Route('/course/detail/{id}', name: 'course_detail')]
     public function courseDetail($id){
         $course = $this->getDoctrine()->getRepository(Course::class)->find($id);
         if($course!=null){
               return $this->render('course/detail.html.twig',[
                'course'=>$course
            ]);  
            
         }else{
            $this->addFlash(
               'Error',
               'Todo not found.Please try again!'
            );
            return $this->redirectToRoute('course_index');
        }


     }


      #[Route('/course/add', name: 'course_add')]
      public function courseAdd(Request $request){
            $course= new Course; 
            $form=$this->createForm(CourseType::class,$course);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager=$this->getDoctrine()->getManager();
                $manager->persist($course);
                $manager->flush();
                $this->addFlash(
               'Success',
               'You have Successfully added'
            );  
            return $this->redirectToRoute("course_index");

            }
            return $this->renderForm("course/add.html.twig",[
                'CourseForm'=>$form
            ]);


      }
       #[Route('/course/delete/{id}', name: 'course_delete')]
       public function coursedelete($id,ManagerRegistry $managerRegistry){
        $course = $managerRegistry->getRepository(Course::class)->find($id);
     if ($course == null) {
        $this->addFlash('Warning', 'Book not existed !');
     } else {
        $manager = $managerRegistry->getManager();
        $manager->remove($course);
        $manager->flush();
        $this->addFlash('Info', 'Delete book succeed !');
     }
     return $this->redirectToRoute('course_index');

       }


        #[Route('/course/edit/{id}', name: 'course_edit')]

        public function courseEdit($id,Request $request){
             $course=$this->getDoctrine()->getRepository(Course::class)->find($id);
             $form=$this->createForm(CourseType::class,$course);
             $form->handleRequest($request);
             if($form->isSubmitted() && $form->isValid()){
                 $manager=$this->getDoctrine()->getManager();
                 $manager->persist($course);
                 $manager->flush();
                 $this->addFlash(
                'Success',
                'You have Successfully added'
             );  
             return $this->redirectToRoute("course_index");
 
             }
             return $this->renderForm("course/add.html.twig",[
                 'CourseForm'=>$form
             ]);
 


        }






}
