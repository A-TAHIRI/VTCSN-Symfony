<?php

namespace App\Controller;

use App\Entity\Rating;
use App\Entity\Ride;
use App\Repository\RatingRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/rating', name: 'rating_')]
class RatingController extends AbstractController
{
    #[Route('/passager', name: 'passager')]
    public function ratingPassager( EntityManagerInterface $em, RatingRepository $ratingRepository   ): Response
    {
       $user=$this->getUser();
        $ratings = $em
        ->getRepository(Rating::class)
          ->findTrajetsByRide($user);

   

        // $ratings=$ratingRepository->findBy(['user'=>$user]);
        // $ratings=$em->getRepository(Rating::class)->findTrajetsByRide($rides);
        return $this->render('rating/passager.html.twig', [
            'ratings'=>$ratings,
            'user'=>$user
            
            
        ]);
    }
    #[Route('/driver', name: 'driver')]
    public function ratingDriver( RatingRepository $ratingRepository,  ): Response
    {
        $user=$this->getUser();
        // $ratings=$ratingRepository->findBy(['user'=>$user]);
        $ratings=$ratingRepository->findAll();
        return $this->render('rating/driver.html.twig', [
            'ratings'=>$ratings,
            
            
        ]);
    }
}