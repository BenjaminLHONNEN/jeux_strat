<?php
/**
 * Created by PhpStorm.
 * User: probe
 * Date: 27/09/2017
 * Time: 16:35
 */

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GameBundle\Repository\GameRepository;

class DetailController extends Controller
{
    /**
     * @Route("/game/detail/{gameId}", name="game_detail",requirements={"gameId": "[0-9]+"})
     */
    public function indexAction(int $gameId)
    {
        $gameRepository = new GameRepository();
        $game = $gameRepository->getGameById($gameId);
        if ($game !== null) {
            return $this->render('GameBundle:Game:detail.html.twig', [
                "game" => $game,
            ], new Response('', 200));
        } else {
            return $this->render('GameBundle:Game:404.html.twig', [],  new Response('404 Game not Found', 200));
        }
    }
}