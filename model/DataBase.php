<?php
    class DataBase{
        private $host = "127.0.0.1";
        private $port = "5432";
        private $dbname = "pchan";
        private $username = "postgres";
        private $password = "123";
        private $conection;

        public function conect(){
            try{
                $this->conection = new PDO(
                    "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}",
                    $this->username,
                    $this->password
                );
                $this->conection->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                return $this->conection;
            }catch(PDOException $e){
                die("Erro na conexao com o banco" . $e->getMessage());
            }
        }
    }
?>