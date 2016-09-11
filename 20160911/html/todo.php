<?php
$todo_file = "/tmp/todo.json";
$todo = array();
if (file_exists($todo_file)) {
	$data = json_decode(file_get_contents($todo_file));
	if (! is_null($data)) {
		$todo = $data;
	}
}

$method = $_SERVER['REQUEST_METHOD'];
echo $method;
if ($method === "POST") {
	#追加
	$todo[] = array("name" => $_POST["name"]);
	file_put_contents($todo_file, json_encode($todo));
	header("Location: " . $_SERVER['PHP_SELF']);
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

<h1>todolist</h1>
<div id="todolist">
<?php
foreach ($todo as $id => $data) {
	echo $id + 1;
	echo "\t";
	echo $data->name;
	echo "\t";
	echo "削除";
	echo "\t";
	echo "変更";
	echo "<br>";
}

?>

</div>

<h2>TodoListへの追加</h2>

<form action="" method="POST">
<input type="text" name="name">
<input type="submit" value="追加">
</form>
</body>
</html>

<?php
?>
