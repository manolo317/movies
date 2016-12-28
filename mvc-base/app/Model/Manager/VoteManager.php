<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 28/12/2016
 * Time: 14:53
 */

namespace Model\Manager;
use Model\Db;
use Model\Entity\Vote;
use PDO;

class VoteManager
{
    public function voteForAMovie($userId, $movieId, $vote)
    {
        $sql = "INSERT INTO votes (user_id, movie_id, vote, dateVoted)
			 VALUES (:user_id, :movie_id, :vote, NOW())";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(":user_id", $userId);
        $stmt->bindValue(":movie_id", $movieId);
        $stmt->bindValue(":vote", $vote);

        return $stmt->execute();
    }

    public function checkVote($userId, $movieId)
    {
        $sql = "SELECT user_id, movie_id FROM votes 
                WHERE user_id = :user_id AND movie_id = :movie_id;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":user_id", $userId);
        $stmt->bindValue(":movie_id", $movieId);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
}