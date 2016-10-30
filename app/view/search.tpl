<div id="title">
	<h2> Search Results </h2>
</div>

<div id="content">
	<?php while($row = mysql_fetch_assoc($result1)): ?>

		<div class="course">
			<a href="<?= BASE_URL ?>/authors/view/<?= $row['username'] ?>">User:&nbsp;&nbsp;&nbsp;<?= $row['username']; ?></a>
		</div>

	<?php
		endwhile;
		while($row = mysql_fetch_assoc($result2)):
	?>

		<div class="course">
			<a href="<?= BASE_URL ?>/courses/view/<?= $row['id']; ?>">Course:&nbsp;&nbsp;&nbsp;<?= $row['coursename']; ?></a>
			<p><?= $row['coursedescription']; ?></p>
		</div>

	<?php endwhile; ?>
</div>
