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
        $device = $entityManager->getRepository('App\Entity\Devices')->find($id);

        return $this->render('device.html.twig', ['device' => $device]);
    }
}