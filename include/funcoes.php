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