	<?php
		$uid = $_SESSION['id'];
		$sql = "SELECT * FROM subscriptions WHERE userid = '$uid'";
		$result = mysql_query($sql);
	?>

	<div id="title">
		<h3> Welcome Back, <?= $_SESSION['namefirst'] ?>! </h3>
		<h2> Home Page </h2>
	</div>

	<div id="navigation">
		<h3> Design Tools </h3>
		<form action="<?= BASE_URL ?>/navigate/process" method="POST">
			<input type="submit" name="courses" value="Your Courses"/>
			<input type="submit" name="lessons" value="Your Lessons"/>
			<input type="submit" name="newCourse" value="Create a Course"/>
			<input type="submit" name="newLesson" value="Create a Lesson"/>
			<input type="submit" name="accountInfo" value="Account Info"/>
		</form>
	</div>

	<div id="content">
		<h3> Courses You Are Taking </h3>

		<?php while($row = mysql_fetch_assoc($result)): ?>

			<?php
				$sub = new Subscription($row);
				$course = $sub->getCourse($sub->get('courseid'));
				$user = $sub->getUser($course->get('userid'));
			?>

			<div class="course">
				<button onclick="subscribe('<?= BASE_URL ?>/subscribe')"> Unsubscribe </button>
				<button href="<?= BASE_URL ?>/authors/view/<?= $user->get('username') ?>"> Author's Page </button>
				<a href="<?= BASE_URL ?>/courses/view/<?= $course->get('id') ?>"><?= $course->get('coursename'); ?>&nbsp;&nbsp;&nbsp;Author: <?= $user->get('username') ?></a>
				<p><?= $course->get('coursedescription'); ?></p>
			</div>

		<?php endwhile; ?>

	</div>

</body>

</html>
