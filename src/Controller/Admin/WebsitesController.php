<?php

namespace App\Controller\admin;

use App\Entity\Websites;
use App\Form\WebsitesType;
use App\Repository\WebsitesRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/websites")
 * @IsGranted("ROLE_ADMIN")
 */
class WebsitesController extends AbstractController
{
    /**
     * @Route("/", name="websites_index", methods={"GET"})
     */
    public function index(WebsitesRepository $websitesRepository): Response
    {
        return $this->render('admin/websites/index.html.twig', [
            'websites' => $websitesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="websites_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $website = new Websites();
        $form = $this->createForm(WebsitesType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $website->setCreatedAt(new DateTime())
                    ->setModifiedAt(new DateTime());
            $entityManager->persist($website);
            $entityManager->flush();

            return $this->redirectToRoute('websites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/websites/new.html.twig', [
            'website' => $website,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="websites_show", methods={"GET"})
     */
    public function show(Websites $website): Response
    {
        return $this->render('admin/websites/show.html.twig', [
            'website' => $website,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="websites_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Websites $website, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WebsitesType::class, $website);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $website->setModifiedAt(new DateTime());
            $entityManager->flush();

            return $this->redirectToRoute('websites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/websites/edit.html.twig', [
            'website' => $website,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="websites_delete", methods={"POST"})
     */
    public function delete(Request $request, Websites $website, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$website->getId(), $request->request->get('_token'))) {
            $entityManager->remove($website);
            $entityManager->flush();
        }

        return $this->redirectToRoute('websites_index', [], Response::HTTP_SEE_OTHER);
    }
}
