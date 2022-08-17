<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

   #[Route('/student')]
class StudentController extends AbstractController
{
       #[Route('/', name: 'student_index')]
    public function student_index()
     {
        $student=$this->getDoctrine()->getRepository(Student::class)->findAll();
            return $this->render('student/index.html.twig', [
            'student' => $student,
        ]);
     }
        #[Route('/detail/{id}', name: 'student_detail')]
       public function studentDetail($id){
      $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
         if($student!=null){
               return $this->render('student/detail.html.twig',[
                'student'=>$student
            ]);  
         }else{
            $this->addFlash(
              'Warning',
               'Student not found.Please try again!'
            );
            return $this->redirectToRoute('student_index');
        }

       }

         #[Route('/add', name: 'student_add')]
    public function sdtudentadd(Request $request){
            $student= new Student; 
            $form=$this->createForm(StudentType::class,$student);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager=$this->getDoctrine()->getManager();
                $manager->persist($student);
                $manager->flush();
                $this->addFlash(
               'Success',
               'You have Successfully added'
            );  
            return $this->redirectToRoute("student_index");
            }
            return $this->renderForm("student/add.html.twig",[
                'studentForm'=>$form
            ]);
    }
 
    
     #[Route('/delete/{id}', name: 'student_delete')]
     public function studentDelete ($id, ManagerRegistry $managerRegistry) {
     $student = $managerRegistry->getRepository(Student::class)->find($id);
     if ($student == null) {
        $this->addFlash('Warning', 'Book not existed !');
     }

     else if (count($student->getcourses()) >= 1){ 
      $this->addFlash('Warning', 'Can not delete student');
     }

    else {
        $manager = $managerRegistry->getManager();
        $manager->remove($student);
        $manager->flush();
        $this->addFlash('Success', 'Delete book succeed !');
     }
     return $this->redirectToRoute('student_index');
   }
       

       #[Route('/edit/{id}', name: 'student_edit')]
       public function studentEdit ($id, Request $request) {
        $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
        if ($student== null) {
            $this->addFlash('Warning', 'Student not existed !');
         } else {
            $form = $this->createForm(StudentType::class,$student);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($student);
                $manager->flush();
                $this->addFlash('Success', 'Edit Student succeed !');
                return $this->redirectToRoute("student_index");
            }
            return $this->renderForm("student/edit.html.twig",
            [
                'studentForm' => $form
            ]);
         }
     }



     #[Route('/asc', name: 'student_asc')]
   public function sortAsc(StudentRepository $studentRepository, ManagerRegistry $registry) {
       $student = $studentRepository->sortStudentAsc();
       return $this->render("student/index.html.twig",
                            [
                                'student' => $student,
                            ]);
   }

   #[Route('/desc', name: 'student_desc')]
   public function sortDesc(StudentRepository $studentRepository, ManagerRegistry $registry) { 
       $student = $studentRepository->sortStudentDesc();
       return $this->render("student/index.html.twig",
                            [
                                'student' => $student
                            ]);
   }

   #[Route('/search', name: 'student_search')]
   public function search (Request $request, StudentRepository $studentRepository, ManagerRegistry $registry) {
       $keyword = $request->get('name');
       $student = $studentRepository->search($keyword);
       return $this->render("student/index.html.twig",
                            [
                                'student' => $student,
                            ]);
   }



}
