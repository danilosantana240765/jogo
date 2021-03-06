let div_game = document.getElementById("game");
let div_cards = document.getElementsByClassName("card");
let div_cards_main = document.getElementsByClassName("card_main");
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
if(div_cards_main != null){
    let show = Array();
    for(let pos_card in div_cards_main){
        div_cards_main[pos_card].onclick = function(){
            audioEfeito();
            show[pos_card] = !show[pos_card]
            if(questoes != null && show[pos_card]){
                div_cards[pos_card].innerHTML = questoes[pos_card].pergunta;
                div_cards_main[pos_card].style.backgroundImage = "url('imagens/lampada_acesa.png')";
                div_cards_main[pos_card].style.backgroundColor = "#cecece";
                // Colando elemento para responder a pergunta dentro da tag
                let p = document.createElement("p");
                div_cards_main[pos_card].appendChild(p);

                // Colocando o botao de resposta dentro da tag P que acabou de ser criada
                if(!lockQuestao(pos_divs_respondidas, pos_card)){
                    let btn = document.createElement("a");
                    btn.innerText = 'Responder';
                    btn.setAttribute("class", "btn_responder");
                    btn.setAttribute("href", `responder.php?cod_pergunta=${questoes[pos_card].cod_pergunta}`);
                    p.appendChild(btn);
                }else {
                    div_cards_main[pos_card].style.backgroundImage = "url('imagens/lampada-apagada.png')";
                    div_cards[pos_card].innerHTML = "Carta " + (Number(pos_card) + (Number(1)));
                }
            }else {
                div_cards[pos_card].innerHTML = "Carta " + (Number(pos_card) + (Number(1)));
                div_cards_main[pos_card].style.backgroundImage = "url('imagens/lampada-apagada.png')";
                div_cards_main[pos_card].style.backgroundColor = "#ffffff";
                if(lockQuestao(pos_divs_respondidas, pos_card)){
                    div_cards_main[pos_card].style.backgroundColor = "#cecece";
                }
                div_cards_main[pos_card].removeChild(div_cards_main[pos_card].lastChild);
            }
            
        };

        show.push(false); // Bit de ocultar
    }
}

// Funcao para travar as divs que já foram respondidas
function lockQuestao(array_pos = Array(), busca){
    let pos = 0;
    let is_encontrado = false;
    while(pos < array_pos.length && !is_encontrado){
        if(array_pos[pos] == busca)
            is_encontrado = !is_encontrado;
        pos++;
    }

    return is_encontrado;
}

// Funcao para travar as divs que já foram respondidas
function lockQuestaoEstaticamente(array_pos = Array()){
    let pos = 0;
    let div_cards_main = document.getElementsByClassName("card_main");
    for(pos in array_pos){
        div_cards_main[array_pos[pos]].style.backgroundColor = '#cecece';
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
    formAltenativa.setAttribute("method", "GET");
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
        if(alt == 0){
            input.setAttribute("checked", "");
        }
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
    btn_submit.setAttribute("id", "btn_submit");
    btn_submit.setAttribute("value", "Enviar");
    formAltenativa.appendChild(btn_submit);

    /*console.log("ATENÇÂO!!!");
    console.log("Não coloque nenhum script aqui, isso pode ser perigoso");*/

}

/* Funcao para capturar responsta e enviar para o servidor */
function checkResposta(){
    let div_game = document.getElementById("game");
    let input = document.getElementsByTagName("input");
    let form = document.getElementById("form_altenativa");
    let div_response = document.getElementById("msg_resposta_ajax");

    let id_altenativa = -1; // Guarda o ID da altenativa selecionado pelo usuário

    // Quando apertar no botao de enviar verificar o valor marcado e fazer requisição ajax
    form.addEventListener("submit", function(event){
        event.preventDefault(); // Não vai precisar atualizar a página

        // Verificando o input que foi marcado
        for(pos = 0; pos < input.length; pos++){
            if(input[pos].getAttribute("type") == "radio" && input[pos].checked){
                id_altenativa = input[pos].value;
            }
        }

        // Pegando o elemento que mostra a tela de carregamento
        let div_load = document.getElementById("load");

        // Mandar a requisicao para verificar a resposta do usuário
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                // Tirando a barra de carregamento
                resul = JSON.parse(xhr.response)[0];
               
                // verificando o status do erro
                if(resul.erro != undefined){
                    div_response.innerHTML = resul.erro;
                }else {
                    
                    div_response.setAttribute("class", "error");
                    // Tratar o retorno do tipo de resposta
                    if(resul.resposta != undefined && resul.resposta == "CERTA"){
                        div_response.innerHTML = 'Parabéns! Você acertou!';
                        div_response.setAttribute("class", "sucess");

                        // Colocando o total de ponto acomulado pelo usuario
                        if(resul.tot_ponto != undefined)
                            document.getElementById("tot_ponto").innerHTML = `Pontos: ${resul.tot_ponto}`;
                    }else if(resul.resposta != undefined && resul.resposta == "ERRADA"){
                        div_response.innerHTML = 'Infelizmente você errou a questao!';
                    }else {
                        div_response.innerHTML = 'Você já respondeu essa questao!';
                    }
                }

                div_load.style.display = 'none'; // Ocultando a tela de carregamento
            }else {
                div_load.style.display = 'block'; // Mostrando a tela de carregamento
            }
        }

        let url = "requisicoes.php?type=vR&resposta=" +  id_altenativa;
        xhr.open("GET", url, true);
        xhr.send();
    });

}