<?php

namespace App\Controller\admin;

use App\Entity\WebTechnologies;
use App\Form\WebTechnologiesType;
use App\Repository\WebTechnologiesRepository;
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
 * @Route("/admin/web_technologies")
 * @IsGranted("ROLE_ADMIN")
 */
class WebTechnologiesController extends AbstractController
{
    /**
     * @Route("/", name="web_technologies_index", methods={"GET"})
     */
    public function index(WebTechnologiesRepository $webTechnologiesRepository): Response
    {
        return $this->render('admin/web_technologies/index.html.twig', [
            'web_technologies' => $webTechnologiesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="web_technologies_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $webTechnology = new WebTechnologies();
        $form = $this->createForm(WebTechnologiesType::class, $webTechnology);
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
            $this->getParameter('picture_webtechnologies_directory'),
            $newFilename
            );
            } catch (FileException $e) {
            // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
            }
            // Sauvegarde du nom dans la base de donnée
            $webTechnology->setPictureLink("uploads/webtechnologies/".$newFilename);
            }
            /** Fin du code à ajouter **/

            $webTechnology->setCreatedAt(new DateTime())
                          ->setModifiedAt(new DateTime());
            
            $entityManager->persist($webTechnology);
            $entityManager->flush();

            return $this->redirectToRoute('web_technologies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/web_technologies/new.html.twig', [
            'web_technology' => $webTechnology,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="web_technologies_show", methods={"GET"})
     */
    public function show(WebTechnologies $webTechnology): Response
    {
        return $this->render('admin/web_technologies/show.html.twig', [
            'web_technology' => $webTechnology,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="web_technologies_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, WebTechnologies $webTechnology, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(WebTechnologiesType::class, $webTechnology);
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
            $this->getParameter('picture_webtechnologies_directory'),
            $newFilename
            );
            } catch (FileException $e) {
            // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
            }
            // Sauvegarde du nom dans la base de donnée
            $webTechnology->setPictureLink("uploads/webtechnologies/".$newFilename);
            }
            /** Fin du code à ajouter **/

            $webTechnology->setModifiedAt(new DateTime());
            
            $entityManager->flush();

            return $this->redirectToRoute('web_technologies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/web_technologies/edit.html.twig', [
            'web_technology' => $webTechnology,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="web_technologies_delete", methods={"POST"})
     */
    public function delete(Request $request, WebTechnologies $webTechnology, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$webTechnology->getId(), $request->request->get('_token'))) {
            $entityManager->remove($webTechnology);
            $entityManager->flush();
        }

        return $this->redirectToRoute('web_technologies_index', [], Response::HTTP_SEE_OTHER);
    }
}
