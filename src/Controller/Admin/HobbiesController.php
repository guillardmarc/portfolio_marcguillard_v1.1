<?php

namespace App\Controller\admin;

use App\Entity\Hobbies;
use App\Form\HobbiesType;
use App\Repository\HobbiesRepository;
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
 * @Route("/admin/hobbies")
 * @IsGranted("ROLE_ADMIN")
 */
class HobbiesController extends AbstractController
{
    /**
     * @Route("/", name="hobbies_index", methods={"GET"})
     */
    public function index(HobbiesRepository $hobbiesRepository): Response
    {
        return $this->render('admin/hobbies/index.html.twig', [
            'hobbies' => $hobbiesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="hobbies_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $hobby = new Hobbies();
        $form = $this->createForm(HobbiesType::class, $hobby);
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
            $this->getParameter('picture_hobbies_directory'),
            $newFilename
            );
            } catch (FileException $e) {
            // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
            }
            // Sauvegarde du nom dans la base de donnée
            $hobby->setPictureLink("uploads/hobbies/".$newFilename);
            }
            /** Fin du code à ajouter **/

            $hobby->setCreatedAt(new DateTime())
                  ->setModifiedAt(new DateTime());

            $entityManager->persist($hobby);
            $entityManager->flush();

            return $this->redirectToRoute('hobbies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/hobbies/new.html.twig', [
            'hobby' => $hobby,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="hobbies_show", methods={"GET"})
     */
    public function show(Hobbies $hobby): Response
    {
        return $this->render('admin/hobbies/show.html.twig', [
            'hobby' => $hobby,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hobbies_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Hobbies $hobby, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(HobbiesType::class, $hobby);
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
            $this->getParameter('picture_hobbies_directory'),
            $newFilename
            );
            } catch (FileException $e) {
            // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
            }
            // Sauvegarde du nom dans la base de donnée
            $hobby->setPictureLink($newFilename);
            }
            /** Fin du code à ajouter **/

            $hobby->setModifiedAt(new DateTime());

            $entityManager->flush();

            return $this->redirectToRoute('hobbies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/hobbies/edit.html.twig', [
            'hobby' => $hobby,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="hobbies_delete", methods={"POST"})
     */
    public function delete(Request $request, Hobbies $hobby, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hobby->getId(), $request->request->get('_token'))) {
            $entityManager->remove($hobby);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hobbies_index', [], Response::HTTP_SEE_OTHER);
    }
}
