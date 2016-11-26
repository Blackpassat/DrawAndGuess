var leaveGameButton = document.getElementById('leaveGame');
var startGameButton = document.getElementById('startGame');
var loadingPage = document.getElementById('loadingPage');
var loadingMessage = document.getElementById('loadingMessage');

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

class GameRoomManager {
	constructor(serverAddress, xRoomID, xMyUserID) {
		roomID = xRoomID;
		myUserID = xMyUserID;
		leaveGameButton.disabled = true;

		networkManager = new NetworkManager(serverAddress, roomID, myUserID);
		gameRoom = new GameRoom(networkManager);

		startGameButton.onclick = startGame;
		leaveGameButton.onclick = leaveGame;

		networkManager.registerChannel_system(this.receiveSystemMessage);
		enterGameRoom(roomID, myUserID);
	}

	changeStrokeColor(colorCode) {
		gameRoom.changeStrokeColor(colorCode);
	}

	receiveSystemMessage (message) {
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

function setupGameRoom() {
	var xmlHttp;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.responseText != null) {
			console.log("Current Player: " + xmlHttp.responseText);
		    if (xmlHttp.responseText == myUserID) {
		    	// TODO: GET Question from response
		    	gameRoom.changeUIToDrawer("BAT MAN VS SUPER MAN");
		    	clock = new Clock();
		    } else {
		    	// Highlight current player
		    	gameRoom.changeUIToGuesser();
		    }
		    hideLoadingPage();
		}
	}
	xmlHttp.open("GET", "http://localhost/dummy/currentPlayer.php", true);
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

