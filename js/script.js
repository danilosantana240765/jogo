let div_game = document.getElementById("game");
let div_cards = document.getElementsByClassName("card");
let audio;

// Verificando se essa tag foi carregado
if(div_cards != null){
    for(let pos_card in div_cards){
        div_cards[pos_card].onclick = function(){
            audioEfeito();
        };
    }
}


// Funcao que criar a reprodução do audio
function audioEfeito(){
    let div_sound_efeito = document.getElementById("load_efeito");
    // Funcao que limpar os dados
    div_sound_efeito.innerHTML = "";

    // Criando uma tags audio e colocando o efeito
    audio = document.createElement("audio");

    // Adicionando o elementos DOM na tag div
    div_sound_efeito.appendChild(audio);

    // Adicionando o source do audio
    let source = document.createElement("source");
    source.setAttribute("src", "audio/Small_Glass_Pane_Shatter.mp3");
    source.setAttribute("type", "audio/mpeg");

    audio.appendChild(source);

    // Configurando o audio
    audio.controls = false;
    audio.loop = false;
    audio.play();
}