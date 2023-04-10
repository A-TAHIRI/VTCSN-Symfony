<?php

namespace App\Controller;

use App\Entity\Ride;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ride', name: 'ride_')]
class RideController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('ride/index.html.twig', [
            
        ]);
    }
    #[Route('/add', name: 'add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
       //On crée un "nouveau Ride"
        $ride= new Ride();
        // On crée le formulaire
        $rideForm = $this->createForm(RideFromType::class, $ride ,array( ));
         // On traite la requête du formulaire
         $rideForm->handleRequest($request); 
         //On vérifie si le formulaire est soumis ET valide
        if($rideForm->isSubmitted() && $rideForm->isValid() ){
            // On récupér user 
            $user= $this->getUser();
            $ride->setUser($user);

             // On stocke
             $em->persist($ride);
             $em->flush();
 
             $this->addFlash('success', 'demand  efféctué');
             
             // On redirige
              return $this->redirectToRoute('chauffeur_index');



        }
           

          
        return $this->render('ride/add.html.twig', [
            
        ]);
    }
 
 


}