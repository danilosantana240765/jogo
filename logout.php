<?php
require_once("config.php");
require_once("include". DIRECTORY_SEPARATOR . "funcoes.php");

$action = $_GET['action'] ?? null;

// Tratando os paramentros
if(!is_null($action)){
    switch($action){
        case "exit_game":
            // Colocando o comando que irá apagar a sala
            $sql = "delete from tb_sala where hash = '{$_SESSION['sala']}' and cod_jogador_fk = {$_SESSION['cod_jogador']} limit 1";
            if($conn->query($sql)){
                echo "Sala Fechada!";
                unset($_SESSION['sala']);
                unset($_SESSION['array_questao_sorteada']);
            }
        break;
        case "exit_user":
            session_destroy();
        break;
    }
}
// Redireciona para a página index.php
header("Location: index.php");