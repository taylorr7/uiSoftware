<div class="page-header clearfix">
	<img id="account-profile" class="profile pull-right" src="<?= $author->getProfileUrl() ?>">
	<h2><?= $author->username ?>'s Page</h2>
	<a class="btn btn-default subscribe" name="<?= $author->id ?>" role="button">
		<span class="glyphicon glyphicon-edit"></span>
		Subscribe
	</a>
</div>

<h3><?= $author->username ?>'s Courses</h3>
<ul class="list-group">
	<?php foreach(Course::loadByUser($author) as $course):
		$creator = $course->getCreator(); ?>

		<li class="list-group-item">
			<h4>
				<a href="<?= BASE_URL ?>/courses/view/<?= $course->id ?>"><?= $course->coursename ?></a>
			</h4>
			<p><?= $course->coursedescription ?></p>
		</li>

	<?php endforeach; ?>
</ul>

<h3><?= $author->username ?>'s Recent Activity</h3>
<ul class="list-group">
	<?php foreach($events as $e): ?>

		<li class="list-group-item">
			<h4><?= $e->getDescription() ?></h4>
			<small class="text-muted"><?= $e->getPrettyDate() ?></small>
		</li>

	<?php endforeach; ?>
</ul>

<script src="<?= BASE_URL ?>/public/scripts/subscribe.js" type="text/javascript"></script>