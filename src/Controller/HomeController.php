<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
// Creating new class: HomeController
class HomeController extends AbstractController
{
    // Adding the access, '/' become the function above
    #[Route('/', 'home')]
    //I create the method "home"
    public function home(){
        // This method return to home.html.twig
        return $this->render('home.html.twig');
    }
}
