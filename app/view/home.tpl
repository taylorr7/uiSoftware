<div class="page-header">
	<h2> Welcome Back, <?= $user->username ?>! </h2>
</div>

<h3> Courses You Are Taking </h3>

<ul class="list-group">
	<?php foreach($subscriptions as $sub):
		$course = $sub->getCourse();
		$creator = $course->getCreator();
	?>

		<li class="list-group-item">
			<h4>
				<a href="<?= BASE_URL ?>/courses/view/<?= $course->id ?>"><?= $course->coursename ?></a>
				<small>
					by
					<a href="<?= BASE_URL ?>/authors/view/<?= $creator->username ?>">
						<?= $creator->username ?>
					</a>
				</small>
			</h4>
			<p><?= $course->coursedescription ?></p>
		</li>

	<?php endforeach; ?>
</ul>
