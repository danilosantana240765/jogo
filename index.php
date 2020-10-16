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
        <div id="logo"></div>
        <h1>Cardroom</h1>
        <!-- Primeira parte -->
        <div id="load_jogo">
            <a href="#" id="init_game" class="botao">Iniciar Game</a>
            <!-- tag temporaria -->
            <audio id="audio_fundo"></audio>
        </div>
        <div id="load_option">
            <a href="gerar_sala.php" alt="Gerar uma partida nova">Criar uma nova partida</a>
            <form action="game.php" method="GET">
                <input type="text" name="code" id="codID" placeholder="Entre com o código da partida"/>
                <input type="submit" value="Participar"/>
            </form>
        </div>
    </main>
    <script src="js/script.js"></script>
    <footer>
        <p>Copyright &copy; - 2020. Danilo Santana & Jackson Silva</p>
    </footer>
</body>
</html>