setInterval(refreshPlayers, 1500);

//Atualizar quantidade de jogadores
function refreshPlayers(){
	$.ajax({
		type: "POST",
		dataType: "json",
		url: dir + "/modules/restAPI/getRound/",
		data: "token=" + token,
		complete: function(data){
			data = data.responseJSON;
			document.getElementById("startGamePlayers").innerHTML = data.playersNumber + " Jogadores...";
			console.log(data);
		}
	});
}