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
				setupGameRoom(false);
				break;
			case GAME_STATUS.USER_ONLINE:
				updateCurrentUserList();
				break;
			case GAME_STATUS.CHANGE_PLAYER:
				showLoadingPage("Next Round...");
				setupGameRoom(true);
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
	xmlHttp.open("GET", "http://localhost/dummy/startGame.php", true);
	xmlHttp.send(null);
}

function leaveGame() {
	
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

function setupGameRoom(shouldChangePlayer) {
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
			if (userID == null) {
				console.log("Game End!");
				gameRoom.changeUIToGameEnd();
			} else if (userID == myUserID && question != null) {
				gameRoom.changeUIToDrawer(question);
		    } else {
		    	// Highlight current player
		    	gameRoom.changeUIToGuesser();
		    }
		    // both the guesser and drawer should see the timer
		    clock = new Clock(new Date(Date.parse(new Date()) + gameTimeForEachRound * 60 * 1000), gameRoundTimeout);
		    hideLoadingPage();
		}
	}
	xmlHttp.open("GET", "http://localhost/dummy/currentPlayer.php", true);
	xmlHttp.send(null);
}

function gameRoundTimeout() {
	if (clock == null || !clock.isTimeout()) return;

	console.log("Game Round Time Out!");
	networkManager.sendData_systemMessage(GAME_STATUS.CHANGE_PLAYER);
}

function sendGuess() {
	var guess = guessInput.value;
	networkManager.sendData_guessAnswer(guess);
	guessInput.value = '';

	var xmlHttp;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.responseText == "correct") {
			networkManager.sendData_systemMessage(GAME_STATUS.CHANGE_PLAYER);
		}
	}
	xmlHttp.open("GET", "http://localhost/dummy/checkGuessResult.php", true);
	xmlHttp.send(null);
}



// Update database on the server side

// Insert [userID] to {currentPlayer}
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
	xmlHttp.open("GET", "http://localhost/dummy/insertNewCurrentUser.php", true);
	xmlHttp.send(null);
}

// Query [CurrentUserList]
function updateCurrentUserList () {
	var xmlHttp;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.responseText != null) {
			console.log(xmlHttp.responseText);
		    var id_numbers = JSON.parse(xmlHttp.responseText);
		    console.log(id_numbers);
		    // Update UI
		}
	}
	xmlHttp.open("GET", "http://localhost/dummy/queryCurrentUser.php", true);
	xmlHttp.send(null);
}
