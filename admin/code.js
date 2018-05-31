//Intervals e Timeouts
setInterval(refreshPlayers, 1500);

//Variaveis
var interval = 15; //Segundos para resolver a questão
var intervalTime = 5; //Segundos de intervalo entre as questões

var buttonStart = document.getElementById("startGame");
var numberOfPlayers = document.getElementById("startGamePlayers");
var scheduleBox = document.getElementById("schedule");
var messageBox = document.getElementById("message");
var question = document.getElementById("question");
var questionNumber = document.getElementById("questionNumber");

var status = 0;
var gameStatus = 1; //0 -> Intervalo entre Questões 1 ->Intervalo para resolver questão

var numberOfQuestionsForResolver = 2;
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

//Iniciar jogo
function startGame(){
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

//Contar no contador
function scoreStart(Time){
	var time = Time;
	
	var scheduleScore = setInterval(function(){
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
		type: "POST",
		dataType: "json",
		url: dir + "/modules/restAPI/questionSender/",
		data: "token=" + token,
		complete: function(data){
			data = data.responseJSON;
			if(data.error){
				message("Ocorreu um erro... Reiniciando rodada.");
				setTimeout(function(){ window.location = window.location; }, 2000);
			}			
		}
	});
}

//"Desamostrar" questão
function unShowQuestion(){
	question.classList.add("displayNone");
}

//Mostrar RANK
function showRank(){
	
}

//Quando terminar
function onEnd(){
	showRank();
	unShowQuestion();
}

//Reiniciar jogo
function restartGame(){
	window.location = window.location;
}