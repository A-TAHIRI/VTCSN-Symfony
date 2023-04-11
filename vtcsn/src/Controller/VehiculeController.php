<?php

namespace App\Controller;

use App\Entity\Driver;
use App\Entity\User;
use App\Entity\Vehicule;
use App\Form\VehiculeFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VehiculeRepository;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\String\Slugger\SluggerInterface;


#[Route('/vehicule', name: 'vehicule_')]
class VehiculeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(VehiculeRepository $VehiculeRepository): Response
    {
    
        return $this->render('vehicule/index.html.twig', [
            'vehicule' =>$VehiculeRepository->findBy([]),
        ]);
    }


    #[Route('/ajout', name:'add')]
    public function add( Request $request, EntityManagerInterface $em,SluggerInterface $slugger ): Response
    {
       

        //On crée un "nouveau produit"
        $vehicule = new Vehicule();

        // On crée le formulaire
        $vehiculeForm = $this->createForm(VehiculeFormType::class, $vehicule);

        // On traite la requête du formulaire
        $vehiculeForm->handleRequest($request);
    
        //On vérifie si le formulaire est soumis ET valide
        if($vehiculeForm->isSubmitted() && $vehiculeForm->isValid()){;
            // On récupère les images
            $photo = $vehiculeForm->get('image')->getData();
            
            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photo) {
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photo->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
            } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $vehicule->setImage( $newFilename);
            }
         
                // On stocke
            
          
            // On stocke
            $em->persist($vehicule);
            
            $em->flush();

            $this->addFlash('success', 'Voiture ajouté avec succès');

            // On redirige
             return $this->redirectToRoute('driver_add');
        }
        


         return $this->render('vehicule/add.html.twig',[
           'vehiculeForm' => $vehiculeForm->createView()

           
      ]);

       // return $this->renderForm('admin/product/add.html.twig', compact('productForm'));
        // ['productForm' => $productForm]
    }

    
   
}