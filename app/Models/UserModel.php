<?php
namespace Oquiz\Models;

use Oquiz\Database;
use PDO;

class UserModel extends CoreModel{
    private $first_name;
    private $last_name;
    private $email;
    private $password;

            public static function findAll(){
                $sql = '
                SELECT *
                FROM users
                ';

                $pdo = Database::getPDO();
                $pdoStatement = $pdo->query($sql);

                $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS,'\Oquiz\Models\UserModel');
                return $results;
            }

    public function findByEmail($email) {
        $sql = '
            SELECT *
            FROM users
            WHERE email = :email
        ';
        $pdoStatement = Database::getPDO()->prepare($sql);

        $pdoStatement->bind(':email', $email, PDO::PARAM_STR);

        $pdoStatement->execute();

        $result = $pdoStatement->fetchObject('\Oquiz\Models\UserModel');

        return $result;
    }

    protected function insert(){
        $sql= "
        INSERT INTO users
        (`first_name`, `last_name`, `email`, `password`)
        VALUES(:first_name, :last_name, :email, :password)
        ";
        $pdoStatement = Database::getPDO()->prepare($sql);
        $pdoStatement->bindValue(':first_name', $this->first_name , PDO::PARAM_STR);
        $pdoStatement->bindValue(':last_name', $this->last_name , PDO::PARAM_STR);
        $pdoStatement->bindValue(':email', $this->email , PDO::PARAM_STR);
        $pdoStatement->bindValue(':password', $this->password , PDO::PARAM_STR);

        $affectedRows = $pdoStatement->execute();
        $this->id = Database::getPDO()->lastInsertId();

        return $affectedRows;
    }


    public function getFirst_name(){
        return $this->first_name;
    }

    public function getLast_name(){
        return $this->last_name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

            public function setFirst_name($first_name){
                if (is_string($first_name) && !empty($first_name)) {
                 $this->first_name =$first_name;
                 }
            }

            public function setLast_name($last_name){
                if (is_string($last_name) && !empty($last_name)){
                 $this->last_name =$last_name;
             }
            }
            public function setEmail($email){
                if (is_string($email) && !empty($email)){
                 $this->email =$email;
             }
            }
            public function setPassword($password){
                if (is_string($password) && !empty($password)){
                 $this->password =$password;
             }
            }



}
