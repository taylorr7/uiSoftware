<?php

?>

<div class="page-header">
	<h2>
		<?= $pageName ?>
		<a class="btn btn-primary pull-right" href="<?= BASE_URL ?>/lessons/new" role="button">
			<span class="glyphicon glyphicon-plus"></span>
			New Lesson
		</a>
	</h2>
</div>

<ul class="list-group">
	<?php foreach($lessons as $lesson): ?>

		<li class="list-group-item">
			<h4><?= $lesson->lessonname ?></h4>

			<div class="btn-group">
				<a class="btn btn-default" href="<?= BASE_URL ?>/lessons/edit/<?= $lesson->id ?>" role="button">
					<span class="glyphicon glyphicon-edit"></span>
					Edit
				</a>
				<a class="btn btn-default" href="<?= BASE_URL ?>/lessons/delete/<?= $lesson->id ?>" role="button">
					<span class="glyphicon glyphicon-trash"></span>
					Delete
				</a>
			</div>
		</li>

	<?php endforeach; ?>
</ul>
