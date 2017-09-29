<?php

namespace GameBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GameBundle\Entity\Game;

class GamesFixturesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('games:fixtures')
            ->setDescription('add 2 games in DataBase')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('START');
        $output->writeln('');
        $output->writeln('');

        $toAdd = [
            [
                "name" => "Hearts of Iron IV",
                "description" => "Victory is at your fingertips! Your ability to lead your nation is your supreme weapon, the strategy game Hearts of Iron IV lets you take command of any nation in World War II; the most engaging conflict in world history. From the heart of the battlefield to the command center, you will guide your nation to glory and wage war, negotiate or invade. You hold the power to tip the very balance of WWII. It is time to show your ability as the greatest military leader in the world. Will you relive or change history? Will you change the fate of the world by achieving victory at all costs?",
                "image" => "asset/gamesImage/hoi4.png",
                "tags" => "WW2 World War II WWII Grand Strategy Historical Strategy",
            ],
            [
                "name" => "Steel Division: Normandy 44",
                "description" => "Steel Division: Normandy 44 is a Tactical Real-Time Strategy (RTS) game, developed by Eugen Systems, the creators of titles like Wargame and R.U.S.E. This new game puts players in command of detailed, historically accurate tanks, troops, and vehicles at the height of World War II. Steel Division: Normandy 44 allows players to take control over legendary military divisions from six different countries, such as the American 101st Airborne, the German armored 21st Panzer or the 3rd Canadian Division, during the invasion of Normandy in 1944.",
                "image" => "asset/gamesImage/steelDiv.png",
                "tags" => "WW2 World War II WWII Grand Strategy Historical Strategy",
            ],
        ];
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        foreach ($toAdd as $game) {
            $output->writeln('<info>Adding : </info>');
            $output->write("<info>      ");
            $output->write($game["name"]);
            $output->writeln("</info>");
            $newGame = new Game();
            $newGame->setName($game["name"]);
            $newGame->setDescription($game["description"]);
            $newGame->setImage($game["image"]);
            $newGame->setTags($game["tags"]);
            $newGame->setSumOfVote(0);
            $newGame->setNumberOfVote(0);
            $newGame->setRating(0);
            $em->persist($newGame);
            $newGame = new Game();
            $output->write("<info>");
            $output->write($game["name"]);
            $output->writeln(" has been added</info>\n\n");
        }



        $em->flush();

        $output->writeln('END');
    }

}
