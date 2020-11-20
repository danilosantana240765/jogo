<?php
require_once("config.php");
require_once("include". DIRECTORY_SEPARATOR . "funcoes.php");

is_not_room();
is_not_logado();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Game</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <?php
            // Mostrando o status do jogo
            echo "<div id=\"informacao\">
                    <span>Code: {$_SESSION['sala']} <span> | <span>Pontos: 10</span>
                </div>";
            
            // Mostrando a lista de cartas
            echo ' <div id="game">';
                // Pegando o elemento passado pelo paramentro
                $id = $_GET['cod_pergunta'] ?? null;

                if(!is_null($id)){
                    // Realizando a pesquisa das altenativa
                    $sql = "select * from v_pergunta_alternativas where cod_pergunta = $id;";
                    $stmt = $conn->query($sql);

                    if(!$stmt){
                        echo getError("Houver um erro realizar a consulta ...");
                    }else if($stmt->num_rows == 0){
                        echo getError("Essa pergunta não possui nenhuma alternativa cadastrada");
                    }else {
                        echo "<script>";
                            $array_alternativas = array();
                           
                            while($row = $stmt->fetch_assoc()){
                                array_push($array_alternativas, $row);
                            }

                            echo "let altenativa = ". json_encode($array_alternativas);
                        echo "</script>";
                    }
                }else {
                    echo getError("Nenhum paramentro informado ...");
                }
            echo '</div>';
            
        
        ?>
        <div id="load_questao"></div>
        <!-- Segunda Parte -->

        <div id="load_efeito"></div>
        <a id="exit" class="botao botao_exit" href="game.php">Voltar</a>
    </main>
    <script src="js/script.js"></script>
    <script>
        if(altenativa != undefined)
            loadFormQuestao(altenativa)
    </script>
    <footer>
        <p>Copyright &copy; - 2020. Danilo Santana & Jackson Silva</p>
    </footer>
</body>
</html>