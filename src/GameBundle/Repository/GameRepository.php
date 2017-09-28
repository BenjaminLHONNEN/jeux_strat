<?php
/**
 * Created by PhpStorm.
 * User: probe
 * Date: 27/09/2017
 * Time: 16:39
 */

namespace GameBundle\Repository;

use GameBundle\Entity\Game;

class GameRepository
{
    private $games;

    function __construct()
    {
        $json = file_get_contents('games.json');
        $this ->games = json_decode($json, true);
    }

    public function getAllGames(): array
    {
        $games = [];
        foreach ($this->games as $game) {
            array_push($games,new Game($game['id'], $game['name'], $game['description'], $game['image'], $game['tags'], $game['sumOfVote'], $game['numberOfVote']));
        }
        return $games;
    }

    public function getGameById(int $id): ?Game
    {
        $response = null;
        foreach ($this->games as $game) {
            if($game['id'] === $id){
                $response = new Game($game['id'], $game['name'], $game['description'], $game['image'], $game['tags'], $game['sumOfVote'], $game['numberOfVote']);
            }
        }

        return $response;
    }
}