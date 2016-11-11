<div class="page-header">
	<h2>
		<?= $pageName ?>
		<a class="btn btn-primary pull-right" href="<?= BASE_URL ?>/courses/new" role="button">
			<span class="glyphicon glyphicon-plus"></span>
			New Course
		</a>
	</h2>
</div>

<ul class="list-group">
	<?php foreach($courses as $course):
		$creator = $course->getCreator();
		$isPersonal = $creator->id == $user->id;
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
			<p><?= $course->coursedescription; ?></p>

			<?php if($isPersonal): ?>
				<div class="btn-group">
					<a class="btn btn-default" href="<?= BASE_URL ?>/courses/edit/<?= $course->id ?>" role="button">
						<span class="glyphicon glyphicon-edit"></span>
						Edit
					</a>
					<a class="btn btn-default publish" name="<?= $course->id ?>" role="button">
						Unpublish
					</a>
					<a class="btn btn-default" href="<?= BASE_URL ?>/courses/delete/<?= $course->id ?>" role="button">
						<span class="glyphicon glyphicon-trash"></span>
						Delete
					</a>
				</div>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>

<script src="<?= BASE_URL ?>/public/scripts/publish.js" type="text/javascript"></script>
