<?php

namespace App\Controller;

use App\Repository\RatingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/rating', name: 'rating_')]
class RatingController extends AbstractController
{
    #[Route('/passager', name: 'passager')]
    public function ratingPassager( RatingRepository $ratingRepository,  ): Response
    {
        $user=$this->getUser();
        // $ratings=$ratingRepository->findBy(['user'=>$user]);
        $ratings=$ratingRepository->findAll();
        return $this->render('rating/passager.html.twig', [
            'ratings'=>$ratings,
            
            
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