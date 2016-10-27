	<?php
		$uid = $_SESSION['id'];
		$sql = "SELECT * FROM lessons WHERE userid = '$uid'";
		$result = mysql_query($sql);
	?>

	<div id="title">
		<h2> Course Page </h2>
	</div>

	<div id="content">
		<h3> Your Lessons </h3>

		<?php while($row = mysql_fetch_assoc($result)): ?>

			<div class="course">
				<button onclick="sendToPage('<?= BASE_URL ?>/lessons/edit/<?= $row['id'] ?>')"> Edit </button>
				<a href="<?= BASE_URL ?>/lessons/edit/<?= $row['id']; ?>"><?= $row['lessonname']; ?></a>
			</div>

		<?php endwhile; ?>

	</div>

</body>

</html>
