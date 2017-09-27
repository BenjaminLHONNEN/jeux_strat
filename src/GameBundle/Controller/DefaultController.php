<?php

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/game")
     */
    public function indexAction()
    {
        return $this->render('GameBundle:Default:index.html.twig');
    }
    /**
     * @Route("/test")
     */
    public function testAction()
    {
        return $this->render('GameBundle:Default:test.html.twig');
    }
}
