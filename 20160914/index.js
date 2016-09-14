var express = require('express');
var path = require('path');
var fs = require('fs');
var bodyParser = require('body-parser');
var app = express();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({     // to support URL-encoded bodies
          extended: true
})); 
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

app.get('/', function(req, res) {

  var todo = require('./todo.json');

  res.render('index', {
    title: 'todolist',
    todo : todo,
  });
});

app.post('/', function(req, res) {
  console.log(req.body);
  res.redirect('/');
});

var server = app.listen(3000);

console.log('Server running at http://localhost:3000/');
