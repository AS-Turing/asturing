<?php

namespace App\Controller\Admin;

use App\Entity\BlogPost;
use App\Entity\Client;
use App\Entity\Project;
use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        // Redirect to Projects CRUD by default
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProjectCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('AS Turing - Admin')
            ->setFaviconPath('favicon.ico');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        
        yield MenuItem::section('Contenu');
        yield MenuItem::linkToCrud('Projets', 'fas fa-code', Project::class);
        yield MenuItem::linkToCrud('Blog', 'fas fa-newspaper', BlogPost::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-cogs', Service::class);
        
        yield MenuItem::section('Pages');
        yield MenuItem::linkToCrud('Page Contact', 'fas fa-envelope', \App\Entity\ContactPage::class);
        yield MenuItem::linkToCrud('Page Process', 'fas fa-tasks', \App\Entity\ProcessPage::class);
        
        yield MenuItem::section('Général');
        yield MenuItem::linkToCrud('Clients', 'fas fa-users', Client::class);
        yield MenuItem::linkToCrud('Messages Contact', 'fas fa-inbox', \App\Entity\ContactMessage::class);
        
        yield MenuItem::section('Service - Détails');
        yield MenuItem::linkToCrud('FAQ Services', 'fas fa-question-circle', \App\Entity\ServiceFaq::class);
        yield MenuItem::linkToCrud('Process Steps', 'fas fa-list-ol', \App\Entity\ServiceProcessStep::class);
        yield MenuItem::linkToCrud('Solutions', 'fas fa-lightbulb', \App\Entity\ServiceSolution::class);
        yield MenuItem::linkToCrud('Technologies', 'fas fa-microchip', \App\Entity\ServiceTechnology::class);
        
        yield MenuItem::section('Site');
        yield MenuItem::linkToUrl('Voir le site', 'fas fa-eye', '/');
    }
}
