<?php
require_once("config.php");

// Criando um hash unica
$codID = strtoupper(uniqid());

// Criando o comando SQL
$sql = "INSERT INTO tb_sala (`hash`, cod_jogador_fk) values ('$codID', {$_SESSION['cod_jogador']})";

// Executando a query

if($conn->query($sql)){
    header("Location: game.php?code=$codID");
    exit();
} else {
    echo "Houver um problema ao preparar o ambiente. Por favor tente novamente!";
}