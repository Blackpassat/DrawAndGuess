var io = require('socket.io').listen(1234);
io.sockets.on('connection', function (socket) {

  socket.on('channel_system', function(data) {
    console.log(data.message.type);
    console.log(data.message.content);
    console.log(data.message.roomID);
      io.to(data.message.roomID).emit(data.message.type, {
        message: data.message.content
      });
  });

  socket.on('channel_drawing', function(data) {
		console.log(data.message.type);
		console.log(data.message.content);
      socket.broadcast.to(data.message.roomID).emit(data.message.type, {
        message: data.message.content
      });
  });

  socket.on('channel_chat', function(data) {
	console.log(data.message.type);
	console.log(data.message.content);
    socket.broadcast.to(data.message.roomID).emit(data.message.type, {
      message: data.message.content
    });
  });

  socket.on('join', function(roomID) {
      socket.broadcast.to(roomID).emit('game_status', {
        message: "GAME_USER_ONLINE"
      });
      socket.join(roomID);
  });
});