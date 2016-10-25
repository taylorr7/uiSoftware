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

	<div id="accountInfo" class="notUser">
		<form id="register" action="<?= BASE_URL ?>/register/process" onsubmit="return validateForm()" method="POST">
			<label>Username: <input type="text" name="user"></label> <br>
			<label>Password: <input type="password" name="pass"></label> <br>
			<label>Re-Enter Password: <input type="password" name="passV"></label> <br>
			<label>First Name: <input type="text" name="fname"></label> <br>
			<label>Last Name: <input type="text" name="lname"></label> <br>
			<label>Email: <input type="text" name="email"></label> <br>
			<input type="submit" name="submit" value="Register">
		</form>
	</div>
	
</body>

</html>