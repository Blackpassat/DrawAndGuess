var io = require('socket.io');

class NetworkManager {
	constructor() {
		this.socket_drawing = null;
	}

	registerServer_drawing(serverAddress, callback) {
		this.socket_drawing = io.connect(serverAddress);
		this.socket_drawing.on('message', function (data) {
			console.log(data.message);
			callback(data.message);
		});
		
		this.socket_drawing.on('doMessage', function (data) {
			console.log(data.message);
			callback("Do something" + data.message);
		});
	}

	sendData_drawing(messageContent) {
		if(!this.socket_drawing) return;
		this.socket_drawing.emit('saySomething', {
      		message: messageContent
    	});
	}

	sendData_start(messageContent) {
		if(!this.socket_drawing) return;
		this.socket_drawing.emit('doSomething', {
      		message: messageContent
    	});
	}
}