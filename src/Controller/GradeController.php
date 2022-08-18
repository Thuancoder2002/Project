<?php

namespace App\Controller;

use App\Entity\Grade;
use App\Form\GradeType;
use App\Repository\GradeRepository;
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
                $a = $grade->getGrade();
                if($a>0 and $a<5 ){
                    $grade-> setComment('Refer');
               }else if($a>=5 and $a<7){
                    $grade-> setComment('Pass');
               }
               else if($a>=7 and $a<=8){
                $grade-> setComment('Merit');
               }
               else{
                $grade-> setComment('Dis');
               }
               $manager=$this->getDoctrine()->getManager();
                $manager->persist($grade);
               
                $manager->flush();
                $this->addFlash(
               'Success',
               'You add Successfully '
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
        $this->addFlash('Warning', 'Grade not existed !');
     } else {
        $manager = $managerRegistry->getManager();
        $manager->remove($grade);
        $manager->flush();
        $this->addFlash('Info', 'Delete grade succeed !');
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
               
                $manager->flush();
                $this->addFlash(
               'Success',
               'You edit Successfully'
            );  
            return $this->redirectToRoute("grade_index");

            }
            return $this->renderForm("grade/edit.html.twig",[
                'gradeForm'=>$form
            ]);


          }

          #[Route('/asc', name: 'grade_asc')]
          public function sortAsc(GradeRepository $gradeRepository, ManagerRegistry $registry) {
              $grade = $gradeRepository->sortGradeAsc();
              return $this->render("grade/index.html.twig",
                                   [
                                       'grade' => $grade,
                                   ]);
          }
       
          #[Route('/desc', name: 'grade_desc')]
          public function sortDesc(GradeRepository $gradeRepository, ManagerRegistry $registry) {
             
            $grade = $gradeRepository->sortGradeDsc();
              return $this->render("grade/index.html.twig",
                                [
                                    'grade' => $grade,
                                ]);
          }



}
