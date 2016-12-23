<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 22/12/2016
 * Time: 21:28
 */

namespace Model\Entity;


class MovieGenre
{
    private $movieid;
    private $genreId;

    /**
     * @return mixed
     */
    public function getMovieid()
    {
        return $this->movieid;
    }

    /**
     * @param mixed $movieid
     */
    public function setMovieid($movieid)
    {
        $this->movieid = $movieid;
    }

    /**
     * @return mixed
     */
    public function getGenreId()
    {
        return $this->genreId;
    }

    /**
     * @param mixed $genreId
     */
    public function setGenreId($genreId)
    {
        $this->genreId = $genreId;
    }


}