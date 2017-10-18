<?php

namespace GameBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GameBundle\Entity\Game;
use GameBundle\Entity\User;

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
        $passEncoder = $this->getContainer()->get("security.password_encoder");
        $output->writeln('START');
        $output->writeln('');
        $output->writeln('');


        $gamesToAdd = [
            [
                "name" => "Hearts of Iron IV",
                "description" => "Victory is at your fingertips! Your ability to lead your nation is your supreme weapon, the strategy game Hearts of Iron IV lets you take command of any nation in World War II; the most engaging conflict in world history. From the heart of the battlefield to the command center, you will guide your nation to glory and wage war, negotiate or invade. You hold the power to tip the very balance of WWII. It is time to show your ability as the greatest military leader in the world. Will you relive or change history? Will you change the fate of the world by achieving victory at all costs?",
                "image" => "asset/gamesImage/hoi4.png",
                "tags" => ["WW2","World","War","II","WWII","Grand","Strategy","Historical","Strategy"],
            ],
            [
                "name" => "Steel Division: Normandy 44",
                "description" => "Steel Division: Normandy 44 is a Tactical Real-Time Strategy (RTS) game, developed by Eugen Systems, the creators of titles like Wargame and R.U.S.E. This new game puts players in command of detailed, historically accurate tanks, troops, and vehicles at the height of World War II. Steel Division: Normandy 44 allows players to take control over legendary military divisions from six different countries, such as the American 101st Airborne, the German armored 21st Panzer or the 3rd Canadian Division, during the invasion of Normandy in 1944.",
                "image" => "asset/gamesImage/steelDiv.png",
                "tags" => ["WW2","World","War","II","WWII","Medium","Strategy","Historical","Strategy"],
            ],
            [
                "name" => "Total War : Warhammer II",
                "description" => "",
                "image" => "Millennia ago, besieged by a Chaos invasion, a conclave of High Elf mages forged a vast, arcane vortex. Its purpose was to draw the Winds of Magic from the world as a sinkhole drains an ocean, and blast the Daemonic hordes back to the Realm of Chaos. Now the Great Vortex falters, and the world again stands at the brink of ruin.Powerful forces move to heal the maelstrom and avert catastrophe. Yet others seek to harness its terrible energies for their own bitter purpose. The race is on, and the very fate of the world will lie in the hands of the victor.The second in a trilogy and sequel to the award-winning Total War: WARHAMMER, Total War: WARHAMMER II brings players a breathtaking new narrative campaign, set across the vast continents of Lustria, Ulthuan, Naggaroth and the Southlands. The Great Vortex Campaign builds pace to culminate in a definitive and climactic endgame, an experience unlike any other Total War title to date.Playing as one of 8 Legendary Lords across 4 iconic races from the world of Warhammer Fantasy Battles, players must succeed in performing a series of powerful arcane rituals in order to stabilise or disrupt The Great Vortex, while foiling the progress of the other races. Each Legendary Lord has a unique geographical starting position, and each race offers a distinctive new playstyle with unique campaign mechanics, narrative, methods of war, armies, monsters, Lores of Magic, legendary characters, and staggering new battlefield bombardment abilities.Shortly after launch, owners of both the original game and Total War: WARHAMMER II will gain access to the colossal new combined campaign. Merging the landmasses of The Old World plus Naggaroth, Lustria, Ulthuan and the Southlands into a single epic map, players may embark on monumental campaigns as any owned Race from both titles.",
                "tags" => ["Total","War","Warhammer","Total War","Medium","Strategy"],
            ],
        ];
        $userToAdd = [
            [
                "pseudo" => "bnj",
                "mail" => "benjamin.lhonnen@ynov.com",
                "password" => "1234",
                "imageLink" => "./asset/userImages/1.gif",
                "role" => "ROLE_ADMIN",
            ],
            [
                "pseudo" => "admin",
                "mail" => "admin@ynov.com",
                "password" => "1234",
                "imageLink" => "./asset/userImages/1.gif",
                "role" => "ROLE_ADMIN",
            ],
            [
                "pseudo" => "user",
                "mail" => "user@ynov.com",
                "password" => "1234",
                "imageLink" => "./asset/userImages/2.gif",
                "role" => "ROLE_USER",
            ],
            [
                "pseudo" => "Ulric",
                "mail" => "emeric.lesault@ynov.com",
                "password" => "1234",
                "imageLink" => "./asset/userImages/2.png",
                "role" => "ROLE_ADMIN",
            ],
        ];

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        foreach ($gamesToAdd as $game) {
            $output->writeln('<info>Adding Game : </info>');
            $output->write("<info>      ");
            $output->write($game["name"]);
            $output->writeln("</info>");

            $newGame = new Game();
            $newGame->setName($game["name"])
                ->setDescription($game["description"])
                ->setImage($game["image"])
                ->setTags($game["tags"]);
            $em->persist($newGame);

            $output->write("<info>");
            $output->write($game["name"]);
            $output->writeln(" has been added</info>\n\n");
        }
        foreach ($userToAdd as $user) {
            $output->writeln('<info>Adding User : </info>');
            $output->write("<info>      ");
            $output->write($user["pseudo"]);
            $output->writeln("</info>");

            $newuser = new User();
            $newuser->setPseudo($user["pseudo"])
                ->setMail($user["mail"])
                ->setPassword($passEncoder->encodePassword($newuser,$user["password"]))
                ->setImageLink($user["imageLink"])
                ->setRole($user["role"]);
            $em->persist($newuser);

            $output->write("<info>");
            $output->write($user["pseudo"]);
            $output->writeln(" has been added</info>\n\n");
        }



        $em->flush();

        $output->writeln('END');
    }

}
