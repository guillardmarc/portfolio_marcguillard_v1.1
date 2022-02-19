<?php

namespace App\Controller\admin;

use App\Entity\ProfessionnalCareers;
use App\Form\ProfessionnalCareersType;
use App\Repository\ProfessionnalCareersRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/professionnal_careers")
 * @IsGranted("ROLE_ADMIN")
 */
class ProfessionnalCareersController extends AbstractController
{
    /**
     * @Route("/", name="professionnal_careers_index", methods={"GET"})
     */
    public function index(ProfessionnalCareersRepository $professionnalCareersRepository): Response
    {
        return $this->render('admin/professionnal_careers/index.html.twig', [
            'professionnal_careers' => $professionnalCareersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="professionnal_careers_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $professionnalCareer = new ProfessionnalCareers();
        $form = $this->createForm(ProfessionnalCareersType::class, $professionnalCareer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $professionnalCareer->setCreatedAt(new DateTime())
                                ->setModifiedAt(new DateTime());
            $entityManager->persist($professionnalCareer);
            $entityManager->flush();

            return $this->redirectToRoute('professionnal_careers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/professionnal_careers/new.html.twig', [
            'professionnal_career' => $professionnalCareer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="professionnal_careers_show", methods={"GET"})
     */
    public function show(ProfessionnalCareers $professionnalCareer): Response
    {
        return $this->render('admin/professionnal_careers/show.html.twig', [
            'professionnal_career' => $professionnalCareer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="professionnal_careers_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProfessionnalCareers $professionnalCareer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProfessionnalCareersType::class, $professionnalCareer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $professionnalCareer->setModifiedAt(new DateTime());
            $entityManager->flush();

            return $this->redirectToRoute('professionnal_careers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/professionnal_careers/edit.html.twig', [
            'professionnal_career' => $professionnalCareer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="professionnal_careers_delete", methods={"POST"})
     */
    public function delete(Request $request, ProfessionnalCareers $professionnalCareer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$professionnalCareer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($professionnalCareer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('professionnal_careers_index', [], Response::HTTP_SEE_OTHER);
    }
}
