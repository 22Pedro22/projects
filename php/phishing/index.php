
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Preencha o Formulário</h1>
    <form action="index.php" method="POST">
        <input type="email" name="email" placeholder="email">
	<input type="password" name="senha" placeholder="senha">
	<input type="date" name="data">
        <input type="submit" name="enviar" value="enviar">
        <?php

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            if(!empty($email) && !empty($senha)){
                echo "<p>dados salvos!</p>";
                
                $registro = ['email' => $email, 'senha' => $senha, 'data' => date('Y-m-d H:i:s')];

                $linha = json_encode($registro , JSON_UNESCAPED_UNICODE) . PHP_EOL;

                file_put_contents('arquivo.txt' , $linha , FILE_APPEND | LOCK_EX);
            }else{
                echo "<p>preencha todos os campos</p>";
            }

        ?>
    </form>
</body>
</html>
