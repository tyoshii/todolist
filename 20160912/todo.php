<?php
$todo = array();
$todo_file = "/tmp/todo.json";

if (file_exists($todo_file) && filesize($todo_file) !== 0) {
	$todo = json_decode(file_get_contents($todo_file), true);
}
if ($_POST) {
	if ($_POST["method"] === "update") {
		$todo[$_POST["id"]] = $_POST;
	}
	elseif ($_POST["method"] === "delete") {
		unset($todo[$_POST["id"]]);
	}
	else {
		$todo[] = $_POST;
	}

	file_put_contents($todo_file, json_encode($todo));
	header('Location: /todo.php');
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>todo list</title>
</head>
<body>

<h1>todo list</h1>
<table border="1" class="table">
<tr>
<th>Todo</th>
<th>更新</th>
<th>削除</th>
</tr>

<?php if (is_array($todo)): ?>
<?php foreach ($todo as $index => $data): ?>
<tr>
<td><?php echo $data["todo"] ?></td>
<td>
<form action="" method="POST">
<input type="text" name="todo">
<input type="hidden" name="method" value="update">
<input type="hidden" name="id" value="<?php echo $index ?>">
<input type="submit" value="更新">
</form>
</td>
<td>
<form action="" method="POST">
<input type="hidden" name="method" value="delete">
<input type="hidden" name="id" value="<?php echo $index ?>">
<input type="submit" value="削除">
</form>
</td>
</tr>
<?php endforeach; ?>
<?php endif; ?>
</table>

<h2>追加</h2>
<form action="" method="POST">
<input type="text" name="todo">
<input type="submit" value="追加">
</form>

</body>
</html>
