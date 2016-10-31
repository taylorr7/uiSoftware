<div id="content">
	<div id="title">
		<h2> Account Information </h2>
	</div>

		<div id="accountInfo">
			<h3> Account Information </h3>
			<img id="profile" class="profile" src="<?= BASE_URL ?>/public/media/default.jpg">
				<form id="update" action="<?= BASE_URL ?>/account/process" onsubmit="return validateForm()" method="POST">
					<label>Username: <input type="text" value="<?= $user->username ?>" name="user"></label> <br>
					<label>Password <input type="password" name="pass"></label> <br>
					<label>Confirm Password <input type="password" name="passV"></label> <br>
					<label>First Name: <input type="text" value="<?= $user->namefirst ?>" name="fname"></label> <br>
					<label>Last Name: <input type="text" value="<?= $user->namelast ?>" name="lname"></label> <br>
					<label>Email: <input type="text" value="<?= $user->email ?>" name="email"></label> <br>
					<input type="submit" name="submit" value="Update Information">
				</form>
		</div>
	</div>

<script src="<?= BASE_URL ?>/public/scripts/gravatar.js" type="text/javascript"></script>
<script src="https://en.gravatar.com/<?= $hash ?>.json?callback=findProfile" type="text/javascript"></script>
