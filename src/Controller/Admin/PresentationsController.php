<?php

namespace App\Controller\admin;

use App\Entity\Presentations;
use App\Form\PresentationsType;
use App\Repository\PresentationsRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin_presentations")
 * @IsGranted("ROLE_ADMIN")
 */
class PresentationsController extends AbstractController
{
    /**
     * @Route("/", name="presentations_index", methods={"GET"})
     */
    public function index(PresentationsRepository $presentationsRepository): Response
    {
        return $this->render('admin/presentations/index.html.twig', [
            'presentations' => $presentationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="presentations_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $presentation = new Presentations();
        $form = $this->createForm(PresentationsType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** Début du code à ajouter **/
            // Récupération de la valeur du champs "picture"
            $picture = $form->get('pictureLink')->getData();
            // Slugage du nom de la catégories
            $name= $slugger->slug($form->get('name')->getData());
            
            if ($picture) {
            $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
            // ceci est nécessaire pour inclure en toute sécurité le nom de fichier dans l'URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $name.'-'.uniqid($safeFilename).'.'.$picture->guessExtension();
            // Déplacez le fichier dans le répertoire où les brochures sont stockées
            try {
            $picture->move(
            $this->getParameter('picture_presentations_directory'),
            $newFilename
            );
            } catch (FileException $e) {
            // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
            }
            // Sauvegarde du nom dans la base de donnée
            $presentation->setPictureLink("uploads/presentations/".$newFilename);
            }
            /** Fin du code à ajouter **/

            $presentation->setCreatedAt(new DateTime())
                         ->setModifiedAt(new DateTime());

            $entityManager->persist($presentation);
            $entityManager->flush();

            return $this->redirectToRoute('presentations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/presentations/new.html.twig', [
            'presentation' => $presentation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="presentations_show", methods={"GET"})
     */
    public function show(Presentations $presentation): Response
    {
        return $this->render('admin/presentations/show.html.twig', [
            'presentation' => $presentation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="presentations_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Presentations $presentation, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(PresentationsType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** Début du code à ajouter **/
            // Récupération de la valeur du champs "picture"
            $picture = $form->get('pictureLink')->getData();
            // Slugage du nom de la catégories
            $name= $slugger->slug($form->get('job')->getData());
            
            if ($picture) {
            $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
            // ceci est nécessaire pour inclure en toute sécurité le nom de fichier dans l'URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $name.'-'.uniqid($safeFilename).'.'.$picture->guessExtension();
            // Déplacez le fichier dans le répertoire où les brochures sont stockées
            try {
            $picture->move(
            $this->getParameter('picture_presentations_directory'),
            $newFilename
            );
            } catch (FileException $e) {
            // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
            }
            // Sauvegarde du nom dans la base de donnée
            $presentation->setPictureLink("uploads/presentations/".$newFilename);
            }
            /** Fin du code à ajouter **/

            $presentation->setModifiedAt(new DateTime());
            
            $entityManager->flush();

            return $this->redirectToRoute('presentations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/presentations/edit.html.twig', [
            'presentation' => $presentation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="presentations_delete", methods={"POST"})
     */
    public function delete(Request $request, Presentations $presentation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presentation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($presentation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('presentations_index', [], Response::HTTP_SEE_OTHER);
    }
}
