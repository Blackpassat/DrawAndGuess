class NetworkManager {
	constructor(serverAddress, roomID, myUserID) {
		this.serverAddress = serverAddress;
		this.roomID = roomID;
		this.myUserID = myUserID;

		this.socket_drawing = null;
		this.socket_chat = null;
		this.socket_system = null;
	}

	registerChannel_system(callback_system) {
		this.socket_system = io.connect(this.serverAddress);
		this.socket_system.emit('join', this.roomID);

		this.socket_system.on('game_status', function (data) {
			console.log(data.message);
			callback_system(data.message);
		});
	}

	sendData_systemMessage(message) {
		var data = {
			roomID: this.roomID,
			type: 'game_status',
			content: message};
		
		this.socket_system.emit('channel_system', {
      		message: data
    	});
	}

	registerChannel_drawing(callback_startDrawing, callback_drawPoint, callback_endDrawing, callback_undoDrawing, callback_clearDrawing) {
		this.socket_drawing = io.connect(this.serverAddress);
		this.socket_drawing.emit('join', this.roomID);

		this.socket_drawing.on('start_drawing', function (data) {
			console.log(data.message.startPoint);
			callback_startDrawing(data.message.strokeStyle, data.message.startPoint);
		});
		
		this.socket_drawing.on('draw_point', function (data) {
			console.log(data.message);
			callback_drawPoint(data.message);
		});

		this.socket_drawing.on('end_drawing', function (data) {
			callback_endDrawing();
		});

		this.socket_drawing.on('undo_drawing', function (data) {
			callback_undoDrawing();
		});

		this.socket_drawing.on('clear_drawing', function (data) {
			callback_clearDrawing();
		});
	}

	sendData_startDrawing(point) {
		var data = {
			roomID: this.roomID,
			type: 'draw_point',
			content: point};
		if(!this.socket_drawing) return;
		this.socket_drawing.emit('channel_drawing', {
      		message: data
    	});
	}

	sendData_start(strokeStyle, startPoint) {
		var data = {
			roomID: this.roomID,
			type: 'start_drawing',
			content: {strokeStyle: strokeStyle, startPoint: startPoint}};
		if(!this.socket_drawing) return;
		this.socket_drawing.emit('channel_drawing', {
      		message: data
    	});
	}

	sendData_endDrawing() {
		var data = {
			roomID: this.roomID,
			type: 'end_drawing'};
		if(!this.socket_drawing) return;
		this.socket_drawing.emit('channel_drawing', {
      		message: data
    	});
	}

	sendData_undoDrawing() {
		var data = {
			roomID: this.roomID,
			type: 'undo_drawing'};
		if(!this.socket_drawing) return;
		this.socket_drawing.emit('channel_drawing', {
      		message: data
    	});
	}

	sendData_clearDrawing() {
		var data = {
			roomID: this.roomID,
			type: 'clear_drawing'};
		if(!this.socket_drawing) return;
		this.socket_drawing.emit('channel_drawing', {
      		message: data
    	});
	}

	registerChannel_chat(callback_newChatMessage, callback_newSystemMessage) {
		this.socket_chat = io.connect(this.serverAddress);
		this.socket_chat.emit('join', this.roomID);

		this.socket_chat.on('chat_message', function (data) {
			console.log(data.message);
			callback_newChatMessage(data.message);
		});
	}

	sendData_chatMessage(message) {
		var data = {
			roomID: this.roomID,
			type: 'chat_message',
			content: message};
		this.socket_chat.emit('channel_chat', {
      		message: data
    	});
	}

	sendData_guessAnswer(answer) {

	}

}