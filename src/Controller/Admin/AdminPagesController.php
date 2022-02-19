<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminPagesController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="app_dashboard")
     * @IsGranted("ROLE_ADMIN")
     */
    public function dashboard(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
