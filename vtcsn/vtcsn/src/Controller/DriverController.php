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
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

// session_start();
// if (isset($_POST['login_user'])) {
// //Variables declaration
// $userId = $_POST['user'];
// }

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


    

    #[Route('/ajout' , name:'add')]
    public function add(  Request $request, EntityManagerInterface $em ,VehiculeRepository $Rep  ): Response
    {
       

        //On crée un "nouveau driver"
        $driver = new Driver();

        // On crée le formulaire
        $driverForm = $this->createForm(DriverFromType::class, $driver ,array( ));

        // On traite la requête du formulaire
        $driverForm->handleRequest($request);
    
        //On vérifie si le formulaire est soumis ET valide
        if($driverForm->isSubmitted() && $driverForm->isValid() ){
           
           
          $user= $this->getUser();
       

          // $vehicule=$this->getVhicule();
          // $vehicule->getLicensePlate();
          // $idvehicule=$vehicule->getID();
          // $vehicule=$vehiculeRepository->find($idvehicule);
          
          $p = $Rep->findBy([], ['id' => 'desc'],1,0);
                  $vehicule= $p[0];
                 
          // $idUser=$user->getId();
         // $user = $userRepository->find($idUser);
            
            // Ajout du rôle "ROLE_ADMIN"
             $user->getRoles();
             $user->setRoles(['ROLE_DRIVER']);
            
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
    public function modeDriver(Request $request, EntityManagerInterface $em , userRepository $userRepository ):Response
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

}