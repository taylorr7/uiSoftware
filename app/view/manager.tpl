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
				<?= $nextUser->username ?> <br>
				<?= $nextUser->role ?>
			</h4>
			<p>
				First Name: <input name="<?= $nextUser->id ?>fName" type="text" value="<?= $nextUser->namefirst ?>">
				Last Name: <input name="<?= $nextUser->id ?>lName" type="text" value="<?= $nextUser->namelast ?>">
				Email: <input name="<?= $nextUser->id ?>email" type="text" value="<?= $nextUser->email ?>"> <br>
			</p>
			<a class="btn btn-default manage" name="Update <?= $nextUser->id ?>" role="button">
				<span class="glyphicon glyphicon-edit"></span>
				Update Information
			</a>
			<?php if($nextUser->role != "admin"): ?>
				<a class="btn btn-default manage" name="Promote <?= $nextUser->id ?>" role="button">
					<span class="glyphicon glyphicon-edit"></span>
					Promote to Admin
				</a>
			<?php endif; ?>
			<?php if($nextUser->role == "admin"): ?>
				<a class="btn btn-default manage" name="Demote <?= $nextUser->id ?>" role="button">
						<span class="glyphicon glyphicon-edit"></span>
						Demote to User
				</a>
			<?php endif; ?>
			<a class="btn btn-default manage" name="Reset <?= $nextUser->id ?>" role="button">
				<span class="glyphicon glyphicon-edit"></span>
				Reset Password
			</a>
			<a class="btn btn-default manage" name="Delete <?= $nextUser->id ?>" role="button">
				<span class="glyphicon glyphicon-edit"></span>
				Delete User
			</a>
		</li>
	<?php endforeach; ?>
</ul>

<script src="<?= BASE_URL ?>/public/scripts/manage.js" type="text/javascript"></script>