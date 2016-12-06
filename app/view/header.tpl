<!DOCTYPE html>
<html lang="en">

<head>
	<title> Thought Share | <?= $pageName ?> </title>

	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/main.css">

	<script type="text/javascript">
		const BASE_URL = "<?= BASE_URL ?>";
	</script>
	<script src="<?= BASE_URL ?>/public/scripts/jquery.js"></script>
	<script src="<?= BASE_URL ?>/public/scripts/main.js"></script>
	<script src="<?= BASE_URL ?>/public/scripts/bootstrap.min.js"></script>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

	<nav id="nav-top" class="navbar navbar-default">
		<div class="navbar-header pull-left">
			<a class="navbar-brand" href="<?= BASE_URL ?>">
				<span class="glyphicon glyphicon-home"></span>
			</a>
			<?php if(LoginSession::currentUser()->role == "admin"): ?>
				<a class="navbar-brand" href="<?= BASE_URL ?>/manage">
					<span class="glyphicon glyphicon-user"></span>
				</a>
			<?php endif; ?>
		</div>

		<div class="navbar-header pull-right">
			<ul class="nav navbar-nav">
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
						<img id="profile" class="profile" src="<?= $user->getProfileUrl() ?>">
						<?= $user->username ?>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li>
							<a href="<?= BASE_URL ?>/authors/view/<?= $user->username ?>">
								<span class="glyphicon glyphicon-user"></span>
								Profile
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>/account">
								<span class="glyphicon glyphicon-cog"></span>
								Edit Account
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>/courses/personal">
								<span class="glyphicon glyphicon-book"></span>
								Personal Courses
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>/lessons/personal">
								<span class="glyphicon glyphicon-list-alt"></span>
								Personal Lessons
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

	<header class="banner" style="background-image: url('<?= BASE_URL ?>/public/media/banner.jpg')">
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
					<li><a href="<?= BASE_URL ?>/courses">View Courses</a></li>
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
						<input type="text" name="s" class="form-control" placeholder="Search...">
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

	<main class="container">
