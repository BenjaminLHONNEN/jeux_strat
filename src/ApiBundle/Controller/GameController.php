<?php
/**
 * Created by PhpStorm.
 * User: probe
 * Date: 13/10/2017
 * Time: 11:37
 */

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query;

class GameController extends Controller
{
    public function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }


    /**
     * @Route("/api/games")
     */
    public function allGamesAction()
    {
        $time_start = $this->microtime_float();

        $query = $this->getDoctrine()
            ->getRepository('GameBundle:Game')
            ->createQueryBuilder('c')
            ->getQuery();
        $result = $query->getResult(Query::HYDRATE_ARRAY);

        $time_end = $this->microtime_float();
        $time = $time_end - $time_start;

        $response = new JsonResponse([
            "Games" => $result,
            "responseType" => "array",
            "responseLen" => count($result),
            "executionTime" => $time,
        ]);
        $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);
        return $response;
    }


    /**
     * @Route("/api/gameById/{gameId}",requirements={"gameId": "[0-9]+"})
     */
    public function oneGameAction(int $gameId)
    {
        $time_start = $this->microtime_float();

        $query = $this->getDoctrine()
            ->getRepository('GameBundle:Game')
            ->createQueryBuilder('c')
            ->where('c.id = :gameId')
            ->setParameter('gameId', $gameId)
            ->getQuery();
        $result = $query->getResult(Query::HYDRATE_ARRAY);

        $time_end = $this->microtime_float();
        $time = $time_end - $time_start;


        $response = new JsonResponse([
            "Games" => $result,
            "responseType" => "array",
            "responseLen" => count($result),
            "executionTime" => $time,
        ]);
        $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);
        return $response;
    }

    /**
     * @Route("/api/gameByParams")
     */
    public function searchGamesAction(Request $request)
    {
        $params = $request->query->get('params');
        if(isset($params) && $params !== null) {
            $time_start = $this->microtime_float();

            $gameRepository = $this->getDoctrine()->getRepository("GameBundle\Entity\Game");
            $games = $gameRepository->findBy([]);

            $time_end = $this->microtime_float();
            $time = $time_end - $time_start;

            $result = $games;

            $response = new JsonResponse([
                "Games" => $result,
                "responseType" => "array",
                "responseLen" => count($result),
                "executionTime" => $time,
            ]);
            $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);
            return $response;
        } else {
            return $this->json([
                "responseType" => "error",
            ]);
        }
    }
}