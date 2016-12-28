<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 23/12/2016
 * Time: 14:36
 */

namespace Model\Entity;


class WishList
{
    private $userId;
    private $movieId;
    private $dateRegistered;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * @param mixed $movieId
     */
    public function setMovieId($movieId)
    {
        $this->movieId = $movieId;
    }

    /**
     * @return mixed
     */
    public function getDateRegistered()
    {
        return $this->dateRegistered;
    }

    /**
     * @param mixed $dateRegistred
     */
    public function setDateRegistered($dateRegistered)
    {
        $this->dateRegistered = $dateRegistered;
    }


}