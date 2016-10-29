<!DOCTYPE html>
<html lang="en">

<head>
	<title> Thought Share | <?= $pageName ?> </title>

	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/main.css">

	<script src="<?= BASE_URL ?>/public/scripts/jquery.js"></script>
	<script src="<?= BASE_URL ?>/public/scripts/bootstrap.min.js"></script>
	<!-- <script src="<?= BASE_URL ?>/public/scripts/main.js"></script> -->
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

	<nav id="nav-top" class="navbar navbar-default">
		<div class="navbar-header pull-left">
			<a class="navbar-brand" href="<?= BASE_URL ?>">
				<span class="glyphicon glyphicon-home"></span>
			</a>
		</div>

		<div class="navbar-header pull-right">
			<ul class="nav navbar-nav">
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
						<span class="glyphicon glyphicon-user"></span>
						TODO: Name <span class="caret"></span>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li>
							<a href="<?= BASE_URL ?>/accountInfo">
								<span class="glyphicon glyphicon-cog"></span>
								Edit Profile
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>/courses">
								<span class="glyphicon glyphicon-book"></span>
								Your Courses
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>/lessons">
								<span class="glyphicon glyphicon-list-alt"></span>
								Your Lessons
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>/logout">
								<span class="glyphicon glyphicon-log-out"></span>
								Logout
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>

	<header style="background-image: url('<?= BASE_URL ?>/public/media/banner.jpg')">
		<img id="logo" src="<?= BASE_URL ?>/public/media/logo.png" alt="logo">
	</header>

	<nav id="nav-bottom" class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-bottom">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="navbar-collapse-bottom">
				<ul class="nav navbar-nav">
					<li><a href="#">View Courses</a></li>
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
							Create New &hellip; <span class="caret"></span>
						</a>

						<ul class="dropdown-menu">
							<li>
								<a href="<?= BASE_URL ?>/courses/new">
									<span class="glyphicon glyphicon-book"></span>
									Course
								</a>
							</li>
							<li>
								<a href="<?= BASE_URL ?>/lessons/new">
									<span class="glyphicon glyphicon-list-alt"></span>
									Lesson
								</a>
							</li>
						</ul>
					</li>
				</ul>

				<form class="navbar-form navbar-right" role="search" action="<?= BASE_URL ?>/search/" method="GET">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</nav>
