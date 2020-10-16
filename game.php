<?php
require_once("config.php");
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
            
            $hash = $_GET['code'] ?? null;

            if(!is_null($hash)){
                $sql = "select hash from tb_sala where hash = '$hash' limit 1";
                $stmt = $conn->query($sql);
                if(!$stmt){
                    echo "<p>Houver um problema ao pesquisa pelo hash</p>";
                } else if($stmt->num_rows == 0){
                    echo "<p>Nenhuma hash encontrada :(</p>";
                } else {
                    $reg = $stmt->fetch_object();

                    // Mostrando o status do jogo
                    echo "<div id=\"informacao\">
                            <span>Code: {$reg->hash} <span> | <span>Pontos: 10</span>
                        </div>";
                    
                    // Buscando pela perguntas
                    
                    // Mostrando a lista de cartas
                    echo ' <div id="game"><div id="card_list">';
                        for($i = 1; $i <= 5; $i++){
                            echo "<div id=\"card{$i}\" class=\"card\">Carta {$i}</div>";
                        }
                    echo '</div></div>';
                }
            } else {
                echo "<p>Por favor informe o codigo da jogada!</p>";
            }
        ?>
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