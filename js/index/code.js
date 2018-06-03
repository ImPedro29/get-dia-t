//Intervals e Timeouts
setInterval(refreshPlayers, 1500);

//Variaveis
var buttonStart = document.getElementById("startGame");
var numberOfPlayers = document.getElementById("startGamePlayers");
var token = null;

//Quando clicar no botão iniciar
buttonStart.onclick = function(){
	startGame();
	buttonStart.disabled = true;
}


//Quando for para iniciar o jogo
function startGame(){
	setTimeout(function(){ registerUser(); }, 700);
}

//Registrar usuário no round atual
function registerUser(){
	var username;
	if(getCookie("username") == "" || !userExists()){
		username = prompt("Digite seu nome: ");
		while(username == "" || username == null || username === ""){
			username = prompt("Você não pode deixar em branco, digite seu nome: ");
		}
		var rdNumber = parseInt(Math.random()*10000);
		
		username = rdNumber + username;
	}else{
		username = getCookie("username");
	}
	
	$.ajax({
		type: "GET",
		dataType: "json",
		url: dir + "/modules/restAPI/registerUser/",
		data: "username=" + username,
		complete: function(data){
		},
		success: function(data){
			data = data.responseJSON;
			setCookie("username", username, 2);
		}
	});
}

//Atualizar quantidade de jogadores
function refreshPlayers(){
	$.ajax({
		type: "POST",
		dataType: "json",
		url: dir + "/modules/restAPI/getRound/",
		data: "token=" + token,
		complete: function(data){
			data = data.responseJSON;
			if(numberOfPlayers.innerHTML != data.playersNumber + " Jogadores..." && status == 0){
				numberOfPlayers.innerHTML = data.playersNumber + " Jogadores...";
			}
		}
	});
}

//w3Schools COOKIE
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

