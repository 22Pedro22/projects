<?php

    require_once __DIR__ . "/../model/SignModel.php";
    require_once __DIR__ . "/../model/DataBase.php";

    class SignDAO{
        private $conection;

        public function __construct(PDO $conection){
            $this->conection = $conection;
        }

        public function sign(SignModel $sign){
            $sql = "insert into users (username , email , password_hash) values (:username , :email , :password_hash)";
            $stmt = $this->conection->prepare($sql);
            $plainPassword = $sign->getPassword();
            $hashedPassword = password_hash($plainPassword , PASSWORD_DEFAULT);
            $stmt->bindValue(":username" , $sign->getUsername());
            $stmt->bindValue(":email" , $sign->getEmail());
            $stmt->bindValue(":password_hash" , $hashedPassword);
            return $stmt->execute();
        }

    }
?>