<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Driver;
use App\Entity\Location;
use App\Entity\Rating;
use App\Entity\Ride;
use App\Entity\User;
use App\Entity\Vehicule;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
      

        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Vtcsn')
            ->renderContentMaximized();
    }
    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateFormat('dd/MM/yyyy');
         
    }


    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Driver', 'fas fa-driver', Driver::class);
        yield MenuItem::linkToCrud('Vehicule', 'fas fa-vehicule', Vehicule::class);
        yield MenuItem::linkToCrud('Rating', 'fas fa-rating', Rating::class);
        yield MenuItem::linkToCrud('Location', 'fas fa-location', Location::class);
        yield MenuItem::linkToCrud('Ride', 'fas fa-ride', Ride::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-contact', Contact::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}