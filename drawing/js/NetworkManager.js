class NetworkManager {
	constructor() {
		this.socket_drawing = null;
		this.socket_chat = null;
	}

	registerServer_drawing(serverAddress, callback_startDrawing, callback_drawPoint, callback_endDrawing, callback_undoDrawing, callback_clearDrawing) {
		this.socket_drawing = io.connect(serverAddress);
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
			type: 'draw_point',
			content: point};
		if(!this.socket_drawing) return;
		this.socket_drawing.emit('channel_drawing', {
      		message: data
    	});
	}

	sendData_start(strokeStyle, startPoint) {
		var data = {
			type: 'start_drawing',
			content: {strokeStyle: strokeStyle, startPoint: startPoint}};
		if(!this.socket_drawing) return;
		this.socket_drawing.emit('channel_drawing', {
      		message: data
    	});
	}

	sendData_endDrawing() {
		var data = {
			type: 'end_drawing'};
		if(!this.socket_drawing) return;
		this.socket_drawing.emit('channel_drawing', {
      		message: data
    	});
	}

	sendData_undoDrawing() {
		var data = {
			type: 'undo_drawing'};
		if(!this.socket_drawing) return;
		this.socket_drawing.emit('channel_drawing', {
      		message: data
    	});
	}

	sendData_clearDrawing() {
		var data = {
			type: 'clear_drawing'};
		if(!this.socket_drawing) return;
		this.socket_drawing.emit('channel_drawing', {
      		message: data
    	});
	}

	registerServer_chat(serverAddress, callback_newChatMessage, callback_newSystemMessage) {
		this.socket_chat = io.connect(serverAddress);
		this.socket_chat.on('chat_message', function (data) {
			console.log(data.message);
			callback_newChatMessage(data.message);
		});
		this.socket_chat.on('system_message', function (data) {

		});
	}

	sendData_chatMessage(message) {
		var data = {
			type: 'chat_message',
			content: message};
		this.socket_chat.emit('channel_chat', {
      		message: data
    	});
	}

	sendData_guessAnswer(answer) {

	}

}