<?php
require_once("config.php");
require_once("include". DIRECTORY_SEPARATOR . "funcoes.php");
require_once("include". DIRECTORY_SEPARATOR. "criptografia.php");

is_logado()
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
                
                // Verificando o dados de entrada
                if(!is_null($usuario) && !is_null($senha)){
                    // Fazendo correção nas strings
                    
    

                    // Realizando uma query para pesquisar pelo usuario
                    $sql = "select cod_jogador, nome usuario, senha, avatar from tb_jogador where usuario = '{$usuario}' limit 1";
                    $stmt = $conn->query($sql);
                    // Verificando se a busca foi bem sucedida
                    if(!$stmt){
                        echo "Houver um problema ao tentar se conectar com o banco!";
                    }else if($stmt->num_rows > 0) {
                        $rows = $stmt->fetch_assoc();
                        // verificar a senha se a senha está correta
                        if(verificar_hash_senha($senha, $rows['senha'])){
                            // criando a sessão do usuario
                            foreach($rows as $key => $row){
                                $_SESSION[$key] = $row;
                            }

                            // redirecionando o usuário para página index.php
                            header("Location: index.php");
                            exit;
                        }else {
                            echo "Senha ou usuario inválido";
                        }
                    }else {
                        echo "Senha ou usuario inválido";
                    }

                } 
                require_once("include".DIRECTORY_SEPARATOR."form_login.php");
            
                
            ?>
        </div>
    </main>
    <footer>
        <p>Copyright &copy; - 2020. Danilo Santana & Jackson Silva</p>
    </footer>
</body>
</html>