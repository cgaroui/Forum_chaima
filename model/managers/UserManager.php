<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect ();
    }

    public function nvUser($nickname, $email, $password) {
        $sql = "INSERT INTO {$this->tableName} (nickname, email, password) 
                VALUES (:nickname, :email, :password)";
       
        return DAO::insert($sql, [
            'nickname' => $nickname,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public function getByEmail($email) {
        $sql = "SELECT * FROM {$this->tableName} WHERE email = :email";
        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false),
            $this->className
        );
    }
}