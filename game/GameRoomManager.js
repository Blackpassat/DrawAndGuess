var leaveGameButton = document.getElementById('leaveGame');
var startGameButton = document.getElementById('startGame');
var loadingPage = document.getElementById('loadingPage');

class GameRoomManager {
	constructor(serverAddress, roomID, myUserID) {
		this.roomID = roomID;
		this.myUserID = myUserID;
		leaveGameButton.disabled = true;

		var networkManager = new NetworkManager(serverAddress, roomID, myUserID);
		networkManager.registerChannel_system(receiveSystemMessage);

		var gameRoom = new GameRoom(networkManager);
		var clock = new Clock();

		startGameButton.onclick = this.startGame;
		gameRoom.prepareForGame();
	}

	changeStrokeColor(colorCode) {
		gameRoom.changeStrokeColor(colorCode);
	}

	showLoadingPage() {
		loadingPage.style.display = 'block';
	}

	hideLoadingPage() {
		loadingPage.style.display = 'none';
	}

	prepareGameUI() {
		this.gameRoom.prepareForGame();
	}

	startGame() {
		networkManager.sendData_systemMessage("Start Game!");
	}
}

function receiveSystemMessage (message) {
	console.log(message);
}