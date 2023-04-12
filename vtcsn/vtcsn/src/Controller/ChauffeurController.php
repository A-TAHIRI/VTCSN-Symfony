<?php

namespace App\Controller;

use App\Entity\Driver;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\DriverRepository;
use App\Repository\RideRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chauffeur', name: 'chauffeur_')]
class ChauffeurController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_DRIVER');
        return $this->render('chauffeur/index.html.twig', [
          
        ]);
    }
    

   
    #[Route('/cours', name: 'newCours')]
    public function newCours(): Response
    {
        return $this->render('chauffeur/newCours.html.twig', [
           
        ]);
    }

    #[Route('/mesCours', name: 'mesCours')]
    public function mesCours  (Driver $driver, EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy([
            'roles' => 'ROLE_ADMIN'
        ]);
       $users= $user= $this->getUser();// Récupérer l'utilisateur connecté
         $rides = $em
           ->getRepository(Ride::class)
            ->findTrajetsByUser($user);
        
        
        return $this->render('chauffeur/mesCours.html.twig', ['rides'=>$rides,
        'user'=>$driver,
           
        ]);
    }

   
    #[Route('/{id}', name: 'profil', methods :['GET'])]
    public function profil(DriverRepository $driverRepository): Response
    {
        $driver=$driverRepository;
        return $this->render('chauffeur/profil.html.twig', [
            'driver' => $driver,
        ]);
    }

    
    #[Route('/{id}/edit', name:'edit', methods:['GET','POST'])]
    public function edit(request $request, User $user, UserRepository $userRepository, EntityManagerInterface $em,UserPasswordHasherInterface $userPasswordHasher): Response
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
                return $this->redirectToRoute('chauffeur_index');
        }

        return $this->render('chauffeur/edit.html.twig', [
            'user' => $user,
            'registrationForm' => $form,
        ]);
    }






   
  
}