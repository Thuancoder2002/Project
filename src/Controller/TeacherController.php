<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Form\TeacherType;
use App\Repository\TeacherRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeacherController extends AbstractController
{
    #[Route('/teacher', name: 'teacher_index')]
    public function teacherIndex(): Response
    {
      $teacher=$this->getDoctrine()->getRepository(Teacher::class)->findAll();
        if (!$teacher) {
            throw $this->createNotFoundException(
                'No teachers found in the database.'
            );
        }
        return $this->render('teacher/index.html.twig', [
            'teacher' => $teacher,
        ]);
    }



          #[Route('/teacher/detail/{id}', name: 'teacher_detail')]
       public function teaacherDetail($id){
      $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
         if($teacher!=null){
               return $this->render('teacher/detail.html.twig',[
                'teacher'=>$teacher
            ]);  
            
         }else{
            $this->addFlash(
               'Error',
               'Teacher not found.Please try again!'
            );
            return $this->redirectToRoute('teacher_index');
        }

       }


    #[IsGranted("ROLE_ADMIN")]
    #[Route('/teacher/add', name: 'teacher_add')]
    public function teacheradd(Request $request){
            $teacher= new Teacher; 
            $form=$this->createForm(TeacherType::class,$teacher);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager=$this->getDoctrine()->getManager();
                $manager->persist($teacher);
                $manager->flush();
                $this->addFlash(

                    
               'Success',
               'You add Successfully'
            );  
            return $this->redirectToRoute("teacher_index");

            }
            return $this->renderForm("teacher/add.html.twig",[
                'teacherForm'=>$form
            ]);



    }
    #[IsGranted("ROLE_ADMIN")]
     #[Route('/teacher/delete/{id}', name: 'teacher_delete')]
     public function teacherDelete ($id, ManagerRegistry $managerRegistry) {
     $teacher = $managerRegistry->getRepository(Teacher::class)->find($id);
     if ($teacher == null) {
        $this->addFlash('Warning', 'Teacher not existed !');
     } 
     else if (count($teacher->getcourses()) >= 1){ 
        $this->addFlash('Warning', 'Can not delete teacher');
       }
     else {
        $manager = $managerRegistry->getManager();
        $manager->remove($teacher);
        $manager->flush();
        $this->addFlash('Info', 'Delete Teacher succeed !');
     }
     return $this->redirectToRoute('teacher_index');
   }

    #[IsGranted("ROLE_ADMIN")]
       #[Route('/teacher/edit/{id}', name: 'teacher_edit')]
       public function studentEdit ($id, Request $request) {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        $form=$this->createForm(TeacherType::class,$teacher);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager=$this->getDoctrine()->getManager();
            $manager->persist($teacher);
            $manager->persist($teacher);
            $manager->flush();
            $this->addFlash(
           'Success',
           'You edit Successfully '
        );  
        return $this->redirectToRoute("teacher_index");

        }
        return $this->renderForm("teacher/add.html.twig",[
            'teacherForm'=>$form
        ]);
     }



     #[Route('/asc', name: 'teacher_asc')]
   public function sortAsc(TeacherRepository $teacherRepository, ManagerRegistry $registry) {
       $teacher = $teacherRepository->sortTeacherAsc();
       return $this->render("teacher/index.html.twig",
                            [
                                'teacher' => $teacher,
                            ]);
   }

   #[Route('/desc', name: 'teacher_desc')]
   public function sortDesc(TeacherRepository $teacherRepository, ManagerRegistry $registry) {
      
       $teacher = $teacherRepository->sortTeacherDesc();
       return $this->render("teacher/index.html.twig",
                            [
                                'teacher' => $teacher
                            ]);
   }

   #[Route('/search', name: 'teacher_search')]
   public function search (Request $request, TeacherRepository $teacherRepository, ManagerRegistry $registry) {
       $keyword = $request->get('name');
       $teacher = $teacherRepository->search($keyword);
       return $this->render("teacher/index.html.twig",
                            [
                                'teacher' => $teacher,
                            ]);
   }



}
