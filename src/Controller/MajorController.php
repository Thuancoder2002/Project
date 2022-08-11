<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MajorController extends AbstractController
{
    #[Route('/major', name: 'app_major')]
    public function index(): Response
    {
        return $this->render('major/index.html.twig', [
            'controller_name' => 'MajorController',
        ]);
    }
}
