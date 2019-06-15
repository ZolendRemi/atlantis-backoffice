<?php
/**
 * Created by PhpStorm.
 * User: Rémi Zolend
 * Date: 14/06/2019
 * Time: 13:30
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DevicesListController extends AbstractController
{
    public function devicesListRender()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $devices = $entityManager->getRepository('App\Entity\Devices');

        $devicesList = $devices->findAll();

        return $this->render('devicesList.html.twig', ['devices'=>$devicesList]);
    }
}