<?php
/**
 * Created by PhpStorm.
 * User: Rémi Zolend
 * Date: 15/06/2019
 * Time: 15:57
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    public function userRender($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository('App\Entity\Users')->find($id);

        return $this->render('user.html.twig', ['user' => $user]);
    }
}