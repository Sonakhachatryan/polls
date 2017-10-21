<?php

namespace Models;

use PDO;

class User extends DB
{

    private $tableName = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * create a new user record
     *
     * @param $data
     * @return bool
     */
    public function createUser($data)
    {
        $sql = "INSERT INTO $this->tableName (`name`, `email`, `password`,`status`,`created_at`) VALUES (:name, :email, :password,0,:created_at)";

        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $sth->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $password = md5($data['password']);
        $sth->bindParam(':password', $password);
        $created_at = date('Y-m-d H:i:s', time());
        $sth->bindParam(':created_at', $created_at);

        return $sth->execute();
    }

    /**
     * get the user by email
     *
     * @param string $email
     * @return array
     */
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM $this->tableName WHERE `email`=:email";
        $sth = $this->dbh->prepare($sql);
        $sth->execute([':email' => $email]);
        $res = $sth->fetch();

        return $res;
    }

    /**
     * set activation token
     *
     * @param $email
     * @param $token
     * @return bool
     */
    public function updateToken($email, $token)
    {
        $sql = "UPDATE $this->tableName SET `token` = :token WHERE `email`=:email";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':token', $token, PDO::PARAM_STR);
        $sth->bindParam(':email', $email, PDO::PARAM_STR);

        return $sth->execute();
    }

    /**
     * activate user account
     *
     * @param $token
     * @return mixed
     */
    public function updateStatus($token)
    {
        $sql = "SELECT * FROM $this->tableName WHERE `token`=:token";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':token', $token, PDO::PARAM_STR);
        $sth->execute();
        $res = $sth->fetch();

        if ($res) {
            $sql = "UPDATE $this->tableName SET `token` = NULL, `status` = 1 WHERE `email`=:email";
            $sth = $this->dbh->prepare($sql);
            $sth->bindParam(':email', $res['email'], PDO::PARAM_STR);
            $res2 = $sth->execute();
            if (!$res2)
                return false;


        }

        return $res;
    }


}