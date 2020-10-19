<?php
require_once("config.php");

// Recebendo os paramentros da url
$code = $_GET['code'] ?? null;

// Verificando os paramentro de entrada
if(!is_null($code)){
    $code = htmlspecialchars(addslashes($code));
    $sql = "select `hash` from tb_sala where `hash` = '". $code ."'";
    $stmt = $conn->query($sql);
   
    // Verificando se a busca foi bem sucessidada
    if(!$stmt){
        echo "Houver um problema ao pesquisar no banco!";
    }else {
        $row = $stmt->fetch_object();
        if($stmt->num_rows == 0){
            echo "Nenhum sala encontrada com <strong>". stripslashes($code). "</strong>";
        }else {
            $_SESSION['sala'] = $code;
            header("Location: game.php");
            exit();
        }
    }
}else {
    echo "0";
}