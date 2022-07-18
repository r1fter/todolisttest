<!DOCTYPE html>
<html>
<head>
	<title>ToDo List Test</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/static/css/main.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<?php if(!$GLOBALS['is_admin']): ?>
		<a href="/login" class="btn btn-outline-success my-2 my-sm-0 mx-3" type="submit">Войти</a>
	<?php else: ?>
		<a href="/logout" class="btn btn-outline-success my-2 my-sm-0 mx-3">Выйти</a>
		<a href="/task/index" class="btn btn-outline-success my-2 my-sm-0 mx-3">Панель управления</a>
	<?php endif; ?>
	<a href="/" class="btn btn-outline-success my-2 my-sm-0 mx-3">Главная</a>
</nav>