<?php

namespace App\Controller;

use App\Form\ContactMeType;
use App\Repository\HobbiesRepository;
use App\Repository\PresentationsRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class BasicPagesController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function home(
        HobbiesRepository $hobbiesRepository,
        PresentationsRepository $presentationsRepository,
        Request $request,
        MailerInterface $mailer
    ): Response
    {
        $form = $this->createForm(ContactMeType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $form->get('company')->getData() == Null) {
            $rep = $presentationsRepository->findOneBy([], ['id'=>'ASC']);
            $emailTo = $rep->getEmail();
            
            $email = (new TemplatedEmail())
                ->from('no-reply@marcguillard.fr')
                ->to($emailTo)
                ->priority(Email::PRIORITY_HIGH)
                ->subject($form->get('objet')->getData())
                ->htmlTemplate('basic_pages\_contact_me_email.html.twig')
                ->context([ 
                    'fromEmail'=>$form->get('email')->getData(),
                    'name'=>$form->get('name')->getData(),
                    'phone'=>$form->get('phone')->getData(),
                    'objet'=>$form->get('objet')->getData(),
                    'message'=>$form->get('message')->getData(),
                ]);
    
                $mailer->send($email);

            $this->addFlash('success', 'Votre message à bien été envoyer!');
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
        elseif ($form->isSubmitted() && $form->isValid() && $form->get('company')->getData() != Null) {
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('basic_pages/index.html.twig', [
            'hobbies' => $hobbiesRepository->findAll(),
            'form'=>$form->createView()
        ]);
    }
}
