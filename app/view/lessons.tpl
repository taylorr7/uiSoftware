	<?php
		$uid = $_SESSION['id'];
		$sql = "SELECT * FROM lessons WHERE userid = '$uid'";
		$result = mysql_query($sql);
	?>
	
	<div id="title">
		<h2> Course Page </h2>
	</div>
	
	<div id="navigation">
		<h3> Design Tools </h3>
		<button onclick="sendToPage('<?= BASE_URL ?>/courses')"> Your Courses </button>
		<button onclick="sendToPage('<?= BASE_URL ?>/lessons')"> Your Lessons </button>
		<button onclick="sendToPage('<?= BASE_URL ?>/courses/edit/')"> Create a Course </button>
		<button onclick="sendToPage('<?= BASE_URL ?>/lessons/edit/')"> Create a Lesson </button>
		<button onclick="sendToPage('<?= BASE_URL ?>/accountInfo')"> Account Info </button>
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