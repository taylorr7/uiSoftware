<div id="title">
	<h2> Search Results </h2>
</div>

<div id="content">
	<?php foreach($users as $u): ?>

		<div class="course">
			<a href="<?= BASE_URL ?>/authors/view/<?= $u->username ?>">User:&nbsp;&nbsp;&nbsp;<?= $u->username ?></a>
		</div>

	<?php
		endforeach;
		foreach($courses as $c):
	?>

		<div class="course">
			<a href="<?= BASE_URL ?>/courses/view/<?= $c->id ?>">Course:&nbsp;&nbsp;&nbsp;<?= $c->coursename ?></a>
			<p><?= $c->coursedescription ?></p>
		</div>

	<?php endforeach; ?>
</div>
