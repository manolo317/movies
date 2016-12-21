<?php

namespace Model\Manager;

use Model\Db;
use Model\Entity\Post;
use PDO;

/**
 * Contient toutes les méthodes faisant des requêtes à la base de données
 */
class MovieManager
{
    public function findAll()
    {
        $sql = "SELECT id, imdbId, title, year, cast, plot, directors, writers, rating, votes, runtime, trailerUrl
                FROM movies ORDER BY rating DESC;";

        $dbh = Db::getDbh();

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, '\Model\Entity\Movie');

        return $results;
    }

    public function findOneById($id)
    {
        $sql = "SELECT id, imdbId, title, year, cast, plot, directors, writers, rating, votes, runtime, trailerUrl
                FROM movies WHERE id= :id";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":id", $id);//donne une valeur en paramètre
        $stmt->execute();
        // instancie un objet
        $result = $stmt->fetchObject('\Model\Entity\Movie');

        return $result;
    }

    public function findAllByGenre($id)
    {
        $sql = "SELECT id, imdbId, title, year, cast, plot, directors, writers, rating, votes, runtime, trailerUrl
                FROM movies m 
                INNER JOIN movies_genres mg
                ON m.id = mg.movieId
                WHERE mg.genreId = :id;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":id", $id);//donne une valeur en paramètre
        $stmt->execute();
        // instancie un objet
        $result = $stmt->fetchAll('\Model\Entity\Movie');

        return $result;
    }
}
