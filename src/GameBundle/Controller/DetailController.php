<?php
/**
 * Created by PhpStorm.
 * User: probe
 * Date: 27/09/2017
 * Time: 16:35
 */

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GameBundle\Repository\GameRepository;

class DetailController extends Controller
{
    /**
     * @Route("/game/detail/{gameId}", name="game_detail")
     */
    public function indexAction(int $gameId)
    {
        $gameRepository = new GameRepository();
        $game = $gameRepository->getGameById($gameId);
        return $this->render('GameBundle:Game:detail.html.twig', [
            "game" => $game,
        ]);
    }
}