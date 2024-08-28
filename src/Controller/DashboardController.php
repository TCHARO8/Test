<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/')]
    public function uril(){
        return $this->redirectToRoute("dashboard");
    }

    #[Route('/dashboard', name :'dashboard')]
    public function home(){
        return $this->render('dashboard/dashboard.html.twig',[
            "accueil" => true
        ]);
    }
}
