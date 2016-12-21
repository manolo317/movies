<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 21/12/2016
 * Time: 15:55
 */

namespace Model\Manager;
use Model\Db;
use Model\Entity\Genre;
use PDO;

class GenreManager
{
    public function findAllByGenre($id)
    {
        $sql = "SELECT GROUP_CONCAT(name) AS genre 
               FROM genres g
               INNER JOIN movies_genres mg
               ON g.id = mg.genreId
               WHERE mg.movieId = :id;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":id", $id);//donne une valeur en paramètre
        $stmt->execute();
        // instancie un objet
        $result = $stmt->fetch();
        //var_dump($result);
        return $result;
    }
}