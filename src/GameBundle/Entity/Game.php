<?php
/**
 * Created by PhpStorm.
 * User: probe
 * Date: 26/09/2017
 * Time: 21:02
 */

namespace GameBundle\Entity;

class Game
{
    private $id;
    private $name;
    private $description;
    private $image;
    private $tags;
    private $sumOfVote;
    private $numberOfVote;
    private $rating;

    function __construct(int $id, string $name, string $description, string $image, string $tags, int $sumOfVote, int $numberOfVote)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->tags = $tags;
        $this->sumOfVote = $sumOfVote;
        $this->numberOfVote = $numberOfVote;
        $this->rating = (float)$sumOfVote / $numberOfVote;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getTags(): string
    {
        return $this->tags;
    }

    /**
     * @return int
     */
    public function getSumOfVote(): int
    {
        return $this->sumOfVote;
    }

    /**
     * @return int
     */
    public function getNumberOfVote(): int
    {
        return $this->numberOfVote;
    }

    /**
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }
}