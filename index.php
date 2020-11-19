<?php
require_once("config.php");
require_once("include". DIRECTORY_SEPARATOR . "funcoes.php");

is_room();
is_not_logado();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Game</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
        <p class='exit_conta'><a href="logout.php?action=exit_user"><span class="material-icons">exit_to_app</span> Sair da conta</a></p>
        <?php
            if(isset($_GET['action'])){
                require_once('user_entrar_partida.php');
            }
        ?>
        <div id="load_option">
            
            <a href="gerar_sala.php" alt="Gerar uma partida nova">Criar uma nova partida</a>
            <form action="index.php" method="GET">
                <input type="text" name="code" id="codID" placeholder="Entre com o código da partida"/>
                <input type="hidden"  name="action" value="action"/>
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