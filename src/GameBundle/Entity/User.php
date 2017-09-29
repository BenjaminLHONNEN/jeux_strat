<?php
/**
 * Created by PhpStorm.
 * User: probe
 * Date: 26/09/2017
 * Time: 22:06
 */


namespace GameBundle\Entity;

class User
{
    private $id;
    private $mail;
    private $nickname;
    private $lastname;
    private $password;

    function __construct(int $id, string $mail, string $nickname, string $lastname, string $password)
    {
        $this->id = $id;
        $this->mail = $mail;
        $this->nickname = $nickname;
        $this->lastname = $lastname;
        $this->password = $password;
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
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


}