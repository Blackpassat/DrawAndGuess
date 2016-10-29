var io = require('socket.io').listen(1234);
io.sockets.on('connection', function (socket) {
	socket.on('saySomething', function(data) {
	console.log(data.message);
      socket.broadcast.emit('message', {
        message: data.message
      });
    });
});