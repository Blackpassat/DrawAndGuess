var leaveGameButton = document.getElementById('leaveGame');
var startGameButton = document.getElementById('startGame');
var loadingPage = document.getElementById('loadingPage');
var loadingMessage = document.getElementById('loadingMessage');
var sendGuessButton = document.getElementById('sendGuessButton');
var guessInput = document.getElementById('guessInput');
var gameTimeForEachRound = 0.5 //minutes

const GAME_STATUS = {
	PREPARE : "GAME_PREPARE",
    START : "GAME_START",
    CHANGE_PLAYER : "GAME_CHANGE_PLAYER",
    TIMEOUT : "GAME_TIMEOUT",
    GAME_END : "GAME_END",
    USER_ONLINE : "GAME_USER_ONLINE",
    USER_OFFLINE : "GAME_USER_OFFLINE"
}

var networkManager;
var gameRoom;
var clock;
var roomID;
var myUserID;
var myUserName;
var joinedRoom = false;
var isDrawer=false;

class GameRoomManager {
	constructor(serverAddress, xRoomID, xMyUserID, xMyUserName) {
		roomID = xRoomID;
		myUserID = xMyUserID;
		myUserName = xMyUserName;
		leaveGameButton.disabled = true;

		networkManager = new NetworkManager(serverAddress, roomID, myUserID, xMyUserName);
		gameRoom = new GameRoom(networkManager);

		startGameButton.onclick = startGame;
		leaveGameButton.onclick = leaveGame;
		sendGuessButton.onclick = sendGuess;

		networkManager.registerChannel_system(this.receiveSystemMessage);
		enterGameRoom(roomID, myUserID);

		window.onbeforeunload = function (e) {
		  return 'Are you sure?';
		};

		window.onclose = leaveGame;
		window.onunload = leaveGame;
		// showLoadingPage();
		// requestGameResult();
	}

	changeStrokeColor(colorCode) {
		gameRoom.changeStrokeColor(colorCode);
	}

	receiveSystemMessage (message) {
		console.log("GameRoomManager: " + message);
		switch (message) {
			case GAME_STATUS.PREPARE:
				console.log("Prepare Game");
				showLoadingPage("Preparing Game...");
				break;
			case GAME_STATUS.START:
				prepareGameUI();
				setupGameRoom();
				break;
			case GAME_STATUS.USER_ONLINE:
				updateCurrentUserList();
				break;
			case GAME_STATUS.CHANGE_PLAYER:
				showLoadingPage("Next Round...");
				setupGameRoom();
				break;
			case GAME_STATUS.USER_OFFLINE:
				updateCurrentUserList();
				break;
			case GAME_STATUS.GAME_END:
				console.log("Game End...");
				showLoadingPage();
				requestGameResult();
				break;
			default:
				// statements_def
				break;
		}
	}
}

function startGame() {
	networkManager.sendData_systemMessage(GAME_STATUS.PREPARE);
	var xmlHttp;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.responseText == "success") {
		    networkManager.sendData_systemMessage(GAME_STATUS.START);
		}
	}
	var url = "http://localhost/DrawAndGuess/php_queries/startGame.php?roomId=" + roomID; 
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
}

function leaveGame() {
	networkManager.sendData_systemMessage(GAME_STATUS.USER_OFFLINE);
	var xmlHttp;
	xmlHttp = new XMLHttpRequest();
	var url = "http://localhost/DrawAndGuess/php_queries/leaveRoom.php?roomId=" + roomID + "&userId=" + myUserID; 
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
	
	window.location = "../home/home.php";
}

function showLoadingPage(message) {
	loadingPage.style.display = 'block';
	loadingMessage.innerText = message;
}

function hideLoadingPage() {
	loadingPage.style.display = 'none';
}

function prepareGameUI() {
	startGameButton.disabled = true;
	leaveGameButton.disabled = false;
	gameRoom.prepareForGame();
}

function setupGameRoom() {
	var xmlHttp;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.responseText != null) {
			var parameters = JSON.parse(xmlHttp.responseText);
			var userID = parameters[0];
			var userName = parameters[1];
			var question = parameters[2];
			// Just in case
			if (question == null) {
				question = "BAT MAN VS SUPER MAN";
			}
			// When the current player is null, means game is over
			if (userID == myUserID && question != null) {
				isDrawer = true;
				gameRoom.changeUIToDrawer(question);
		    } else {
		    	isDrawer = false;
		    	gameRoom.changeUIToGuesser();
		    	gameRoom.highlightCurrentPlayer(userName);
		    }
		    // both the guesser and drawer should see the timer
		    clock = new Clock(new Date(Date.parse(new Date()) + gameTimeForEachRound * 60 * 1000), gameRoundTimeout);
		    hideLoadingPage();
		}
	}
	var url = "http://localhost/DrawAndGuess/php_queries/getCurrent.php?roomId=" + roomID; 
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
}

function gameRoundTimeout() {
	if (!isDrawer || clock == null || !clock.isTimeout()) return;

	console.log("Game Round Time Out!");
	moveToNextPlayer();
}

function sendGuess() {
	var guess = guessInput.value;
	networkManager.sendData_guessAnswer(guess);
	guessInput.value = '';

	var xmlHttp;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.responseText == "correct") {
			moveToNextPlayer();
		}
	}
	var url = "http://localhost/DrawAndGuess/php_queries/checkGuessResult.php?roomId=" + roomID + "&userId=" + myUserID + "&guess=" + guess; 
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
}

function moveToNextPlayer() {
	var xmlHttp;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4) {
			if (xmlHttp.responseText == "success") {
				networkManager.sendData_systemMessage(GAME_STATUS.CHANGE_PLAYER);
			} else if (xmlHttp.responseText == "No next") {
				networkManager.sendData_systemMessage(GAME_STATUS.GAME_END);
			}
		}
	}
	var url = "http://localhost/DrawAndGuess/php_queries/moveToNext.php?roomId=" + roomID;
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
}

function requestGameResult() {
	clock.resetTimer();
	clock = null;

	var xmlHttp;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.responseText != null) {
		    var gameResultArray = JSON.parse(xmlHttp.responseText);
		    console.log(gameResultArray);
		    gameRoom.changeUIToGameEnd(gameResultArray);
	    	startGameButton.disabled = false;
			leaveGameButton.disabled = true;
			hideLoadingPage();
		}
	}
	var url = "http://localhost/DrawAndGuess/php_queries/getGameResult.php?roomId=" + roomID; 
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
}

// Update database on the server side
function enterGameRoom (roomID, userID) {
	showLoadingPage("Entering Game Room...");

	var xmlHttp;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.responseText == "success") {
			if (!joinedRoom) {
				networkManager.sendData_systemMessage(GAME_STATUS.USER_ONLINE);
				joinedRoom = true;
			}
		    hideLoadingPage();
		}
	}
	var url = "http://localhost/DrawAndGuess/php_queries/insertNewCurrentUser.php?roomId=" + roomID + "&userId=" + myUserID; 
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
}

// Query [CurrentUserList]
function updateCurrentUserList () {
	var xmlHttp;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.responseText != null) {
		    var usernamesArray = JSON.parse(xmlHttp.responseText);
		    console.log(usernamesArray);
		    gameRoom.updateCurrentUsersListUI(usernamesArray);
		}
	}
	var url = "http://localhost/DrawAndGuess/php_queries/queryCurrentUser.php?roomId=" + roomID; 
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
}
