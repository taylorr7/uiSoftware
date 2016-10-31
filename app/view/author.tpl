<div id="title">
	<h2> <?= $author->username ?>'s Page </h2>
</div>

<div id="content">
	<img id="profile" src="<?= BASE_URL ?>/public/media/default.jpg">
	<h3> <?= $author->username ?>'s Courses </h3>
	<br>

	<?php foreach(Course::loadByUser($author) as $course): ?>

		<div class="course">
			<!-- <button id="unsubscribe"> Unsubscribe </button> -->
			<a href="<?= BASE_URL ?>/courses/view/<?= $course->id ?>"><?= $course->coursename ?></a>
			<p><?= $course->coursedescription ?></p>
		</div>

	<?php endforeach; ?>

</div>

<script src="<?= BASE_URL ?>/public/scripts/gravatar.js" type="text/javascript"></script>
<script src="https://en.gravatar.com/<?= $hash ?>.json?callback=findProfile" type="text/javascript"></script>
