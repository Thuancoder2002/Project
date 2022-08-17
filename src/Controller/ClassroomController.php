<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'classroom_index')]
    public function clasroomindex()
    {
        $classroom=$this->getDoctrine()->getRepository(Classroom::class)->findAll();
        return $this->render('classroom/index.html.twig', [
            'classroom' => $classroom,
        ]);
    }
    #[Route('/classroom/deatail/{id}', name: 'classroom_detail')]
    public function classroomDetail($id){
        $classroom = $this->getDoctrine()->getRepository(Classroom::class)->find($id);
         if($classroom!=null){
               return $this->render('classroom/detail.html.twig',[
                'classroom'=>$classroom
            ]);  
         }else{
            $this->addFlash(
               'Error',
               'Classroom not found.Please try again!'
            );
            return $this->redirectToRoute('classroom_index');
        }
    }
    #[Route('/classroom/add', name: 'classroom_add')]
    public function classAdd(Request $request){
        $classroom= new Classroom; 
            $form=$this->createForm(ClassroomType::class,$classroom);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager=$this->getDoctrine()->getManager();
                $manager->persist($classroom);
                $manager->persist($classroom);
                $manager->flush();
                $this->addFlash(
               'Success',
               'You have Successfully added'
            );  
            return $this->redirectToRoute("classroom_index");
            }
            return $this->renderForm("classroom/add.html.twig",[
                'ClassForm'=>$form
            ]);
    }

    #[Route('/classroom/delete/{id}', name: 'classroom_delete')]
    public function classDelete($id,ManagerRegistry $managerRegistry){
          $classroom = $managerRegistry->getRepository(Classroom::class)->find($id);
     if ($classroom == null) {
        $this->addFlash('Warning', 'Book not existed !');
    } else if (count($classroom->getstudents()) >= 1){ 
      $this->addFlash('Warning', 'Can not delete this classroom');
     }   
      else {
        $manager = $managerRegistry->getManager();
        $manager->remove($classroom);
        $manager->flush();
        $this->addFlash('Info', 'Delete classroom succeed !');
     }
     return $this->redirectToRoute('classroom_index');

    }

    #[Route('/classroom/edit/{id}', name: 'classroom_edit')]
    public function classEdit($id,Request $request){
          $classroom = $this->getDoctrine()->getRepository(Classroom::class)->find($id);
          $form=$this->createForm(ClassroomType::class,$classroom);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager=$this->getDoctrine()->getManager();
                $manager->persist($classroom);
                $manager->persist($classroom);
                $manager->flush();
                $this->addFlash(
               'Success',
               'You have Successfully added'
            );  
            return $this->redirectToRoute("classroom_index");

            }
            return $this->renderForm("classroom/add.html.twig",[
                'ClassForm'=>$form
            ]);


          

   }  
        #[Route('/classroom/search', name:'classroom_search')]
   public function classSearch(Request $request, ClassroomRepository $classroomRepository, ManagerRegistry $registry){
        $keyword = $request->get('name');
       $classroom = $classroomRepository->search($keyword);
       return $this->render("classroom/index.html.twig",
                            [
                                'classroom' => $classroom,
                            ]);
   }

    

}
