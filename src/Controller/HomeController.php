<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function homepage ()
    {

        return new Response('coucou');
    }

    /**
     * @Route("/contact")
     */
    public function contactpage ()
    {

        return new Response('contact');
    }


    /**
     * @Route("/{titlearticle}")
     */
    public function articlepage ($titlearticle)
    {

        return $this->render('article/show.html.twig' , [
            'title' =>ucwords(str_replace('-', ' ',$titlearticle))
        ]);

    }

}