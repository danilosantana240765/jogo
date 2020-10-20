<?php
require_once("config.php");
require_once("include". DIRECTORY_SEPARATOR . "funcoes.php");

is_room();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Game - Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <main>
        <div id="logo"></div>
        <div id="login">
            <?php
                // Carregando o formulário de fazer login
                $usuario = $_POST['usuario'] ?? null;
                $senha = $_POST['senha'] ?? null;
                // Fazendo o bloqueio de tentativa para efetura o login
                if(!isset($_SESSION['tentativas'])){
                    $_SESSION['tentativas'] = 0;
                }

                // Verificando o dados de entrada
                if(!is_null($usuario) && !is_null($senha)){
                    // Fazendo correção nas strings

                    if($_SESSION['tentativas'] < 3){
                        $_SESSION['tentativas'] ++;
                    }else {
                        echo "Infelizmente você errou 3 vezes seguida. Tente novamente mais tarde! ";
                        // Guardar o tempo que o usuario ficará bloqueado
                        if(!isset($_SESSION['minutos'])){
                            $_SESSION['minutos'] = ((int) date("i") * 60);
                        } 
                        
                        
                    }
                   
                } else {
                    require_once("include".DIRECTORY_SEPARATOR."form_login.php");
                }

                
            ?>
        </div>
    </main>
    <footer>
        <p>Copyright &copy; - 2020. Danilo Santana & Jackson Silva</p>
    </footer>
</body>
</html>