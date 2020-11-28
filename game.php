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
                    <span>Code: {$_SESSION['sala']} <span> | <span>Pontos: ". getPonto($conn) ."</span>
                </div>";
            
            // Mostrando a lista de cartas
            echo ' <div id="game"><div id="card_list">';

                $pos_questao_respondida = array();
                // Mostrando as perguntas
                for($i = 0; $i < count($_SESSION['array_questao_sorteada']); $i++){

                    // Verificando as questões que foram respondida

                    if(isQuestaoRespondida($_SESSION['array_questao_sorteada'][$i]['cod_pergunta'])){
                        array_push($pos_questao_respondida, $i);
                    }
                
                    echo "<div id=\"card{$i}\" class='card_main'><div class=\"card\">Carta ". ($i + 1) ."</div></div>";
                }
            echo '</div></div>';
            
        
        ?>
        <div id="load_questao"></div>
        <!-- Segunda Parte -->

        <div id="load_efeito"></div>
        <a id="exit" class="botao botao_exit" href="logout.php?action=exit_game">Sair</a>
        <?php
            if(count($_SESSION['array_questao_sorteada']) == count($_SESSION['array_questao_respondida'])){
                echo '<a id="exit" class="botao" href="ranking.php?sala=' .$_SESSION['sala'] . '">Ver Ranking</a>';
            }
        ?>
    </main>

    <?php 
        echo "<script>";
        echo "let questoes = ".json_encode($_SESSION['array_questao_sorteada']);
        echo "\nvar pos_divs_respondidas = " . json_encode($pos_questao_respondida);
        echo "</script>"; 
    ?>
    <script src="js/script.js"></script>
    <script>
        lockQuestaoEstaticamente(pos_divs_respondidas);
    </script>
    <footer>
        <p>Copyright &copy; - 2020. Danilo Santana & Jackson Silva</p>
    </footer>
</body>
</html>