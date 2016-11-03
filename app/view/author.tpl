<div class="page-header clearfix">
	<img id="account-profile" class="profile pull-right" src="<?= $author->getProfileUrl() ?>">
	<h2><?= $author->username ?>'s Page</h2>
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
