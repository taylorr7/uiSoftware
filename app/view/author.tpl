<div class="page-header clearfix">
	<img id="account-profile" class="profile pull-right" src="<?= $author->getProfileUrl() ?>">
	<h2><?= $author->username ?>'s Page</h2>
	<?php if($author->id != LoginSession::currentUser()->id): ?>
		<a class="btn btn-default subscribe" name="<?= $author->id ?>" role="button">
				<span class="glyphicon glyphicon-edit"></span>
				Subscribe
		</a>
		<a class="btn btn-default animate" data-aname="<?= $author->id ?>" role="button">
				<span class="glyphicon glyphicon-film"></span>
				View Animation
		</a>
	<?php endif; ?>
</div>

<div class="row">
	<div class="col-sm-8 col-xs-12">
		<h3><?= $author->username ?>'s Courses</h3>
		<ul class="list-group">
			<?php foreach(Course::loadByUser($author, true) as $course):
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
	</div>

	<div class="col-sm-4 col-xs-12">
		<h4>People Subscribed to <?= $author->username ?></h4>
		<?php if(empty($usersSubscribedToAuthor)): ?>
			<div class="text-muted">Looks like no one yet</div>
		<?php else: ?>
			<ol>
				<?php foreach($usersSubscribedToAuthor as $u): ?>
					<li>
						<img src="<?= $u->getProfileUrl() ?>" class="small-profile"/>
						<?= $u->asLink() ?>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php endif; ?>

		<hr/>

		<h4>People <?= $author->username ?> has Subscribed To</h4>
		<?php if(empty($usersAuthorIsSubscribedTo)): ?>
			<div class="text-muted">Looks like no one yet</div>
		<?php else: ?>
			<ol>
				<?php foreach($usersAuthorIsSubscribedTo as $u): ?>
					<li>
						<img src="<?= $u->getProfileUrl() ?>" class="small-profile"/>
						<?= $u->asLink() ?>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php endif; ?>
	</div>
</div>

<script src="<?= BASE_URL ?>/public/scripts/subscribe.js" type="text/javascript"></script>
