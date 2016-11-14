<div class="page-header">
	<h2> Welcome Back, <?= $user->namefirst ?>! </h2>
</div>

<h3>Activity Feed</h3>

<?php if (empty($events)): ?>
	<p class="text-muted">
		No activity yet!  Subscribe to users to keep up to date with their
		courses and lessons.
	</p>
<?php else: ?>
	<ul class="list-group">
		<?php foreach($events as $e): ?>

			<li class="list-group-item">
				<h4><?= $e->getDescription() ?></h4>
				<small class="text-muted"><?= $e->getPrettyDate() ?></small>
			</li>

		<?php endforeach; ?>
	</ul>
<?php endif; ?>
