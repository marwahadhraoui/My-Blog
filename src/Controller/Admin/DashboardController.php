<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use App\Entity\Category;
use App\Entity\Chambre;
use App\Entity\Client;
use App\Entity\Contact;
use App\Entity\Hotel;
use App\Entity\Post;
use App\Entity\Reservation;
use App\Entity\ReservationHotel;
use App\Entity\ReservationService;
use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('My Blog');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Blog-Post', 'fas fa-list', Post::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-list', Service::class);
        yield MenuItem::linkToCrud('Chambres', 'fas fa-list', Chambre::class);
        yield MenuItem::linkToCrud('Checks', 'fas fa-list', Reservation::class);
        yield MenuItem::linkToCrud('Hotels', 'fas fa-list', Hotel::class);
        yield MenuItem::linkToCrud('Réservation Hotel', 'fas fa-list', ReservationHotel::class);
        yield MenuItem::linkToCrud('Réservation Service', 'fas fa-list', ReservationService::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-list', Contact::class);







    }
}
