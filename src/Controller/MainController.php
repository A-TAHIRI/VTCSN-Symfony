<?php

namespace App\Controller;

use App\Repository\RatingRepository;
use App\Repository\VehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;



class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(VehiculeRepository $vehiculeRepository, RatingRepository $ratingRepository, KernelInterface $kernel): Response
    {
        // Charger le fichier JSON
        $projectDir = $kernel->getProjectDir();
        $jsonFile = $projectDir . '/public/Json/vehicule.json';
        $jsonData = json_decode(file_get_contents($jsonFile), true);;

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            // 'vehicule' => $vehiculeRepository->findby([]),
            'rating' => $ratingRepository->findby([]),
            'data' => $jsonData, // Ajoutez les données JSON ici
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
    #[Route('/Services', name:'app_services')]
    public function services(): Response
    {
      
        return $this->render('main/services.html.twig', [
          
        ]);
    }


}