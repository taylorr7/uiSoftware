<!DOCTYPE html>
<html lang="en">

<head>
	<title>
		Thought Share | <?= $pageName ?>
	</title>

	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/main.css">

	<script src="<?= BASE_URL ?>/public/scripts/jquery.js"></script>
	<script src="<?= BASE_URL ?>/public/scripts/bootstrap.min.js"></script>
	<script src="<?= BASE_URL ?>/public/scripts/login.js"></script>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="container banner" style="background-image: url('<?= BASE_URL ?>/public/media/banner.jpg')">

	<header class="text-center">
		<img id="logo" src="<?= BASE_URL ?>/public/media/logo.png" alt="logo">
	</header>

	<main class="row">
		<div class="well col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#login">Login</a></li>
				<li><a data-toggle="tab" href="#register">Register</a></li>
			</ul>

			<div class="tab-content">
				<div id="login" class="tab-pane fade in active">
					<h3>Login</h3>
					<form id="login" action="<?= BASE_URL ?>/login/process" method="POST">
						<div class="form-group">
							<label for="user">Username</label>
							<input type="text" name="user" class="form-control" id="user" placeholder="Username" required autofocus>
						</div>
						<div class="form-group">
							<label for="pass">Password</label>
							<input type="password" name="pass" class="form-control" id="pass" placeholder="Password" required>
						</div>
						<button type="submit" class="btn btn-default btn-primary">Login</button>
					</form>
				</div>


				<div id="register" class="tab-pane fade">
					<h3>Register</h3>

					<form id="account" action="<?= BASE_URL ?>/register/process" method="POST" onsubmit="return validateForm()">
						<div class="form-group">
							<label for="user">Username</label>
							<input type="text" name="user" class="form-control" id="user" placeholder="Username" required>
						</div>
						<div class="form-group">
							<label for="pass">Password</label>
							<input type="password" name="pass" class="form-control" id="pass" placeholder="Password" required>
						</div>
						<div class="form-group">
							<label for="vpass">Re-Enter Password</label>
							<input type="password" name="vpass" class="form-control" id="vpass" placeholder="Password" required>
						</div>
						<div class="form-group">
							<label for="fname">First Name</label>
							<input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
						</div>
						<div class="form-group">
							<label for="lname">Last Name</label>
							<input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
						</div>
						<button type="submit" class="btn btn-default btn-primary">Register</button>
					</form>
				</div>
			</div>
		</div>
	</main>

</body>

</html>
