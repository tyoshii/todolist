var http = require('http');
var socketio = require('socket.io');
var fs = require('fs');

var server = http.createServer(function(req,res){
  res.writeHead(200, {'Content-Type': 'text/html'});
  res.end(fs.readFileSync('./index.html', 'utf8'));
}).listen(3000);

var io = socketio.listen(server);

io.sockets.on("connection", function(socket) {
  socket.on("c2s_message", function(data) {
      console.log(data);
    var todo = data.todo;
    todo = todo + " がんばれよ！";
      console.log(todo);
    io.sockets.emit("s2c_message", {todo: todo});
  });
});
console.log('Server running at http://localhost:3000/');
