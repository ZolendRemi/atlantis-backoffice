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
    public function renderingDashboard(){
        return $this->render('dashboard.html.twig');
    }
}