<?php

namespace App\Controller\Admin;

use App\Entity\Establishments;
use App\Form\EstablishmentsType;
use App\Repository\EstablishmentsRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/establishments")
 */
class EstablishmentsController extends AbstractController
{
    /**
     * @Route("/", name="establishments_index", methods={"GET"})
     */
    public function index(EstablishmentsRepository $establishmentsRepository): Response
    {
        return $this->render('admin_pages/establishments/index.html.twig', [
            'establishments' => $establishmentsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="establishments_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $establishment = new Establishments();
        $form = $this->createForm(EstablishmentsType::class, $establishment);
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
            $this->getParameter('picture_establishments_directory'),
            $newFilename
            );
            } catch (FileException $e) {
            // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
            }
            // Sauvegarde du nom dans la base de donnée
            $establishment->setPictureLink("uploads/establishments/".$newFilename);
            }
            /** Fin du code à ajouter **/

            $establishment->setCreatedAt(new DateTime())
                          ->setModifiedAt(new DateTime());
            
            $entityManager->persist($establishment);
            $entityManager->flush();

            return $this->redirectToRoute('establishments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_pages/establishments/new.html.twig', [
            'establishment' => $establishment,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="establishments_show", methods={"GET"})
     */
    public function show(Establishments $establishment): Response
    {
        return $this->render('admin_pages/establishments/show.html.twig', [
            'establishment' => $establishment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="establishments_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Establishments $establishment, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(EstablishmentsType::class, $establishment);
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
            $this->getParameter('picture_establishments_directory'),
            $newFilename
            );
            } catch (FileException $e) {
            // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
            }
            // Sauvegarde du nom dans la base de donnée
            $establishment->setPictureLink("uploads/establishments/".$newFilename);
            }
            /** Fin du code à ajouter **/

            $establishment->setModifiedAt(new DateTime());

            $entityManager->flush();

            return $this->redirectToRoute('establishments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_pages/establishments/edit.html.twig', [
            'establishment' => $establishment,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="establishments_delete", methods={"POST"})
     */
    public function delete(Request $request, Establishments $establishment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$establishment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($establishment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('establishments_index', [], Response::HTTP_SEE_OTHER);
    }
}
