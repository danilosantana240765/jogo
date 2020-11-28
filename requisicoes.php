<?php
require_once("config.php");
require_once("include". DIRECTORY_SEPARATOR . "funcoes.php");

is_not_room();
is_not_logado();


// Arquivo PHP para tratar as requisicões feita atraves do JavaScript Ajax
$type = $_GET['type'] ?? null;

if(!is_null($type)){
    $msg_json = array(); // A resposta que será retornado
    switch($type){
        case 'vR': // Verificar Respostas
            $resposta = $_GET['resposta'] ?? null;

            $sql = "select  is_correta, cod_pergunta_fk from tb_altenativa where cod_altenativa = {$resposta}";

            // Verificar se o ID foi passado
            if(!is_null($resposta)){
                $stmt = $conn->query($sql);
               
                // Realizando a consulta
                if(!$stmt){
                    array_push($msg_json, array(
                        "erro" => "Não foi possivel realizar conexao com DB"
                    ));
                }else if($stmt->num_rows == 0){
                    array_push($msg_json, array(
                        "erro" => "Não foi encontrado nada no banco de dados"
                    ));
                }else {
                    $row = $stmt->fetch_assoc();
                    $is_respondida = isQuestaoRespondida($row['cod_pergunta_fk']); // Verificando na sessao se a questao foi respondida

                    

                    if($row["is_correta"] == "1" && !$is_respondida){

                        // Somando o total de acerto do jogador
                        $sql = "call sp_acumular_ponto(10, ". $_SESSION['cod_jogador'] .")";
                        $stmt = $conn->query($sql);
                        $row_jogador = $stmt->fetch_assoc();

                        // Adicionando dentro dos acerto
                        array_push($msg_json, array(
                            "resposta" => "CERTA",
                            "tot_ponto" => $row_jogador['tot_ponto']
                        ));
                    }else if($is_respondida){
                        array_push($msg_json, array(
                            "resposta" => "RESPONDIDA"
                        ));
                    }else {
                        array_push($msg_json, array(
                            "resposta" => "ERRADA"
                        ));
                    }

                    // Caso não foi respondida salvar a questao como respondida
                    if(isset($_SESSION['array_questao_respondida']) && !$is_respondida){
                        array_push($_SESSION['array_questao_respondida'], $row['cod_pergunta_fk']);
                    }
                }
            }

            echo json_encode($msg_json);
        break;
    }
}