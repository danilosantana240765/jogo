<?php

// Funcao para pesquisar se o elemento existe no vetor
function buscar_elemento($array = array(), $string){
    $pos = 0;
    $encontrado = false;
    while($pos < count($array) && !$encontrado){
        if($array[$pos]['cod_pergunta'] == $string){
            $encontrado = true;
        }
        $pos++;
    }

    return $encontrado;
}

// Funcao que vai pegar um elemento de um array e vai sortear as posição para esses elementos
function sortear($array = array(), $limit = 5){
    $new_array = array();
    $pos = 0;
    while($pos < $limit && $pos < count($array)){
        $posRandom = rand(0, count($array) - 1);
        if(!buscar_elemento($new_array, $array[$posRandom]['cod_pergunta'])){
            array_push($new_array, $array[$posRandom]);
            $pos++;
        }
    }

    return $new_array;
}

// Funcao para verificar se o usuario não está na sala
function is_not_room(){
    if(!isset($_SESSION['sala'])){
        header("Location: index.php");
        exit();
    }
}

// Funcao para verificar se o usuario esta na sala
function is_room(){
    if(isset($_SESSION['sala'])){
        header("Location: game.php");
        exit();
    }
}

// Funcao que verifica se o usuario não está logado
function is_not_logado(){
    if(!isset($_SESSION['cod_jogador'])){
        header("Location: login.php");
        exit();
    }
}

// Funcao que verifica se o usuario está logado
function is_logado(){
    if(isset($_SESSION['cod_jogador'])){
        header("Location: index.php");
        exit();
    }
}

// Funcao para mostrar erros pessoalizado
function getError($string){
    return "<p class='error'><span class='material-icons'>error_outline</span> {$string}</p>";
}

function getSucess($string){
    return "<p class='sucess'><span class='material-icons'>check_circle_outline</span> {$string}</p>";
}
// end --------------------------------


// Funcao para verificar se as respostas foram respondida
function isQuestaoRespondida($cod_questao):bool {
    $is_encontrado = false;
    $pos = 0;

    if(isset($_SESSION['array_questao_respondida'])){

        // Verificando se a questao foi respondida
        while($pos < count($_SESSION['array_questao_respondida']) && !$is_encontrado){
            if($_SESSION['array_questao_respondida'][$pos] == $cod_questao){
                $is_encontrado = true;
            }

            $pos++;
        }
    }

    return $is_encontrado;
}


/* Funcao para atualizar os pontos do usuário */
function getPonto($conn){
    $tot = 0;

    $sql = "select tot_ponto from tb_jogador where cod_jogador = ". $_SESSION['cod_jogador'] . " LIMIT 1;";
    $stmt = $conn->query($sql);

    if($stmt && $stmt->num_rows > 0){
        $row = $stmt->fetch_object();
        $tot = $row->tot_ponto;
    }

    return $tot;
}