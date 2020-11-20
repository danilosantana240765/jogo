let div_game = document.getElementById("game");
let div_cards = document.getElementsByClassName("card");
let audio = document.getElementById("audio_fundo");
let source;

// Da um play no audio assim que carregar toda a página
if(audio != null){
    // Adiciona o arquivo de audio
    source = document.createElement("source");
    source.setAttribute("src", "audio/Float.mp3");
    source.setAttribute("type", "audio/mpeg");
    audio.appendChild(source);
    this.playAudio();
}

// Funcao para da um play do audio
function playAudio(){
    audio.play();
    audio.loop = true; // Loop do audio
    audio.constrols = false; // Ocultar o play
    audio.volume = 0.2;
}

// Verificando se essa tag foi carregado
if(div_cards != null){
    let show = Array();
    for(let pos_card in div_cards){
        div_cards[pos_card].onclick = function(){
            audioEfeito();
            show[pos_card] = !show[pos_card]
            if(questoes != null && show[pos_card]){
                div_cards[pos_card].innerHTML = questoes[pos_card].pergunta;
                div_cards[pos_card].style.backgroundImage = "url('imagens/lampada_acesa.png')";
                div_cards[pos_card].style.backgroundColor = "#cecece";

                // Colando elemento para responder a pergunta dentro da tag
                let p = document.createElement("p");
                div_cards[pos_card].appendChild(p);

                // Colocando o botao de resposta dentro da tag P que acabou de ser criada
                let btn = document.createElement("a");
                btn.innerText = 'Responder';
                btn.setAttribute("class", "btn_responder");
                btn.setAttribute("href", `responder.php?cod_pergunta=${questoes[pos_card].cod_pergunta}`);
                p.appendChild(btn);
            }else {
                div_cards[pos_card].innerHTML = "Cartão " + (Number(pos_card) + (Number(1)));
                div_cards[pos_card].style.backgroundImage = "url('imagens/lampada-apagada.png')";
                div_cards[pos_card].style.backgroundColor = "#ffffff";
            }
            
        };

        show.push(false); // Bit de ocultar
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
    audio.volume = 0.15;
}

/* Manipanando o botao de  iniciar o game */
document.getElementById("init_game").onclick = function(){
    playAudio();
    let div_option = document.getElementById("load_option");
    div_option.style.display = "block";
}


// Funcao para montar a questionario para responder a pergunta
function loadFormQuestao(altenativas){
    let div_game = document.getElementById("game");
    
    // Mostrando a pergunta
    let p_pergunta = document.createElement("p");
    p_pergunta.innerText = altenativas[0].pergunta;
    div_game.appendChild(p_pergunta);

    // Criando o form
    let formAltenativa = document.createElement("form");
    formAltenativa.setAttribute("action", "#");
    formAltenativa.setAttribute("method", "get");
    formAltenativa.setAttribute("id", "form_altenativa");
    div_game.appendChild(formAltenativa);

    // Criar o radius que é as perguntas corretas
    let letra = 'A';
    for(let alt = 0; alt < altenativas.length && alt <= 5; alt++){
        let p = document.createElement("p");
        formAltenativa.appendChild(p);

        // Criando o input tipo radius
        let input = document.createElement("input");
        input.setAttribute("type", "radio");
        input.setAttribute("name", "resposta");
        input.setAttribute("id", `ID${alt}`);
        input.setAttribute("value", altenativas[alt].cod_altenativa);
        p.appendChild(input);

        // Criando o label
        let label = document.createElement("label");
        label.setAttribute("for", `ID${alt}`);
        label.innerText = ' ' + letra + ') ' +  altenativas[alt].altenativa;
        p.appendChild(label);

        letra = String.fromCharCode(letra.charCodeAt() + 1); // Mostrar as letra das altenativa 
    }

    // Colocando o botao de enviar
    let btn_submit = document.createElement("input");
    btn_submit.setAttribute("type", "submit");
    btn_submit.setAttribute("value", "Enviar");
    formAltenativa.appendChild(btn_submit);

    console.log("ATENÇÂO!!!");
    console.log("Não coloque nenhum script aqui, isso pode ser perigoso");

}