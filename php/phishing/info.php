<?php

$email = $_POST["email"];
$senha = $_POOST["senha"];

if(!empty($email) || !empty($senha)){
    echo "<p>dados salvos!</p>";
}else{
    echo "<p>preencha todos os campos</p>";
}

$registro = ['email' => $email, 'senha' => $senha, 'data' => date('Y-m-d H:i:s')];

$linha = json_encode($registro , JSON_UNESCAPED_UNICODE) . PHP_EOL;

file_put_contents('arquivo.txt' , $linha , FILE_APPEND | LOCK_EX);

?>