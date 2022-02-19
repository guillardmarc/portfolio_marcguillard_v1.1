<?php

namespace App\Controller\admin;

use App\Entity\Achievements;
use App\Entity\PictureAchievements;
use App\Form\AchievementsType;
use App\Repository\AchievementsRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/achievements")
 * @IsGranted("ROLE_ADMIN")
 */
class AchievementsController extends AbstractController
{
    /**
     * @Route("/", name="achievements_index", methods={"GET"})
     */
    public function index(AchievementsRepository $achievementsRepository): Response
    {
        return $this->render('admin/achievements/index.html.twig', [
            'achievements' => $achievementsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="achievements_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $achievement = new Achievements();
        $form = $this->createForm(AchievementsType::class, $achievement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $datetime = new DateTime();
            $savedatetime = $datetime->format('Y-m-d H-i-s');

            /** Début du code à ajouter **/
            // Récupération de la valeur du champs "picture"
            $pictures = $form->get('pictureLink')->getData();
            // Slugage du nom de la catégories
            $name= $slugger->slug($form->get('name')->getData());
            
            foreach($pictures as $picture) {
            $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
            // ceci est nécessaire pour inclure en toute sécurité le nom de fichier dans l'URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $name.'-'.uniqid($safeFilename).'.'.$picture->guessExtension();
            // Déplacez le fichier dans le répertoire où les brochures sont stockées
            try {
            $picture->move(
            $this->getParameter('picture_achievements_directory').'/'.$savedatetime,
            $newFilename
            );
            } catch (FileException $e) {
            // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
            }
            // Sauvegarde du nom dans la base de donnée
            $savepicture = new PictureAchievements();
            $savepicture->setCreatedAt($datetime)
                        ->setName($savedatetime.'/'.$newFilename)
                        ->setLink("uploads/achievements/".$savedatetime.'/'.$newFilename)
                        ->setTop(1);
            
            $achievement->addPicture($savepicture);
            }
            /** Fin du code à ajouter **/

            $achievement->setCreatedAt($datetime)
                        ->setModifiedAt($datetime);
            $entityManager->persist($achievement);
            $entityManager->flush();

            return $this->redirectToRoute('achievements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/achievements/new.html.twig', [
            'achievement' => $achievement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="achievements_show", methods={"GET"})
     */
    public function show(Achievements $achievement): Response
    {
        return $this->render('admin/achievements/show.html.twig', [
            'achievement' => $achievement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="achievements_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Achievements $achievement, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(AchievementsType::class, $achievement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $datetime = new DateTime();
            $createdat = $achievement->getCreatedAt()->format('Y-m-d H-i-s');

            /** Début du code à ajouter **/
            // Récupération de la valeur du champs "picture"
            $pictures = $form->get('pictureLink')->getData();
            // Slugage du nom de la catégories
            $name= $slugger->slug($form->get('name')->getData());
            
            foreach($pictures as $picture) {
            $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
            // ceci est nécessaire pour inclure en toute sécurité le nom de fichier dans l'URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $name.'-'.uniqid($safeFilename).'.'.$picture->guessExtension();
            // Déplacez le fichier dans le répertoire où les brochures sont stockées
            try {
            $picture->move(
            $this->getParameter('picture_achievements_directory').'/'.$createdat,
            $newFilename
            );
            } catch (FileException $e) {
            // ... gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
            }
            // Sauvegarde du nom dans la base de donnée
            $savepicture = new PictureAchievements();
            $savepicture->setCreatedAt($datetime)
                        ->setName($createdat.'/'.$newFilename)
                        ->setLink("uploads/achievements/".$createdat.'/'.$newFilename)
                        ->setTop(1);
            
            $achievement->addPicture($savepicture);
            }
            /** Fin du code à ajouter **/

            $achievement->setModifiedAt($datetime);
            $entityManager->flush();

            return $this->redirectToRoute('achievements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/achievements/edit.html.twig', [
            'achievement' => $achievement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="achievements_delete", methods={"POST"})
     */
    public function delete(Request $request, Achievements $achievement, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        if ($this->isCsrfTokenValid('delete'.$achievement->getId(), $request->request->get('_token'))) {

            // Deleting the folder containing the images
            $createdat = $achievement->getCreatedAt()->format('Y-m-d H-i-s');
            $dir = $this->getParameter('picture_achievements_directory').'/'.$createdat;

            if (is_dir($dir)) {
                $objects = scandir($dir);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (filetype($dir."/".$object) == "dir") {
                            rmdir($dir."/".$object);
                        }
                        else {unlink($dir."/".$object);}
                    }
                }
                reset($objects);
                rmdir($dir);
            }

            $entityManager->remove($achievement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('achievements_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/delect_picture/{id}", name="achievements_picture_delete", methods={"DELETE"})
     */

    public function deleteImage(PictureAchievements $image, Request $request){
        $data = json_decode($request->getContent(), true);

        // We check if the token is valid
        if($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token'])){
            // On récupère le nom de l'image
            $link = $image->getName();
            // On supprime le fichier
            unlink($this->getParameter('picture_achievements_directory').'/'.$link);

            // On supprime l'entrée de la base
            $em=$this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }
}
