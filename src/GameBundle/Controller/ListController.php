<?php
/**
 * Created by PhpStorm.
 * User: probe
 * Date: 27/09/2017
 * Time: 16:34
 */

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GameBundle\Repository\GameRepository;
use GameBundle\Repository\Game;


class ListController extends Controller
{
    function sortByGameRatingAscend(Game $a, Game $b)
    {
        if ($a->getRating() == $b->getRating()) {
            return 0;
        }
        return ($a->getRating() < $b->getRating()) ? -1 : 1;
    }

    function sortByGameRatingDescend(Game $a, Game $b)
    {
        if ($a->getRating() == $b->getRating()) {
            return 0;
        }
        return ($a->getRating() > $b->getRating()) ? -1 : 1;
    }

    private function sortByGameNameAscend(Game $a, Game $b)
    {
        return strcmp($a, $b);
    }

    private function sortByGameNameDescend(Game $a, Game $b)
    {
        return strcmp($a, $b);
    }

    /**
     * @Route("/game/list", name="game_list")
     */
    public function indexAction(Request $request)
    {
        $gameRepository = new GameRepository();
        $games = $gameRepository->getAllGames();

        $sortTarget = $request->get('sort', 'none');
        $sortMode = $request->get('order', 'none');

        if ($sortTarget === "rating") {
            if ($sortMode === "ascend") {
                uasort($games, array($this, 'sortRatingAscend'));
            } else {
                uasort($games, array($this, 'sortRatingDescend'));
            }
        }

        return $this->render('GameBundle:Game:list.html.twig', [
            "games" => $games,
            "sortTarget" => $sortTarget,
            "sortMode" => $sortMode,
        ]);
    }


    /**
     * @Route("/", name="index")
     */
    public function defaultAction()
    {
        return $this->indexAction(null);
    }
}