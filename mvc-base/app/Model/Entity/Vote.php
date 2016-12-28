<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 28/12/2016
 * Time: 14:52
 */

namespace Model\Entity;


class Vote
{
    private $id;
    private $userId;
    private $movieId;
    private $dateVoted;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

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
    public function getDateVoted()
    {
        return $this->dateVoted;
    }

    /**
     * @param mixed $dateVoted
     */
    public function setDateVoted($dateVoted)
    {
        $this->dateVoted = $dateVoted;
    }


}