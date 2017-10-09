<?php
/**
 * Created by PhpStorm.
 * User: Ulric
 * Date: 28/09/2017
 * Time: 12:36
 */

namespace GameBundle\Controller;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use GameBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
    /**
     * @Route("/user/sign/{typeOfSign}", name="sign")
     */
    public function signAction(string $typeOfSign){
        $user = new User();

        if ($typeOfSign !== "up") {
            $typeOfSign = "in";
        } else {
            $form = $this->createFormBuilder($user)
                ->add('pseudo', TextType::class)
                ->add('password', TextType::class)
                ->add('mail', TextType::class)
                ->add('save', SubmitType::class, array('label' => 'Send Comment'))
                ->getForm();
        }



        $form->handleRequest($request);
        $gameRepository = $this->getDoctrine()->getRepository("GameBundle\Entity\Game");
        $game = $gameRepository->find($gameId);


        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();

            $comment->setGame($game);
            $comment->setUserId("1");

            $em->persist($comment);
            $em->flush();
            $isCommentSave = true;
        }
        return $this->render('GameBundle:Game:sign.html.twig', [
            "typeOfSign" => $typeOfSign,
        ]);
    }
}