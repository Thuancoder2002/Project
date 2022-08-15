<?php

namespace App\Controller;

use App\Entity\Major;
use App\Form\MajorType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class MajorController extends AbstractController
{
    #[Route('/major', name: 'major_index')]
   public function majorIndex(){

       $major=$this->getDoctrine()->getRepository(Major::class)->findAll();
        if (!$major) {
            throw $this->createNotFoundException(
                'No students found in the database.'
            );
        }
        return $this->render('major/index.html.twig', [
            'major' => $major,
        ]);
    }


        #[Route('/major/detail/{id}', name: 'major_detail')]
        public function studentDetail($id){
            $major=$this->getDoctrine()->getRepository(Major::class)->find($id);
            if($major!=null){
                return $this->render('major/detail.html.twig',[
                    'major'=>$major
                ]);
            }else{
            $this->addFlash(
               'Error',
               'Todo not found.Please try again!'
            );
            return $this->redirectToRoute('student_index');
        }
       }
        


        #[Route('/major/add', name: 'major_add')]
        public function majorAdd(Request $request){
            $major= new Major; 
            $form=$this->createForm(MajorType::class,$major);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager=$this->getDoctrine()->getManager();
                $manager->persist($major);
                $manager->flush();
                $this->addFlash(
               'Success',
               'You have Successfully added'
            );  
            return $this->redirectToRoute("major_index");

            }
            return $this->renderForm("major/add.html.twig",[
                'majorForm'=>$form
            ]);
        }
        

        #[Route('/major/delete/{id}', name: 'major_delete')]
        public function coursedelete($id,ManagerRegistry $managerRegistry){
         $major = $managerRegistry->getRepository(Major::class)->find($id);
      if ($major == null) {
         $this->addFlash('Warning', 'Book not existed !');
      
      } else if (count($major->getclassrooms()) >= 1){ //check xem genre này có ràng buộc với book hay không trước khi xóa
         //nếu có tối thiểu 1 book thì hiển thị lỗi và không cho xóa  
      $this->addFlash('Warning', 'Can not delete this genre');
      }  else {
         $manager = $managerRegistry->getManager();
         $manager->remove($major);
         $manager->flush();
         $this->addFlash('Info', 'Delete book succeed !');
      }
      return $this->redirectToRoute('major_index');
 
        }

        
       
    #[Route('/major/edit/{id}', name: 'major_edit')]
    public function classEdit($id,Request $request){
          $major = $this->getDoctrine()->getRepository(Major::class)->find($id);
          $form=$this->createForm(MajorType::class,$major);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager=$this->getDoctrine()->getManager();
                $manager->persist($major);
                $manager->flush();
                $this->addFlash(
               'Success',
               'You have Successfully added'
            );  
            return $this->redirectToRoute("major_index");

            }
            return $this->renderForm("major/edit.html.twig",[
                'majorForm'=>$form
            ]);
    }

    

       
        






   
}
