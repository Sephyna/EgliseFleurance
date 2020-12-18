<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")

     */
    public function contactPage(Request $request, \Swift_Mailer $mailer)
    {
        $contactForm = $this->createForm(ContactType::class);

        $contactForm->handleRequest($request);


        if($contactForm->isSubmitted() && $contactForm->isValid())
        {
            $contactFormData = $contactForm->getData();

            $message = (new \Swift_Message('Message Eglise Fleurance : '.$contactFormData['subject']))
                ->setFrom($contactFormData['email'])
                ->setTo('daniel.morata@umc-cse.org')
                ->setBody (
                    $this->renderView(
                        'contact/email.html.twig', ['contactFormData' => $contactFormData]                    ),
                    'text/html'
                );

            $mailer->send($message);
            $this->addFlash('info', 'votre message a été envoyé avec succès');
            return $this->redirect($this->generateUrl('contact', ['_fragment'=>'body']));
        }
        else if ($contactForm->isSubmitted() && !$contactForm->isValid())
        {
            $this->addFlash('error', 'L\'envoie du message a échoué');
            return $this->redirect($this->generateUrl('contact', ['_fragment'=>'body']));
        }

        return $this->render('contact/show.html.twig', [
            'form' => $contactForm,
            'form' => $contactForm->createView(),
        ]);
    }



}
