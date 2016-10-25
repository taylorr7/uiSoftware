<!DOCTYPE html>
<html lang="en">

<head>
	<title> Thought Share | <?= $pageName ?> </title>
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/main.css">
	<script src="<?= BASE_URL ?>/public/scripts/jquery.js"></script>
	<script src="<?= BASE_URL ?>/public/scripts/main.js"></script>
	<meta charset="UTF-8"> 
</head>

<body>

<?php
	session_start();
	if(isset($_SESSION['user'])) {
		header('Location: '.BASE_URL);
		exit();
	}
?>

	<div id="header">
		<h1> Thought Share </h1>
	</div>
	
	<hr />

	<div class="notUser">
		<form id="login" action="<?= BASE_URL ?>/login/process" method="POST">
			<label>Username: <input type="text" name="user"></label>
			<label>Password: <input type="password" name="pass"></label> <br>
			<input type="submit" name="submit" value="Login">
		</form>
		<button onclick="sendToPage('<?= BASE_URL ?>/register')"> Register </button>
	</div>
	
</body>

</html>