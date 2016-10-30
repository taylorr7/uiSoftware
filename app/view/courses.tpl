<?php
	$uid = $_SESSION['id'];
	$sql = "SELECT * FROM courses WHERE userid = '$uid'";
	$result = mysql_query($sql);
?>

<div class="page-header">
	<h2>
		Your Courses
		<a class="btn btn-primary pull-right" href="<?= BASE_URL ?>/courses/new" role="button">
			<span class="glyphicon glyphicon-plus"></span>
			New Course
		</a>
	</h2>
</div>

<ul class="list-group">
	<?php while($row = mysql_fetch_assoc($result)): ?>

		<li class="list-group-item">
			<h4>
				<a href="<?= BASE_URL ?>/courses/view/<?= $row['id']; ?>">
					<?= $row['coursename']; ?>
				</a>
			</h4>
			<p><?= $row['coursedescription']; ?></p>

			<div class="btn-group">
				<a class="btn btn-default" href="<?= BASE_URL ?>/courses/view/<?= $row['id']; ?>" role="button">
					<span class="glyphicon glyphicon-eye-open"></span>
					View
				</a>
				<a class="btn btn-default" href="<?= BASE_URL ?>/courses/edit/<?= $row['id']; ?>" role="button">
					<span class="glyphicon glyphicon-edit"></span>
					Edit
				</a>
				<a class="btn btn-default publish" name="<?= $row['id'] ?>" role="button">
					<span class="glyphicon glyphicon-edit"></span>
					Unpublish
				</a>
			</div>
		</li>

	<?php endwhile; ?>
</ul>

<script src="<?= BASE_URL ?>/public/scripts/publish.js" type="text/javascript"></script>