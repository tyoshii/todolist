<html>
<head>
</head>
<body>
<h1>Todo List</h1>

<div id="todolist"></div>

<h2>追加</h2>

<form id="todoadd" action="#">
<input id="todoaddtext" type="text" name="todo-add">
<a href="#" onClick="add_todo();">追加</a>
</form>

</body>
</html>

<script type="text/javascript">

var c = 0;

function add_todo() {

	var textnode = document.forms.todoadd.todoaddtext;
	var text = textnode.value;
	textnode.value = "";

	if (text === '') {
		alert("Todoを入れてください");
		return false;
	}

	id = c++;

	var li = document.createElement('li');
	li.textContent = text;
	li.setAttribute("id", id);

	var a = document.createElement("a");
	a.textContent = "削除";
	a.setAttribute("href", "#");
	a.setAttribute("onClick", "delete_todo("+id+");");

	li.appendChild(a);

	document.getElementById("todolist").appendChild(li);

}

function delete_todo(id) {
	var target = document.getElementById(id);
	target.parentNode.removeChild(target);
}
</script>
