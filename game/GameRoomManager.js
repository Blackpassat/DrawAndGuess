var leaveGameButton = document.getElementById('leaveGame');
var startGameButton = document.getElementById('startGame');
var loadingPage = document.getElementById('loadingPage');

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
		networkManager.registerChannel_system(this.receiveSystemMessage);

		gameRoom = new GameRoom(networkManager);
		clock = new Clock();

		startGameButton.onclick = this.startGame;
		leaveGameButton.onclick = this.leaveGame;
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
				showLoadingPage();
				break;
			case GAME_STATUS.START:
				console.log("WElcomd to the gaem");
				hideLoadingPage();
				prepareGameUI();
				break;
			default:
				// statements_def
				break;
		}
	}
}

function showLoadingPage() {
	loadingPage.style.display = 'block';
}

function hideLoadingPage() {
	loadingPage.style.display = 'none';
}

function prepareGameUI() {
	gameRoom.prepareForGame();
}

