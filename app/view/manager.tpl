<div class="page-header">
	<h2>
		<?= $pageName ?>
	</h2>
</div>

<ul class="list-group">
	<?php foreach($users as $nextUser):
		$isPersonal = false;
	?>
		<li class="list-group-item">
			<h4>
				<?= $nextUser->username ?>
				<span class="badge"><?= $nextUser->role ?></span>
			</h4>
			<br/>
			<div class="form-inline">
				<div class="form-group">
					<label for="<?= $nextUser->id ?>fName">First Name</label>
					<input name="<?= $nextUser->id ?>fName" type="text" value="<?= $nextUser->namefirst ?>">
				</div>
				<div class="form-group">
					<label for="<?= $nextUser->id ?>lName">Last Name</label>
					<input name="<?= $nextUser->id ?>lName" type="text" value="<?= $nextUser->namelast ?>">
				</div>
				<div class="form-group">
					<label for="<?= $nextUser->id ?>email">Email</label>
					<input name="<?= $nextUser->id ?>email" type="email" value="<?= $nextUser->email ?>">
				</div>
			</div>
			<br/>
			<div class="btn-group">
				<a class="btn btn-default manage" name="Update <?= $nextUser->id ?>" role="button">
					<span class="glyphicon glyphicon-pencil"></span>
					Update Information
				</a>
				<?php if($nextUser->role != "admin"): ?>
					<a class="btn btn-default manage" name="Promote <?= $nextUser->id ?>" role="button">
						<span class="glyphicon glyphicon-arrow-up"></span>
						Promote to Admin
					</a>
				<?php endif; ?>
				<?php if($nextUser->role == "admin"): ?>
					<a class="btn btn-default manage" name="Demote <?= $nextUser->id ?>" role="button">
							<span class="glyphicon glyphicon-arrow-down"></span>
							Demote to User
					</a>
				<?php endif; ?>
				<a class="btn btn-default manage" name="Reset <?= $nextUser->id ?>" role="button">
					<span class="glyphicon glyphicon-refresh"></span>
					Reset Password
				</a>
				<a class="btn btn-default manage" name="Delete <?= $nextUser->id ?>" role="button">
					<span class="glyphicon glyphicon-trash"></span>
					Delete User
				</a>
			</div>
		</li>
	<?php endforeach; ?>
</ul>

<script src="<?= BASE_URL ?>/public/scripts/manage.js" type="text/javascript"></script>
