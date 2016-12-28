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

    public function findAllByTitle()
    {
        $sql = "SELECT id, imdbId, title, year, cast, plot, directors, writers, rating, votes, runtime, trailerUrl
                FROM movies ORDER BY title;";

        $dbh = Db::getDbh();

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, '\Model\Entity\Movie');

        return $results;
    }

    public function findAllPage($currentPage)
    {
        $numPerPage = 3; //nombre de films par page
        $offset = ($currentPage-1) * $numPerPage; //nombre de films par page à sauter à chaque requetes
        $sql = "SELECT id, imdbId, title, year, cast, plot, directors, writers, rating, votes, runtime, trailerUrl
                FROM movies ORDER BY rating DESC LIMIT $numPerPage OFFSET $offset;";

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
                WHERE title LIKE :research
                OR year LIKE :research
                OR cast LIKE :research
                OR directors LIKE :research
                OR writers LIKE :research
                OR plot LIKE :research
                ORDER BY rating DESC;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":research", '%'.$research.'%');//donne une valeur en paramètre
        $stmt->execute();
        // instancie un objet
        $result = $stmt->fetchAll(PDO::FETCH_CLASS,'\Model\Entity\Movie');

        return $result;
    }

    public function findYear()
    {
        $sql = "SELECT year
                FROM movies 
                GROUP BY year;";

        $dbh = Db::getDbh();

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, '\Model\Entity\Movie');

        return $results;
    }

    public function countAll()
    {
        $sql = "SELECT COUNT(*) FROM movies";

        $dbh = Db::getDbh();

        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetchColumn(); // quand on récupère une seule cellule
        return $count;
    }

    public function create(Movie $movie)
    {
        $sql = "INSERT INTO movies(imdbId, title, year, cast, plot, directors, writers, runtime, trailerUrl, rating, votes, dateCreated, dateModified) 
                                    VALUES (:imdbId, :title, :year, :cast, :plot, :directors, :writers, :runtime, :trailerUrl, 0, 0, NOW(), NOW());";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":imdbId", $movie->getImdbId());
        $stmt->bindValue(":title", $movie->getTitle());
        $stmt->bindValue(":year", $movie->getYear());
        $stmt->bindValue(":cast", $movie->getCast());
        $stmt->bindValue(":plot", $movie->getPlot());
        $stmt->bindValue(":directors", $movie->getDirectors());
        $stmt->bindValue(":writers", $movie->getWriters());
        $stmt->bindValue(":runtime", $movie->getRuntime());
        $stmt->bindValue(":trailerUrl", $movie->getTrailerUrl());

        if($stmt->execute()){
            $movie->setId($dbh->lastInsertId()); //je récupère l'id du movie que je viens de créer
            return $movie;
        }
        else{
            return false;
        }

    }

    public function checkMovie($title)
    {
        $sql = "SELECT title FROM movies WHERE title = :title";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":title", $title);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function deleteMovie($id)
    {
        $sql = "DELETE FROM movies WHERE id = :id;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":id", $id);

        $stmt->execute();

    }
    public function update(Movie $movie)
    {
        $sql = "UPDATE movies SET imdbId = :imdbId,
                                  title = :title,
                                  year = :year, 
                                  cast = :cast,
                                  plot = :plot,
                                  directors = :directors,
                                  writers = :writers,
                                  runtime = :runtime,
                                  trailerUrl = :trailerUrl,
                                  dateModified = NOW()
                                  WHERE id = :id;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":id", $movie->getId());
        $stmt->bindValue(":imdbId", $movie->getImdbId());
        $stmt->bindValue(":title", $movie->getTitle());
        $stmt->bindValue(":year", $movie->getYear());
        $stmt->bindValue(":cast", $movie->getCast());
        $stmt->bindValue(":plot", $movie->getPlot());
        $stmt->bindValue(":directors", $movie->getDirectors());
        $stmt->bindValue(":writers", $movie->getWriters());
        $stmt->bindValue(":runtime", $movie->getRuntime());
        $stmt->bindValue(":trailerUrl", $movie->getTrailerUrl());

        return $stmt->execute();
    }

    public function findAllByWish($userId)
    {

        $sql = "SELECT m.id, m.imdbId, m.title, m.year, m.cast, m.plot, m.directors, m.writers, m.rating, m.votes, m.runtime, m.trailerUrl
                FROM movies m
                INNER JOIN wish_list w
                ON m.id = w.movie_id
                WHERE w.user_id = :userId
                ORDER BY rating DESC;";

        $dbh = Db::getDbh();

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":userId", $userId);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_CLASS, '\Model\Entity\Movie');

        return $results;
    }

    public function updateVote(Movie $movie, $vote)
    {
        $sql = "UPDATE movies SET votes = :votes,
                                  rating = :rating
                                  WHERE id = :id;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $newVote =  ($movie->getVotes()+1);
        $newRating = (($movie->getRating())*($movie->getVotes())+ $vote)/$newVote;

        $stmt->bindValue(":id", $movie->getId());
        $stmt->bindValue(":votes", $newVote);
        $stmt->bindValue(":rating", $newRating);

        return $stmt->execute();
    }

}
