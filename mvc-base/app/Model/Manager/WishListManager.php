<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 23/12/2016
 * Time: 14:37
 */

namespace Model\Manager;


class WishListManager
{
    public function addMovieToWishList($userId, $MovieId)
    {
        $sql = "INSERT INTO whish_list (user_id, movie_id, dateRegistered)
			 VALUES (:user_id,:movie_id, NOW())";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(":user_id", $userId);
        $stmt->bindValue(":movie_id", $MovieId);

        return $stmt->execute();
    }


}