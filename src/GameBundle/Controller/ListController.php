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
        if ($a->getName()[0] == $b->getName()[0]) {
            return 0;
        }
        return ($a->getName()[0] < $b->getName()[0]) ? -1 : 1;
    }

    private function sortByGameNameDescend(Game $a, Game $b)
    {
        if ($a->getName()[0] == $b->getName()[0]) {
            return 0;
        }
        return ($a->getName()[0] > $b->getName()[0]) ? -1 : 1;
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
                uasort($games, array($this, 'sortByGameRatingAscend'));
            } else {
                uasort($games, array($this, 'sortByGameRatingDescend'));
            }
        }else if ($sortTarget === "name") {
            if ($sortMode === "ascend") {
                uasort($games, array($this, 'sortByGameNameAscend'));
            } else {
                uasort($games, array($this, 'sortByGameNameDescend'));
            }
        }

        if($sortMode === "ascend"){
            $invertSortMode = "descend";
        } else {
            $invertSortMode = "ascend";
        }

        return $this->render('GameBundle:Game:list.html.twig', [
            "games" => $games,
            "sortTarget" => $sortTarget,
            "sortMode" => $sortMode,
            "invertSortMode" => $invertSortMode,
        ]);
    }


    /**
     * @Route("/", name="index")
     */
    public function defaultAction()
    {
        return $this->indexAction(new Request());
    }
}