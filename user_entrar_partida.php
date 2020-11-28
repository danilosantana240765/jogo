<?php
require_once("config.php");
require_once("include".DIRECTORY_SEPARATOR."funcoes.php");


// Recebendo os paramentros da url
$code = $_GET['code'] ?? null;

// Verificando os paramentro de entrada
if(!is_null($code)){
    $code = htmlspecialchars(addslashes($code));
    $sql = "select `hash` from tb_sala where `hash` = '". $code ."'";
    $stmt = $conn->query($sql);
   
    // Verificando se a busca foi bem sucessidada
    if(!$stmt){
        echo getError("Houver um problema ao pesquisar no banco!");
    }else {
        $row = $stmt->fetch_object();
        if($stmt->num_rows == 0){
            echo getError("Nenhum sala encontrada com código <strong>". stripslashes($code). "</strong>");
        }else {
            $_SESSION['sala'] = $code;
            /* Implementar os codigos que irá sortear as questoes */
            // Buscando pela perguntas
            $sql = "select cod_pergunta, pergunta, img_representacao from tb_pergunta";
            $stmt = $conn->query($sql);
            
            if(!$stmt) {
                echo getError("Houver um erro ao se conectar com o banco de dados {$conn->error}");
            } else if($stmt->num_rows == 0){
                echo getError("Nenhuma pergunta cadastrada!");
            }else {
                // Pegando todos as linhas e jogando dentro de um array
                $array_questao = array();
                while($rows = $stmt->fetch_assoc()){
                    array_push($array_questao, $rows);
                }

                // Realizando o sorteio das perguntas
                $_SESSION['array_questao_sorteada'] = array();
                $_SESSION['array_questao_sorteada'] = sortear($array_questao);
                // Sessao para salvar as perguntas já respondida
                $_SESSION['array_questao_respondida'] = array();

                // Colocando elemento de associação 
                $sql = "call sp_associar_jogadores(". $_SESSION['cod_jogador'] .", $code)";
                $conn->query($sql);

                header("Location: game.php");
                exit();
            }

            header("Location: index.php?codErr=Error_sorted_question");
            exit;
        }
    }
}else {
    echo "0";
}