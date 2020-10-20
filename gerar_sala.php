<?php
require_once("config.php");
require_once("include". DIRECTORY_SEPARATOR . "funcoes.php");

is_room();
is_not_logado();

// Criando um hash unica
$codID = strtoupper(uniqid());

// Criando o comando SQL
$sql = "INSERT INTO tb_sala (`hash`, cod_jogador_fk) values ('$codID', {$_SESSION['cod_jogador']})";

// Executando a query

if($conn->query($sql)){
    header("Location: user_entrar_partida.php?code=$codID");
    exit();
} else {
    echo "Houver um problema ao preparar o ambiente. Por favor tente novamente!";
}