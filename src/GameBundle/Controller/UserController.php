<?php
/**
 * Created by PhpStorm.
 * User: Ulric
 * Date: 28/09/2017
 * Time: 12:36
 */

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
    /**
     * @Route("/user/sign/{typeOfSign}", name="sign")
     */
    public function signAction(string $typeOfSign){
        if ($typeOfSign !== "up") {
            $typeOfSign = "in";
        }
            return $this->render('GameBundle:Game:sign.html.twig', [
                "typeOfSign" => $typeOfSign,
            ]);
    }
}