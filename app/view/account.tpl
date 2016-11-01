<div class="page-header">
	<h2><?= $pageName ?></h2>
</div>

<div class="row">
	<div class="col-sm-4 col-sm-push-8 col-xs-12 text-center">
		<img id="account-profile" class="profile" src="<?= BASE_URL ?>/public/media/default.jpg">
		<p>
			<a href="https://en.gravatar.com/connect/" class="btn btn-default" role="button">Change Profile</a>
		</p>
	</div>


	<div class="col-sm-8 col-sm-pull-4 col-xs-12">
		<form id="update" action="<?= BASE_URL ?>/account/process" onsubmit="return validateForm()" method="POST">
			<div class="form-group">
				<label for="user">Username</label>
				<input type="text" name="user" value="<?= $user->username ?>" class="form-control" placeholder="Username" required autofocus>
			</div>
			<div class="form-group">
				<label for="pass">Password</label>
				<input type="password" name="pass" value="<?= $user->password ?>" class="form-control" placeholder="Password" required>
			</div>
			<div class="form-group">
				<label for="passV">Confirm Password</label>
				<input type="password" name="passV" value="<?= $user->password ?>" class="form-control" placeholder="Password" required>
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
			<button type="submit" name="submit" class="btn btn-primary">Update Information</button>
		</form>
	</div>
</div>
