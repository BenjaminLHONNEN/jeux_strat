<?php
/**
 * Created by PhpStorm.
 * User: probe
 * Date: 27/09/2017
 * Time: 16:35
 */

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GameBundle\Repository\GameRepository;
use GameBundle\Entity\Game;
use GameBundle\Entity\Comment;

class DetailController extends Controller
{
    /**
     * @Route("/game/detail/{gameId}", name="game_detail",requirements={"gameId": "[0-9]+"})
     */
    public function indexAction(int $gameId, Request $request)
    {
        $comment = new Comment();
        $em = $this->getDoctrine()->getManager();
        $isCommentSave = false;


        $form = $this->createFormBuilder($comment)
            ->add('note', HiddenType::class)
            ->add('comment', TextareaType::class, array("label" => "Comment : "))
            ->add('save', SubmitType::class, array('label' => 'Send Comment'))
            ->getForm();


        $form->handleRequest($request);
        $gameRepository = $this->getDoctrine()->getRepository("GameBundle\Entity\Game");
        $game = $gameRepository->find($gameId);


        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();

            $game->setNumberOfVote($game->getNumberOfVote() + 1);
            $game->setSumOfVote($game->getSumOfVote() + $comment->getNote());
            $game->setRating($game->getSumOfVote() / $game->getNumberOfVote());

            $comment->setGameId($gameId);
            $comment->setUserId("1");

            $em->persist($comment);
            $em->persist($game);
            $em->flush();
            $isCommentSave = true;
        }


        $commentRepository = $this->getDoctrine()->getRepository("GameBundle\Entity\Comment");
        $comments = $commentRepository->findBy(array("gameId" => $gameId));
        $userRepository = $this->getDoctrine()->getRepository("GameBundle\Entity\User");

        $commentsObject = [];
        foreach ($comments as $comment) {
            $object = [];
            $object['commentClass'] = $comment;
            $object['userClass'] = $userRepository->find($comment->getUserId());
            $commentsObject[] = $object;
        }


        if ($game !== null) {
            return $this->render('GameBundle:Game:detail.html.twig', [
                "game" => $game,
                'form' => $form->createView(),
                'isCommentSave' => $isCommentSave,
                'commentsArray' => $commentsObject,
            ], new Response('', 200));
        } else {
            return $this->render('GameBundle:Game:404.html.twig', [], new Response('404 Game not Found', 200));
        }
    }
}