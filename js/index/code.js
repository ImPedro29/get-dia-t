//Variaveis
var questionNumberAjax;

var interval = 50; //Segundos para resolver a questão
var intervalTime = 5; //Segundos de intervalo entre as questões

var buttonStart = document.getElementById("startGame");
var numberOfPlayers = document.getElementById("startGamePlayers");
var scheduleBox = document.getElementById("schedule");
var messageBox = document.getElementById("message");
var question = document.getElementById("question");
var questionNumber = document.getElementById("questionNumber");

var ended = false;

var name;
var theQuestion;
var round = 0;

var status = 0;
var gameStatus = 1; //0 -> Intervalo entre Questões 1 ->Intervalo para resolver questão

var numberOfQuestionsForResolver = 1;
var numberOfQuestions = 0; // Não mecher

//Inicial Questão...
question.classList.add("displayNone");

//Eventos
buttonStart.onclick = function(){
	if(status == 0){
		startGame();
	}else if(status == 1){
		restartGame();
	}
}

//Iniciar jogo
function startGame(){
	if(getCookie("name") == "" || getCookie("name") == "null" || getCookie("name") == null){
		while(name == "" || name == "null" || name == null){
			name = prompt("Digite seu nome:");
		}
		name = parseInt(Math.random()*100000) + name;
		setCookie("name", name, 30);
	}else{
		name = getCookie("name");
	}
	status = 1;
	setTimeout(function(){
		scheduleBox.classList.add("scheduleActived");
		scoreStart(intervalTime);
	}, 100);
	setTimeout(function(){
		
	}, interval*1000);
	buttonStart.classList.add("startGameAnimationButton");
	buttonStart.innerHTML = "Novo Jogo!<h5 id='startGamePlayers'>Em andamento...";
	message("Iniciando o jogo...<br>Prepare-se!");
}

var scheduleScore;
//Contar no contador
function scoreStart(Time){
	var time = Time;
	clearInterval(scheduleScore);
	registerPlayer();
	scheduleScore = setInterval(function(){
		scheduleBox.innerHTML = time;
		scheduleBoxAnimation();
		time--;
		if(time == -2){
			clearInterval(scheduleScore);
			moveScheduleBox();
			scheduleBox.innerHTML = 0;
			setTimeout(function(){ restartSchedule(); }, 400);
		}
	}, 1000);
}

//Animação de quanto o número passa
function scheduleBoxAnimation(){
	scheduleBox.classList.add("scheduleActivedAnimation");
	setTimeout(function(){
		scheduleBox.classList.remove("scheduleActivedAnimation");
	}, 600);
}

//Mover Contagem
function moveScheduleBox(){
	scheduleBox.classList.add("scheduleDesactivedAnimation");
}

function registerPlayer(){
	$.ajax({
		type: "GET",
		dataType: "json",
		url: dir + "/modules/restAPI/registerPlayer/",
		data: "username=" + name,
		complete: function(data){
			data = data.responseJSON;
			if(data.error){
				message("Ocorreu um erro... Reiniciando rodada.");
				setTimeout(function(){ window.location = window.location; }, 2000);
			}
			theQuestion = data.question;
			round = data.roundID;
		}
	});
}

function restartSchedule(){
	if(gameStatus == 0){
		numberOfQuestions++;		
		if(numberOfQuestions == numberOfQuestionsForResolver){
			//Quando terminar a contagem e terminar o jogo
			message("Vencedores...");
			onEnd();
		}else{
			message("Intervalo...");
			unShowQuestion();
			scoreStart(intervalTime)
			scheduleBox.classList.remove("scheduleActivedAnimation");
			scheduleBox.classList.remove("scheduleDesactivedAnimation");
			gameStatus = 1;
		}
		
	}
	else{
		message("Vamos, resolva rápido!");
		showQuestion();
		scoreStart(interval);
		gameStatus = 0;
	}
}

//Mudar mensagens
function message(text){
	messageBox.innerHTML = text;
}

//Mostrar Questão
function showQuestion(){
	question.classList.remove("displayNone");
	questionNumber.innerHTML = "Pergunta 0" + (numberOfQuestions+1) + ":";
	$.ajax({
		type: "GET",
		dataType: "json",
		url: dir + "/modules/restAPI/getQuestion/",
		data: "question=" + theQuestion,
		complete: function(data){
			data = data.responseJSON;
			if(data.error){
				message("Ocorreu um erro... Reiniciando rodada.");
				setTimeout(function(){ window.location = window.location; }, 2000);
			}else{
				document.getElementById("questionEnunciation").innerHTML = data.enunciation;
				document.getElementById("questionImage").src = "data:image/jpeg;base64," + data.image;
				document.getElementById("alternativeA").innerHTML = "A: " + data.alternatives[0];
				document.getElementById("alternativeB").innerHTML = "B: " + data.alternatives[1];
				document.getElementById("alternativeC").innerHTML = "C: " + data.alternatives[2];
				document.getElementById("alternativeD").innerHTML = "D: " + data.alternatives[3];
				document.getElementById("alternativeE").innerHTML = "E: " + data.alternatives[4];
			}
		}
	});
}

//"Desamostrar" questão
function unShowQuestion(){
	question.classList.add("displayNone");
}

//Quando terminar
function onEnd(){
	unShowQuestion();
	scoreStart(10);
	setTimeout(function(){
		restartGame();
	}, 10000);
	message("Volte às 12:00 para ver o resultado!");
}

function endGame(num , el){
	if(!ended){
		var points = parseInt((parseInt(document.getElementById("schedule").innerHTML)/interval)*10);
		$.ajax({
			type: "GET",
			dataType: "json",
			url: dir + "/modules/restAPI/sendResponse/",
			data: {"alternative": num, "name": name, "question": theQuestion, "id": round, "points": points},
			complete: function(data){
				data = data.responseJSON;
				if(data.error){
					message("Ocorreu um erro... Reiniciando rodada.");
					setTimeout(function(){ window.location = window.location; }, 2000);
				}else{
					ended = true;
					if(data.correct){
						el.style.borderColor = "#26de26";
					}else{
						el.style.borderColor = "red";
					}
					scoreStart(10);
					message("Reiniciando jogo...");
					setTimeout(function(){
						restartGame();
					}, 10000);
				}
			}
		});
	}
}

//Reiniciar jogo
function restartGame(){
	window.location = window.location;
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

