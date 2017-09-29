<?php
namespace GameBundle\Entity;

class Comment
{
    private $id;
    private $gameId;
    private $userId;
    private $note;
    private $comment;

    function __construct(int $id, int $gameId, int $userId, int $note, string $comment)
    {
        $this->id = $id;
        $this->gameId = $gameId;
        $this->userId = $userId;
        $this->note = $note;
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

}