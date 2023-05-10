<?php

namespace App\Controller;

use App\Entity\Driver;
use App\Entity\User;
use App\Entity\Vehicule;
use App\Form\DriverFromType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\VehiculeRepository;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;





#[Route('/driver', name: 'driver_')]
class DriverController extends AbstractController

{
    
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('driver/index.html.twig', [
            'controller_name' => 'DriverController',
        ]);

    }


    

    #[Route('/ajout' , name:'add',methods:['POST','GET'])]
    public function add(  Request $request, EntityManagerInterface $em ,VehiculeRepository $Rep  ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_PASSAGER');
        //On crée un "nouveau driver"
        $driver = new Driver();
        // On crée le formulaire
        $driverForm = $this->createForm(DriverFromType::class, $driver ,array( ));
        // On traite la requête du formulaire
        $driverForm->handleRequest($request);
        //On vérifie si le formulaire est soumis ET valide
        if($driverForm->isSubmitted() && $driverForm->isValid() ){
           //on récupère user 
          $user= $this->getUser();
          //on récupère véhicule
           $p = $Rep->findBy([], ['id' => 'desc'],1,0);
            $vehicule= $p[0];
             // Ajout du rôle "ROLE_ADMIN"
             $user->getRoles();
             $user->setRoles(['ROLE_DRIVER']);
            //on ajout user et vehicule 
            $driver->setUser($user);
            $driver->setVehicule($vehicule);
            // On stocke
            $em->persist($user);
            $em->persist($driver);
            $em->flush();
            $this->addFlash('success', 'Driver ajouté avec succès');  
            // On redirige
             return $this->redirectToRoute('chauffeur_index');
      }
         return $this->render('driver/add.html.twig',[
           'driverForm' => $driverForm->createView()
      ]);
   }
    #[Route('/modePassager' , name:'modePassager')]
    public function modePassager(Request $request, EntityManagerInterface $em , userRepository $userRepository):Response
    {
        $user= $this->getUser();
        $idUser=$user->getId();
        $user = $userRepository->find($idUser);
          
          // Ajout du rôle "ROLE_ADMIN"
           $user->getRoles();
          $user->setRoles(['ROLE_PASSAGER']);
          
        
          // On stocke
          $em->persist($user);
       
          $em->flush();
          return $this->redirectToRoute('passager_index');
    }
    #[Route('/modeDriver' , name:'modeDriver')]
    public function modeDriver( EntityManagerInterface $em , userRepository $userRepository,TokenStorageInterface $tokenStorage ):Response
    {
        $user= $this->getUser();
         $idUser=$user->getId();
        $user = $userRepository->find($idUser);
          
          // Ajout du rôle "ROLE_ADMIN"
           $user->getRoles();
          $user->setRoles(['ROLE_DRIVER']);
         
          // On stocke
          $em->persist($user);
          
       
          $em->flush();
          
          
          return $this->redirectToRoute('chauffeur_index');
          
    }



 
    //Inject the token storage in your controller or service
    // public function updateUserRoles(EntityManagerInterface $em,  TokenStorageInterface $tokenStorage)
    // {

    
    //     // Get the current token
    //     $token = $tokenStorage->getToken();
        
    //     // Update the user's roles in the database
    //     $user = $token->getUser();
    //     $user->setRoles(['ROLE_DRIVER']);
    //     $em->flush();

    //     // Update the token with the new roles
    //     $token->setRoles($user->getRoles());
    //     $tokenStorage->setToken($token);
        
    //     // Redirect the user to a page associated with the new role
    //     return $this->redirectToRoute('chauffeur_index');
    //     }
    //     // Redirect the user to a page associated with the new role
    
        
    

    // // Inject the token storage in your controller or service
    // public function updateUserRolesPassager(EntityManagerInterface $em,  TokenStorageInterface $tokenStorage)
    // {

        
    //     // Get the current token
    //     $token = $tokenStorage->getToken();
        
    //     // Update the user's roles in the database
    //     $user = $token->getUser();
    //     $user->setRoles(['ROLE_PASSAGER']);
    //     $em->flush();

    //     // Update the token with the new roles
    //     $token->setRoles($user->getRoles());
    //     $tokenStorage->setToken($token);
        
    //     // Redirect the user to a page associated with the new role
    //     return $this->redirectToRoute('passager_index');
    //     }
    //     // Redirect the user to a page associated with the new role
    
   
    // inject the TokenStorageInterface in your controller or service
   
    

}