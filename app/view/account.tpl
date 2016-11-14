<script src="<?= BASE_URL ?>/public/scripts/login.js"></script>

<div class="page-header">
	<h2><?= $pageName ?></h2>
</div>

<div class="row">
	<div class="col-sm-4 col-sm-push-8 col-xs-12 text-center">
		<img id="account-profile" class="profile" src="<?= $user->getProfileUrl() ?>">
		<p>
			<a href="https://en.gravatar.com/connect/" class="btn btn-default" role="button">Change Profile</a>
		</p>
	</div>


	<div class="col-sm-8 col-sm-pull-4 col-xs-12">
		<form id="account" action="<?= BASE_URL ?>/account/process" method="POST" onsubmit="return validateForm()">
			<div class="form-group">
				<label for="user">Username</label><br>
				<input type="hidden" name="user" value="<?= $user->username ?>">
				</html> <?= $user->username ?> <html>
			</div>
			<div class="form-group">
				<label for="pass">Password</label>
				<input type="password" name="pass" value="<?= $user->password ?>" class="form-control" placeholder="Password" required>
			</div>
			<div class="form-group">
				<label for="passV">Re-Enter Password</label>
				<input type="password" name="vpass" value="<?= $user->password ?>" class="form-control" placeholder="Password" required>
			</div>
			<div class="form-group">
				<label for="fname">First Name</label>
				<input type="text" name="fname" value="<?= $user->namefirst ?>" class="form-control" placeholder="First Name" required>
			</div>
			<div class="form-group">
				<label for="lname">Last Name</label>
				<input type="text" name="lname" value="<?= $user->namelast ?>" class="form-control" placeholder="Last Name" required>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" name="email" value="<?= $user->email ?>" class="form-control" placeholder="Email" required>
			</div>
			<div class="form-group">
				<label for="education_type">Education Type</label><br>
				<input type="radio" name="education_type" value="no" <?= User::isChecked($user, "no") ?>> None<br>
				<input type="radio" name="education_type" value="hs" <?= User::isChecked($user, "hs") ?>> High School Graduate<br>
				<input type="radio" name="education_type" value="ad" <?= User::isChecked($user, "ad") ?>> Associate Degree<br>
				<input type="radio" name="education_type" value="bd" <?= User::isChecked($user, "bd") ?>> Bachelor's Degree<br>
				<input type="radio" name="education_type" value="md" <?= User::isChecked($user, "md") ?>> Master's Degree<br>
				<input type="radio" name="education_type" value="dd" <?= User::isChecked($user, "dd") ?>> Doctorate Degree<br>
			</div>
				<button type="submit" name="submit" class="btn btn-primary">Update Information</button>
		</form>
		<br>
		<a class="btn btn-default delete-account" data-aid="<?= $user->id ?>" role="button">
			<span class="glyphicon glyphicon-trash"></span>
			Delete Account
		</a>
	</div>
</div>
