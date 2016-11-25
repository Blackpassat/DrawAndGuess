var leaveGameButton = document.getElementById('leaveGame');

class GameRoomManager {
	constructor(serverAddress, roomID, myUserID) {
		this.startGameButton = document.getElementById('startGame');
		// this.leaveGameButton = document.getElementById('leaveGame');
		this.roomID = roomID;
		this.myUserID = myUserID;
		leaveGameButton.disabled = true;

		this.networkManager = new NetworkManager(serverAddress, roomID, myUserID);
		this.gameRoom =  new GameRoom(this.networkManager);
		this.gameRoom.prepareForGame();
	}

	changeStrokeColor(colorCode) {
		this.gameRoom.changeStrokeColor(colorCode);
	}
}