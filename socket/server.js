var io = require('socket.io').listen(1234);
io.sockets.on('connection', function (socket) {
	socket.on('channel_drawing', function(data) {
		console.log(data.message.type);
		console.log(data.message.content);
      socket.broadcast.emit(data.message.type, {
        message: data.message.content
      });
    });

    socket.on('channel_chat', function(data) {
		console.log(data.message.type);
		console.log(data.message.content);
      socket.broadcast.emit(data.message.type, {
        message: data.message.content
      });
    });
});