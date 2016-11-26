var leaveGameButton = document.getElementById('leaveGame');
var startGameButton = document.getElementById('startGame');
var loadingPage = document.getElementById('loadingPage');
var loadingMessage = document.getElementById('loadingMessage');

const GAME_STATUS = {
	PREPARE : "GAME_PREPARE",
    START : "GAME_START",
    CHANGE_PLAYER : "GAME_CHANGE_PLAYER",
    TIMEOUT : "GAME_TIMEOUT"
}

var networkManager;
var gameRoom;
var clock

class GameRoomManager {
	constructor(serverAddress, roomID, myUserID) {
		this.roomID = roomID;
		this.myUserID = myUserID;
		leaveGameButton.disabled = true;

		networkManager = new NetworkManager(serverAddress, roomID, myUserID);
		gameRoom = new GameRoom(networkManager);

		startGameButton.onclick = this.startGame;
		leaveGameButton.onclick = this.leaveGame;

		networkManager.registerChannel_system(this.receiveSystemMessage);
		enterGameRoom(roomID, myUserID);
	}

	changeStrokeColor(colorCode) {
		gameRoom.changeStrokeColor(colorCode);
	}

	startGame() {
		networkManager.sendData_systemMessage(GAME_STATUS.PREPARE);
		// showLoadingPage();
	}

	leaveGame() {
		networkManager.sendData_systemMessage(GAME_STATUS.START);
	}

	receiveSystemMessage (message) {
		switch (message) {
			case GAME_STATUS.PREPARE:
				console.log("Prepare Game");
				showLoadingPage("Preparing Game...");
				break;
			case GAME_STATUS.START:
				hideLoadingPage();
				prepareGameUI();
				break;
			default:
				// statements_def
				break;
		}
	}
}

function showLoadingPage(message) {
	loadingPage.style.display = 'block';
	loadingMessage.innerText = message;
}

function hideLoadingPage() {
	loadingPage.style.display = 'none';
}

function prepareGameUI() {
	gameRoom.prepareForGame();
	clock = new Clock();
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
	xmlHttp.open("GET", "http://localhost/dummy.php", true);
	xmlHttp.send(null);
}

