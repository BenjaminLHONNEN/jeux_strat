<?php
/**
 * Created by PhpStorm.
 * User: probe
 * Date: 27/09/2017
 * Time: 16:39
 */

namespace GameBundle\Repository;

use GameBundle\Repository\Game;

class GameRepository
{
    private $games;

    function __construct()
    {
        $this->games = [
            [
                "id" => 1,
                "name" => "Hearts of Iron IV",
                "description" => "Victory is at your fingertips! Your ability to lead your nation is your supreme weapon, the strategy game Hearts of Iron IV lets you take command of any nation in World War II; the most engaging conflict in world history. From the heart of the battlefield to the command center, you will guide your nation to glory and wage war, negotiate or invade. You hold the power to tip the very balance of WWII. It is time to show your ability as the greatest military leader in the world. Will you relive or change history? Will you change the fate of the world by achieving victory at all costs?",
                "image" => "asset/gamesImage/hoi4.png",
                "tags" => "WW2 World War II WWII Grand Strategy Historical Strategy",
                "sumOfVote" => 50,
                "numberOfVote" => 10,
            ],
            [
                "id" => 2,
                "name" => "Steel Division: Normandy 44",
                "description" => "Steel Division: Normandy 44 is a Tactical Real-Time Strategy (RTS) game, developed by Eugen Systems, the creators of titles like Wargame and R.U.S.E. This new game puts players in command of detailed, historically accurate tanks, troops, and vehicles at the height of World War II. Steel Division: Normandy 44 allows players to take control over legendary military divisions from six different countries, such as the American 101st Airborne, the German armored 21st Panzer or the 3rd Canadian Division, during the invasion of Normandy in 1944.",
                "image" => "asset/gamesImage/steelDiv.png",
                "tags" => "WW2 World War II WWII Grand Strategy Historical Strategy",
                "sumOfVote" => 33,
                "numberOfVote" => 8,
            ]
        ];
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