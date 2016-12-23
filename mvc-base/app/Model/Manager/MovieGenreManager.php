<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 22/12/2016
 * Time: 21:30
 */

namespace Model\Manager;
use Model\Db;
use Model\Entity\MovieGenre;
use PDO;

class MovieGenreManager
{
    public function setGenreMovie($movieId, $genreId) //comment faire si array?
    {
        $sql = "INSERT INTO movies_genres(movieId, genreId) 
                                    VALUES (:movieId, :genreId);";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":movieId", $movieId);
        $stmt->bindValue(":genreId", $genreId);

        return $stmt->execute();
    }
}