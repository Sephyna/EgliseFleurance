<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/" , name="home")
     */
    public function homepage ()
    {

        return $this->render('home/show.html.twig' );
    }


//    /**
//     * @Route("/{titlearticle}")
//     */
//    public function articlepage ($titlearticle)
//    {
//
//        return $this->render('article/show.html.twig' , [
//            'title' =>ucwords(str_replace('-', ' ',$titlearticle))
//        ]);
//
//    }

}