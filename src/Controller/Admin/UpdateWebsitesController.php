<?php

namespace App\Controller\Admin;

use App\Entity\UpdateWebsites;
use App\Form\UpdateWebsitesType;
use App\Repository\UpdateWebsitesRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/update/websites")
 */
class UpdateWebsitesController extends AbstractController
{
    /**
     * @Route("/", name="update_websites_index", methods={"GET"})
     */
    public function index(UpdateWebsitesRepository $updateWebsitesRepository): Response
    {
        return $this->render('admin_pages/update_websites/index.html.twig', [
            'update_websites' => $updateWebsitesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="update_websites_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $updateWebsite = new UpdateWebsites();
        $form = $this->createForm(UpdateWebsitesType::class, $updateWebsite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $updateWebsite->setCreatedAt(new DateTime())
                          ->setModifiedAt(new DateTime());
            $entityManager->persist($updateWebsite);
            $entityManager->flush();

            return $this->redirectToRoute('update_websites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_pages/update_websites/new.html.twig', [
            'update_website' => $updateWebsite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="update_websites_show", methods={"GET"})
     */
    public function show(UpdateWebsites $updateWebsite): Response
    {
        return $this->render('admin_pages/update_websites/show.html.twig', [
            'update_website' => $updateWebsite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="update_websites_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, UpdateWebsites $updateWebsite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UpdateWebsitesType::class, $updateWebsite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $updateWebsite->setModifiedAt(new DateTime());
            $entityManager->flush();

            return $this->redirectToRoute('update_websites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_pages/update_websites/edit.html.twig', [
            'update_website' => $updateWebsite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="update_websites_delete", methods={"POST"})
     */
    public function delete(Request $request, UpdateWebsites $updateWebsite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$updateWebsite->getId(), $request->request->get('_token'))) {
            $entityManager->remove($updateWebsite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('update_websites_index', [], Response::HTTP_SEE_OTHER);
    }
}
