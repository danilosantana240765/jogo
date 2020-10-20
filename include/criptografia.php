<?php

// Funcao para criptografar senha
function cript_senha($senha){
    return md5($senha);
}

// Verificar se a senha são iguais
function verificar_hash_senha($senha, $hash){
    return cript_senha($senha) == $hash;
}