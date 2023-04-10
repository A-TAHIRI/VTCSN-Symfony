<?php

namespace App\Controller;

use App\Entity\Ride;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\RideFormType;
use App\Form\RideNewFormType;
use App\Repository\DriverRepository;
use App\Repository\RideRepository;
use App\Repository\RideRepository\findAllAsArray;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/passager', name: 'passager_')]
class PassagerController extends AbstractController
{
    
    #[Route('/', name: 'index')]
    public function index(): Response
    {
    ;
        return $this->render('passager/index.html.twig', [
           
        ]);
    }
  

    #[Route('/{id}/commandNew', name: 'newCommand', methods:['GET','POST'])]
    public function newCommand(Request $request, EntityManagerInterface $em, User $user): Response

    {
          //On crée un "nouveau Ride"
        $ride= new Ride();
        // On crée le formulaire
        $rideNewForm = $this->createForm(RideNewFormType::class, $ride ,array( ));
         // On traite la requête du formulaire
         $rideNewForm->handleRequest($request); 
         //On vérifie si le formulaire est soumis ET valide
        if($rideNewForm->isSubmitted() && $rideNewForm->isValid() ){

            
        
             // On stocke
             $em->persist($ride);
             $em->flush();
 
             $this->addFlash('success', 'demand  efféctué');
             
             // On redirige
              return $this->redirectToRoute('passager_suivre' , ['id' => $user->getId(),'id2' => $ride->getId()]);



        }
           
        return $this->render('passager/command.html.twig', [
            'rideForm'=>$rideNewForm->createView()
           
        ]);
    }


    #[Route('/{id}/command', name: 'command', methods:['GET','POST'])]
    public function Command(Request $request, EntityManagerInterface $em, User $user): Response

    {
          //On crée un "nouveau Ride"
        $ride= new Ride();
        // On crée le formulaire
        $rideForm = $this->createForm(RideFormType::class, $ride ,array( ));
         // On traite la requête du formulaire
         $rideForm->handleRequest($request); 
         //On vérifie si le formulaire est soumis ET valide
        if($rideForm->isSubmitted() && $rideForm->isValid() ){

            
        
             // On stocke
             $em->persist($ride);
             $em->flush();
 
             $this->addFlash('success', 'demand  efféctué');
             
             // On redirige
              return $this->redirectToRoute('passager_suivre' , ['id' => $user->getId() ,'id2' => $ride->getId()]);



        }
           
        return $this->render('passager/newCommand.html.twig', [
            'rideForm'=>$rideForm->createView()
           
        ]);
    }
    #[Route('/{id}/mesCommands', name: 'mesCommands', methods :['GET'])]
    public function mesCommands  (EntityManagerInterface $em,  RideRepository $rideRepository ): Response
    {

       $user=$this->getUser();// Récupérer l'utilisateur connecté

        // $rides = $em
        //     ->getRepository(Ride::class)
        //     ->findTrajetsByUser($user);
        
        // $rides = $em->getRepository(Ride::class)->findBy(['user' => $user]);
          $rides=$rideRepository->findBy(['user'=>$user]);
        
        return $this->render('passager/mesCommands.html.twig', ['rides'=>$rides,
        'user'=>$user
       
        ]);
       
    }
    
    #[Route('/{id}/suivreCommande/{id2}', name: 'suivre')]
    public function suivreCommande  (): Response
    
    {
       
       
        return $this->render('passager/suivreCommand.html.twig', [
           
        ]);
    }


    #[Route('/{id}', name: 'profil', methods :['GET'])]
    public function profil(UserRepository $userRepository): Response
    {
        $user=$userRepository;
        return $this->render('passager/profil.html.twig', [
            'user' => $user,
        ]);
    }
    
    #[Route('/{id}/edit', name:'edit', methods:['GET','POST'])]
    public function edit( request $request, User $user, UserRepository $userRepository, EntityManagerInterface $em,UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
                
      
                $em->persist($user);
                $em->flush();
    
                $this->addFlash('success', 'user modifié avec succès');
    
                // On redirige
                return $this->redirectToRoute('passager_index');
        }

        return $this->render('passager/edit.html.twig', [
            'user' => $user,
            'registrationForm' => $form,
        ]);
    }

    
  
}