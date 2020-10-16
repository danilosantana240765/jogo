<?php
session_start(); // Configuracao de sessão
// Constante de acesso ao banco de dados
define("HOSTNAME", "localhost"); // O Host onde esta o banco de dados
define("USERNAME", "root"); // O usuario do banco de dados
define("PASSWORD", ""); // Senha do banco de dados
define("DBNAME", "cardroom"); // Banco de dados

// Iniciando conexão com banco de dados
$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);
$conn->set_charset("utf8"); // Definido a formatação de caracter unicode 

if($conn->errno){
    echo "Houve um problema ao realizar a conexão com banco de dados {$conn->error}";
    die();
}