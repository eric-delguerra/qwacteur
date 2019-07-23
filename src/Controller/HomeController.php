<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController {

    public function home(Environment $twig){
        $content = $twig->render('home.html.twig', ['name' => "Benoit"]);
        return new Response($content);
    }
}