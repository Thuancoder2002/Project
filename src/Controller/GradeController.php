<?php

namespace App\Controller;

use App\Entity\Grade;
use App\Form\GradeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GradeController extends AbstractController
{
    #[Route('/grade', name: 'grade_index')]
    public function index(): Response
    {
        $grade=$this->getDoctrine()->getRepository(Grade::class)->findAll();
        if (!$grade) {
            throw $this->createNotFoundException(
                'No students found in the database.'
            );
        }
        return $this->render('grade/index.html.twig', [
            'grade' => $grade,
        ]);
    }



    #[Route('/grade/add', name: 'grade_add')]
    public function gradeadd(Request $request){
            $grade= new Grade; 
            $form=$this->createForm(GradeType::class,$grade);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager=$this->getDoctrine()->getManager();
                $manager->persist($grade);
                $manager->flush();
                $this->addFlash(
               'Success',
               'You have Successfully added'
            );  
            return $this->redirectToRoute("grade_index");

            }
            return $this->renderForm("grade/add.html.twig",[
                'gradeForm'=>$form
            ]);
    }


       #[Route('/grade/delete/{id}', name: 'grade_delete')]
       public function gradeDelete($id,ManagerRegistry $managerRegistry){
         $grade = $managerRegistry->getRepository(Grade::class)->find($id);
     if ($grade == null) {
        $this->addFlash('Warning', 'Book not existed !');
     } else {
        $manager = $managerRegistry->getManager();
        $manager->remove($grade);
        $manager->flush();
        $this->addFlash('Info', 'Delete book succeed !');
     }
     return $this->redirectToRoute('grade_index');


       }

          #[Route('/grade/edit/{id}', name: 'grade_edit')]
          public function gradeEdit($id,Request $request){
            $grade=$this->getDoctrine()->getRepository(Grade::class)->find($id);
            $form=$this->createForm(GradeType::class,$grade);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager=$this->getDoctrine()->getManager();
                $manager->persist($grade);
                $manager->persist($grade);
                $manager->flush();
                $this->addFlash(
               'Success',
               'You have Successfully added'
            );  
            return $this->redirectToRoute("grade_index");

            }
            return $this->renderForm("grade/add.html.twig",[
                'gradeForm'=>$form
            ]);


          }



}
