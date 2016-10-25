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
	if(!isset($_SESSION['user'])) {
		header('Location: '.BASE_URL.'/login');
		exit();
	}
	$_SESSION = array();
	session_unset();
	session_destroy();
	header('Location: '.BASE_URL);
	exit();

?>

</body>

</html>