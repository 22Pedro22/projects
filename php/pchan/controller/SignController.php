<?php

    require_once __DIR__ . "/../model/SignModel.php";
    require_once __DIR__ . "/../model/DataBase.php";
    require_once __DIR__ . "/../model/SignDAO.php";

    class SignController{
        public function validation(){
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                if(isset($_POST["sign"])){
                    $username = $_POST["username"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $repeat_password = $_POST["repeat_password"];
                    if(!empty($username) && !empty($email) && !empty($password) && !empty($repeat_password)){
                        if($password == $repeat_password){
                            $this->sign($username , $email , $password);
                        }
                    }
                }
            }
        }

        public function sign($username , $email , $password){
            $db = new DataBase();
            $conection = $db->conect();
            $sign = new signModel($username , $email , $password);
            $signDAO = new signDAO($conection);
            if($signDAO->sign($sign)){
                echo "account has been created";
                return true;
            }else{
                echo "failed to create account";
            }
        }
    }

    $new = new SignController();
    $new->validation();
?>