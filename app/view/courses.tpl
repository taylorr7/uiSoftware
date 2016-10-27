	<?php
		$uid = $_SESSION['id'];
		$sql = "SELECT * FROM courses WHERE userid = '$uid'";
		$result = mysql_query($sql);
	?>

	<div id="title">
		<h2> Course Page </h2>
	</div>

	<div id="content">
		<h3> Your Courses </h3>

		<?php while($row = mysql_fetch_assoc($result)): ?>

			<div class="course">
				<button onclick="sendToPage('<?= BASE_URL ?>/courses/edit/<?= $row['id'] ?>')"> Edit </button>
				<a href="<?= BASE_URL ?>/courses/view/<?= $row['id']; ?>"><?= $row['coursename']; ?></a>
				<p><?= $row['coursedescription']; ?></p>
			</div>

		<?php endwhile; ?>

	</div>

</body>

</html>
