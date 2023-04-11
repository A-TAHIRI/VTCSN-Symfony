<?php

namespace App\Controller;

use App\Repository\RatingRepository;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(VehiculeRepository $vehiculeRepository, RatingRepository $ratingRepository): Response
    {
        return $this->render('main/index.html.twig', [
            
            'vehicule' => $vehiculeRepository->findby([]),
            'rating' => $ratingRepository->findby([])
        ]);
    }

    #[Route('/inscription_chauffeur', name:'app_inscription')]
    public function inscrirption(): Response
    {
      
        return $this->render('main/inscrire.html.twig', [
          
        ]);
    }
    #[Route('/inscription_passager', name:'app_inscri')]
    public function inscri(): Response
    {
      
        return $this->render('main/inscrire2.html.twig', [
          
        ]);
    }


}