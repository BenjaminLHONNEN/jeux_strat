<?php

namespace DocApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/api")
     */
    public function indexAction()
    {
        return $this->render('DocApiBundle:Default:index.html.twig');
    }
}
