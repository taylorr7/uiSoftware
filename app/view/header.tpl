<!DOCTYPE html>
<html lang="en">

<head>
	<title> Thought Share | <?= $pageName ?> </title>
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/main.css">
	<script src="<?= BASE_URL ?>/public/scripts/jquery.js"></script>
	<script src="<?= BASE_URL ?>/public/scripts/main.js"></script>
	<script type="text/javascript">
		var BASE_URL = "<?= BASE_URL ?>";
	</script>
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
			<button id="home"> Home </button>
			<button id="help"> Help </button>
			<button id="logout"> Logout </button>
		</div>
		<img src="<?= BASE_URL ?>/public/media/logo.png" alt="logo" width="150" height="150">
	</div>

	<hr />
