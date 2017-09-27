<?php
/**
 * Created by PhpStorm.
 * User: probe
 * Date: 27/09/2017
 * Time: 16:34
 */

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GameBundle\Repository\GameRepository;


class ListController extends Controller
{
    /**
     * @Route("/game/list", name="game_list")
     */
    public function indexAction()
    {
        $gameRepository = new GameRepository();
        $games = $gameRepository->getAllGames();
        return $this->render('GameBundle:Game:list.html.twig', [
            "games" => $games,
        ]);
    }


    /**
     * @Route("/", name="index")
     */
    public function defaultAction()
    {
        return $this->indexAction();
    }
}