<?php

namespace App\Controller\Admin;

use App\Repository\RecipeRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Recipe;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        public RecipeRepository $repository
    )
    {
    }

    /**
     * @return Response
     */
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $recipe = $this->repository->findAll();
        return $this->render('admin/index.html.twig', [
            'recipes' => $recipe,
        ]);
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Recipes Api');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Recipes', 'fa-solid fa-newspaper', Recipe::class)
            ->setController(RecipeCrudController::class);
    }
}
