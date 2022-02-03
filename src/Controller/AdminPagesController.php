<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPagesController extends AbstractController
{
    /**
     * @Route("/admin/pages", name="admin_pages")
     */
    public function index(): Response
    {
        return $this->render('admin_pages/index.html.twig', [
            'controller_name' => 'AdminPagesController',
        ]);
    }
}
