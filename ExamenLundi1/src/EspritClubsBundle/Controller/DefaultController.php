<?php

namespace EspritClubsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EspritClubsBundle:Default:index.html.twig');
    }
}
