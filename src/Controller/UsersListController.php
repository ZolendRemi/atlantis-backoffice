<?php
/**
 * Created by PhpStorm.
 * User: Rémi Zolend
 * Date: 14/06/2019
 * Time: 13:30
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UsersListController extends AbstractController
{
    public function usersListRender()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository('App\Entity\Users');

        $usersList = $users->findAll();

        return $this->render('usersList.html.twig', ['users'=>$usersList]);
    }
}