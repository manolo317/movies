<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 23/12/2016
 * Time: 14:37
 */

namespace Model\Manager;
use Model\Db;
use Model\Entity\WishList;
use PDO;

class WishListManager
{
    public function addMovieToWishList($userId, $MovieId)
    {
        $sql = "INSERT INTO wish_list (user_id, movie_id, dateRegistered)
			 VALUES (:user_id,:movie_id, NOW())";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(":user_id", $userId);
        $stmt->bindValue(":movie_id", $MovieId);

        return $stmt->execute();
    }

    public function checkWish($userId, $MovieId)
    {
        $sql = "SELECT user_id, movie_id FROM wish_list 
                WHERE user_id = :user_id AND movie_id = :movie_id;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":user_id", $userId);
        $stmt->bindValue(":movie_id", $MovieId);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function removeMovieFromWishList($userId, $MovieId)
    {
        $sql = "DELETE FROM wish_list WHERE user_id = :user_id AND movie_id = :movie_id;";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":user_id", $userId);
        $stmt->bindValue(":movie_id", $MovieId);

        $stmt->execute();

    }
}