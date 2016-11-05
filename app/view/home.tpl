<div class="page-header">
	<h2> Welcome Back, <?= $user->namefirst ?>! </h2>
</div>

<h3>Activity Feed</h3>

<ul class="list-group">
	<?php foreach($events as $e): ?>

		<li class="list-group-item">
			<h4><?= $e->getDescription() ?></h4>
			<small class="text-muted"><?= $e->getPrettyDate() ?></small>
		</li>

	<?php endforeach; ?>
</ul>
