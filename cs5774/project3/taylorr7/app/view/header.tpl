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
	if(!isset($_SESSION['username'])) {
		header('Location: '.BASE_URL.'/login');
		exit();
	}
?>

	<div id="header">
		<div class="headNav">
			<form action="<?= BASE_URL ?>/search/" method="GET">
				<input type="text" value="Search" name="mainSearch" />
			</form>
			<button onclick="sendToPage('<?= BASE_URL ?>')"> Home </button>
			<button onclick="help()"> Help </button>
			<button onclick="sendToPage('<?= BASE_URL ?>/logout')"> Logout </button>
		</div>
		<h1> Thought Share </h1>
	</div>
	
	<hr />