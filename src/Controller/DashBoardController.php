<?php
/**
 * Created by PhpStorm.
 * User: Rémi Zolend
 * Date: 14/06/2019
 * Time: 12:52
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashBoardController extends AbstractController
{
    public function renderingDashboard()
    {

        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository('App\Entity\Users');
        $devices = $entityManager->getRepository('App\Entity\Devices');

        $usersList = $users->findAllOrderById();
        $allUsers = count($users->findAll());
        $devicesList = $devices->findAllOrderById();
        $allDevices = count($devices->findAll());

        return $this->render('dashboard.html.twig', [
            "users" => $usersList,
            "usersNumber" => $allUsers,
            "devices" => $devicesList,
            "devicesNumber" => $allDevices
        ]);
    }
}