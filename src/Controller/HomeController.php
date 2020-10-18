<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
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

        return new Response(sprintf(
            'blablabla "%t"',
            $titlearticle
        ));
    }

}