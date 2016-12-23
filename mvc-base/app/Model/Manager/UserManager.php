<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel
 * Date: 22/12/2016
 * Time: 12:05
 */

namespace Model\Manager;
use Model\Db;
use Model\Entity\User;
use PDO;

class UserManager
{
    public function checkEmail($email)
    {
        $sql = "SELECT id FROM users WHERE email = :email";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function checkUser($username)
    {
        $sql = "SELECT id FROM users WHERE username = :username";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":username", $username);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function insertUser($username, $email, $passwordHash, $token, $role)
    {
        $sql = "INSERT INTO users (id, username, email, password, token, role, dateRegistered)
			 VALUES (NULL,:username,:email,:password,:token,:role, NOW())";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $passwordHash);
        $stmt->bindValue(":token", $token);
        $stmt->bindValue(":role", $role);

        return $stmt->execute();
    }

    public function getUserByEmailOrUsername($usernameOrEmail)
    {
        $sql = "SELECT * FROM users 
				WHERE username = :usernameOrEmail 
				OR email = :usernameOrEmail";

        $dbh = Db::getDbh();
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":usernameOrEmail", $usernameOrEmail);
        $stmt->execute();
        $user = $stmt->fetch();
        return $user;
    }

    public function adminAllowedOnly()
    {
        if($_SESSION['user']['role'] === 'admin'){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

}