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
    public function index(VehiculeRepository $vehiculeRepository): Response
    {
    
        $user = $this->getUser(); // Récupère l'utilisateur connecté

        if (!$this->isGranted('ROLE_DRIVER')) {
            // Si l'utilisateur n'a pas le rôle "ROLE_DRIVER", retournez une réponse appropriée
            return $this->render('vehicule/index.html.twig', [
                'vehicules' => [],
                'error' => "Vous n'êtes pas un chauffeur.",
            ]);
        }

        $vehicules = $vehiculeRepository->findByUser($user); // Récupère les véhicules de l'utilisateur connecté

        return $this->render('vehicule/index.html.twig', [
            'vehicules' => $vehicules,
        ]);
    }

   
    #[Route('/ajout', name:'add', methods:['POST','GET'])]
    public function add( Request $request, EntityManagerInterface $em,SluggerInterface $slugger ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_PASSAGER');
        //On crée un "nouveau vehicule"
        $vehicule = new Vehicule();
        // On crée le formulaire
        $vehiculeForm = $this->createForm(VehiculeFormType::class, $vehicule);
        // On traite la requête du formulaire
        $vehiculeForm->handleRequest($request);
        //On vérifie si le formulaire est soumis ET valide
        if($vehiculeForm->isSubmitted() && $vehiculeForm->isValid()){;
            // On récupère les images
            $photo = $vehiculeForm->get('image')->getData();
            //Vérifie si une image a été soumis
            if ($photo) {
                // Extrait le non du fichier d'origine
                $originalFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                // Transfforme le nom de fichier "sécurisé"
                // en utilisant un slugger (qui remplace les caractères spéciaux par des tirets)
                $safeFilename = $slugger->slug($originalFilename);
                //Ajoute un identifiant unique généré par uniqid() pour éviter les confilits de noms de fichiers 
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photo->guessExtension();
                // Déplace le fichier téléchargé vers un répertoire défini par la constante 
                try {
                    $photo->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
            } catch (FileException $e) {
                    // Gère une exeption si quelque chose se passe mal lors du téléchargement du fichier 
                }
                // Stocke le nom de fichier sécurisé généré dans l'objet $vehicule
                $vehicule->setImage( $newFilename);
            } 
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
    }

    
   
}