class NetworkManager {
	constructor() {
		this.socket_drawing = null;
	}

	registerServer_drawing(serverAddress, callback_startDrawing, callback_drawPoint, callback_endDrawing) {
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
}