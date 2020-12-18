<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordFormType;
use App\Form\FirstConnectionType;
use App\Form\RegistrationFormType;
use App\Form\ResetPasswordRequestFormType;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/admin/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        // create a random password when registering a member by an admin
        $randomPassword = random_bytes(10);
        $user->setPassword(
            $passwordEncoder->encodePassword(
                $user,
                $randomPassword
            )
        );
        // Default role
        $user->setRoles([
            "ROLE_USER"
        ])
        ;
        //
        $user->setIsVerified(false);

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            // Roles
            if($form->get("rolesRadius")->getData() === "ADMIN")
            {
                $user->setRoles([
                    "ROLE_ADMIN",
                    "ROLE_MODERATOR",
                    "ROLE_USER"
                ])
                ;
            }
            else if ($form->get("rolesRadius")->getData() === "MODERATOR")
            {
                $user->setRoles([
                    "ROLE_MODERATOR",
                    "ROLE_USER"
                ])
                ;
            }
            else
            {
                $user->setRoles([
                    "ROLE_USER"
                ])
                ;
            }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('idkrightnow@mail.com', 'Eglise de Fleurance'))
                    ->to($user->getEmail())
                    ->subject('Bienvenue sur le site de l\'église de Fleurance')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email
            $this->addFlash('success', 'Vous avez bien envoyé un mail d\'inscription à l\'adresse <b>'.$user->getEmail().'</b>');

            return $this->redirectToRoute('app_register');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(FirstConnectionType::class);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emailForm = $form->get('email')->getData();
            dump($emailForm);
//            // Encode the plain password, and set it.
//            $encodedPassword = $passwordEncoder->encodePassword(
//                $user,
//                $form->get('plainPassword')->getData()
//            );
//
//            $user->setPassword($encodedPassword);
//            $this->getDoctrine()->getManager()->flush();
//
//            // The session is cleaned up after the password has been changed.
//            $this->cleanSessionAfterReset();
//
//            return $this->redirectToRoute('home');
            $this->addFlash('success', 'l\'adresse <b>'.$emailForm.'</b>');

        }

        return $this->render('registration/firstconnection.html.twig', [
            'form' => $form->createView(),
        ]);
////        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//
//        // validate email confirmation link, sets User::isVerified=true and persists
//        try {
//            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
//        } catch (VerifyEmailExceptionInterface $exception) {
//            $this->addFlash('verify_email_error', $exception->getReason());
//
//            return $this->redirectToRoute('home');
//        }
//        $this->addFlash('verify_email_error', 'jai reussi');
//
//        // @TODO Change the redirect on success and handle or remove the flash message in your templates
////        $this->addFlash('success', 'Bonjour '.$user->getUsername().', vous êtes bien inscrit comme ' .$user->getRoles(). ' sur le site ! ');
//
//        return $this->redirectToRoute('home');
    }
}
