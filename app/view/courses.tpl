<?php
	$uid = $_SESSION['id'];
	$sql = "SELECT * FROM courses WHERE userid = '$uid'";
	$result = mysql_query($sql);
?>

<div class="page-header">
	<h2>Your Courses</h2>
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
			</div>
		</li>

	<?php endwhile; ?>
</ul>
