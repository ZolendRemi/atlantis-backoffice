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
        $users = $entityManager->getRepository('App\Entity\Users');
        $devicesList = $entityManager->getRepository('App\Entity\Devices')->findAll();
        $user = $users->find($id);

        return $this->render('user.html.twig', ['user' => $user, 'devices' => $devicesList]);
    }

    public function AddDevice($userId,$deviceId){
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository('App\Entity\Users')->find($userId);
        $device = $entityManager->getRepository('App\Entity\Devices')->find($deviceId);

        $user->addDevice($device);
        $device->addUser($user);

        $entityManager->persist($device);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('userPage',['id'=>$user->getId()]);

    }

    public function UnsubDevice($userId,$deviceId){
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository('App\Entity\Users')->find($userId);
        $device = $entityManager->getRepository('App\Entity\Devices')->find($deviceId);

        $user->getDevices()->removeElement($device);
        $device->getUsers()->removeElement($user);

        $entityManager->flush();

        return $this->redirectToRoute('userPage',['id'=>$user->getId()]);
    }
}