<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\LoginType;

class LoginController extends AbstractController
{
    /**
     * @Route("/login2", name="login")
     */
    public function loginPage(Request $request)
    {

        $loginForm = $this->createForm(LoginType::class);

        $loginForm->handleRequest($request);

        return $this->render('login/index.html.twig', [
            'form' => $loginForm,
            'form' => $loginForm->createView(),
        ]);

    }
}
