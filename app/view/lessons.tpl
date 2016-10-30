<?php

?>

<div class="page-header">
	<h2>
		Your Lessons
		<a class="btn btn-primary pull-right" href="<?= BASE_URL ?>/lessons/new" role="button">
			<span class="glyphicon glyphicon-plus"></span>
			New Lesson
		</a>
	</h2>
</div>

<ul class="list-group">
	<?php while($row = mysql_fetch_assoc($result)): ?>

		<li class="list-group-item">
			<h4>
				<a href="<?= BASE_URL ?>/courses/view/<?= $row['id']; ?>">
					<?= $row['lessonname']; ?>
				</a>
			</h4>

			<div class="btn-group">
				<a class="btn btn-default" href="<?= BASE_URL ?>/lessons/view/<?= $row['id']; ?>" role="button">
					<span class="glyphicon glyphicon-eye-open"></span>
					View
				</a>
				<a class="btn btn-default" href="<?= BASE_URL ?>/lessons/edit/<?= $row['id']; ?>" role="button">
					<span class="glyphicon glyphicon-edit"></span>
					Edit
				</a>
			</div>
		</li>

	<?php endwhile; ?>
</ul>
