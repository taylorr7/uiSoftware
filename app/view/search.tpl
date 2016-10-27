	<div id="title">
		<h2> Search Results </h2>
	</div>
	
	<div id="content">
		<?php
			$sql = "SELECT * FROM users WHERE username = '$qry'";
			$result = mysql_query($sql);
		?>

		<?php while($row = mysql_fetch_assoc($result)): ?>

			<div class="course">
				<a href="<?= BASE_URL ?>/authors/view/<?= $row['username'] ?>">User:&nbsp;&nbsp;&nbsp;<?= $row['username']; ?></a>
			</div>

		<?php endwhile; ?>

		<?php
			$sql = "SELECT * FROM courses WHERE INSTR(coursename, '{$qry}') > 0 OR INSTR(coursedescription, '{$qry}') > 0";
			$result = mysql_query($sql);
		?>

		<?php while($row = mysql_fetch_assoc($result)): ?>

			<div class="course">
				<a href="<?= BASE_URL ?>/courses/view/<?= $row['id']; ?>">Course:&nbsp;&nbsp;&nbsp;<?= $row['coursename']; ?></a>
				<p><?= $row['coursedescription']; ?></p>
			</div>

		<?php endwhile; ?>
	</div>

</body>

</html>
