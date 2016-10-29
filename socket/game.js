window.onload = function() {
	var socket = io.connect('http://localhost:1234');
	var input = document.getElementById('messageInput');
	socket.on('message', function (data) {
		console.log(data.message);
	});

	var sendButton = document.getElementById('sendButton');
	sendButton.onclick = function() {
	socket.emit('saySomething', {
      	message: input.value
    });
};
};

