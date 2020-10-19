<?php
require_once("config.php");
require_once("include". DIRECTORY_SEPARATOR . "funcoes.php");
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
            
            // Buscando pela perguntas
            $sql = "select cod_pergunta, pergunta, img_representacao from tb_pergunta";
            $stmt = $conn->query($sql);
            
            if(!$stmt) {
                echo "Houver um erro ao se conectar com o banco de dados {$conn->error}";
            } else if($stmt->num_rows == 0){
                echo "Nenhuma pergunta cadastrada!";
            }else {
                // Pegando todos as linhas e jogando dentro de um array
                $array_questao = array();
                while($rows = $stmt->fetch_assoc()){
                    array_push($array_questao, $rows);
                }

                // Realizando o sorteio das perguntas
                $array_questao_sorteada = array();
                $array_questao_sorteada = sortear($array_questao);
                // Mostrando a lista de cartas
                echo ' <div id="game"><div id="card_list">';
                echo "<script> let questoes = ".json_encode($array_questao_sorteada) . "</script>";
                    for($i = 0; $i < $stmt->num_rows; $i++){
                        echo "<div id=\"card{$i}\" class=\"card\">Carta ". ($i + 1) ."</div>";
                    }
                echo '</div></div>';
            }
        
        ?>
        <div id="load_questao"></div>
        <!-- Segunda Parte -->

        <div id="load_efeito"></div>
        <a id="exit" class="botao botao_exit" href="index.php">Sair</a>
    </main>
    <script src="js/script.js"></script>
    <footer>
        <p>Copyright &copy; - 2020. Danilo Santana & Jackson Silva</p>
    </footer>
</body>
</html>