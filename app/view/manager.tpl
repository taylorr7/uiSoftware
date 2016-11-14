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
			</h4>
			<p>
				First Name: <?= $nextUser->namefirst ?>
				Last Name: <?= $nextUser->namelast ?>
				Email: <?= $nextUser->email ?>
				Role: <?= $nextUser->role ?> <br>
			</p>
			<?php if($nextUser->role != "admin"): ?>
				<a class="btn btn-default manage" name="Update <?= $nextUser->id ?>" role="button">
						<span class="glyphicon glyphicon-edit"></span>
						Update Information
				</a>
				<a class="btn btn-default manage" name="Promote <?= $nextUser->id ?>" role="button">
						<span class="glyphicon glyphicon-edit"></span>
						Promote to Admin
				</a>
				<a class="btn btn-default manage" name="Reset <?= $nextUser->id ?>" role="button">
						<span class="glyphicon glyphicon-edit"></span>
						Reset Password
				</a>
				<a class="btn btn-default manage" name="Delete <?= $nextUser->id ?>" role="button">
						<span class="glyphicon glyphicon-edit"></span>
						Delete User
				</a>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>

<script src="<?= BASE_URL ?>/public/scripts/manage.js" type="text/javascript"></script>