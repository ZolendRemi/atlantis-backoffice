<?php
/**
 * Created by PhpStorm.
 * User: Rémi Zolend
 * Date: 15/06/2019
 * Time: 15:58
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeviceController extends AbstractController
{
    public function deviceRender($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $devices = $entityManager->getRepository('App\Entity\Devices');
        $users = $entityManager->getRepository('App\Entity\Users');
        $device = $devices->find($id);
        $usersList = $users->findAll();

        return $this->render('device.html.twig', ['device' => $device, 'users' => $usersList]);
    }

    public function AddUser($deviceId,$userId){
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository('App\Entity\Users')->find($userId);
        $device = $entityManager->getRepository('App\Entity\Devices')->find($deviceId);

        $user->addDevice($device);
        $device->addUser($user);

        $entityManager->persist($device);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('devicePage',['id'=>$device->getId()]);

    }

    public function UnsubUser($deviceId,$userId){
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository('App\Entity\Users')->find($userId);
        $device = $entityManager->getRepository('App\Entity\Devices')->find($deviceId);

        $user->getDevices()->removeElement($device);
        $device->getUsers()->removeElement($user);

        $entityManager->flush();

        return $this->redirectToRoute('devicePage',['id'=>$device->getId()]);
    }
}