<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConnexionController extends AbstractController
{
    public function renderingConnexionPage(){
        return $this->render('connexionPage.html.twig');
    }

}