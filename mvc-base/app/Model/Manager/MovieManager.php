<?php

namespace Model\Manager;

use Model\Db;
use Model\Entity\Movie;
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

    public function findAllByGenre($genreId)
    {
        $sql = "SELECT m.id, m.imdbId, m.title, m.year, m.cast, m.plot, m.directors, m.writers, m.rating, m.votes, m.runtime, m.trailerUrl
                FROM movies m 
                INNER JOIN movies_genres mg
                ON m.id = mg.movieId
                WHERE mg.genreId = :genre_id
                ORDER BY rating DESC;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":genre_id", $genreId);//donne une valeur en paramètre
        $stmt->execute();
        // instancie un objet
        $result = $stmt->fetchAll(PDO::FETCH_CLASS,'\Model\Entity\Movie');

        return $result;
    }

    public function findAllByYear($year)
    {
        $sql = "SELECT id, imdbId, title, year, cast, plot, directors, writers, rating, votes, runtime, trailerUrl
                FROM movies 
                WHERE year = :year
                ORDER BY rating DESC;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":year", $year);//donne une valeur en paramètre
        $stmt->execute();
        // instancie un objet
        $result = $stmt->fetchAll(PDO::FETCH_CLASS,'\Model\Entity\Movie');

        return $result;
    }

    public function findAllByGenreAndYear($genreId, $year)
    {
        $sql = "SELECT m.id, m.imdbId, m.title, m.year, m.cast, m.plot, m.directors, m.writers, m.rating, m.votes, m.runtime, m.trailerUrl
                FROM movies m 
                INNER JOIN movies_genres mg
                ON m.id = mg.movieId
                WHERE mg.genreId = :genre_id
                AND m.year = :year
                ORDER BY m.rating DESC;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":genre_id", $genreId);//donne une valeur en paramètre
        $stmt->bindValue(":year", $year);//donne une valeur en paramètre
        $stmt->execute();
        // instancie un objet
        $result = $stmt->fetchAll(PDO::FETCH_CLASS,'\Model\Entity\Movie');

        return $result;
    }

    public function findByResearch($research)
    {
        $sql = "SELECT id, imdbId, title, year, cast, plot, directors, writers, rating, votes, runtime, trailerUrl
                FROM movies 
                WHERE title
                LIKE :research
                ORDER BY rating DESC;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":research", '%'.$research.'%');//donne une valeur en paramètre
        $stmt->execute();
        // instancie un objet
        $result = $stmt->fetchAll(PDO::FETCH_CLASS,'\Model\Entity\Movie');

        return $result;
    }
}
