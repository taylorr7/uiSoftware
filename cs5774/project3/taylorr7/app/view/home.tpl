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
		<button onclick="sendToPage('<?= BASE_URL ?>/courses')"> Your Courses </button>
		<button onclick="sendToPage('<?= BASE_URL ?>/lessons')"> Your Lessons </button>
		<button onclick="sendToPage('<?= BASE_URL ?>/courses/edit/')"> Create a Course </button>
		<button onclick="sendToPage('<?= BASE_URL ?>/lessons/edit/')"> Create a Lesson </button>
		<button onclick="sendToPage('<?= BASE_URL ?>/accountInfo')"> Account Info </button>
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
				<button onclick="sendToPage('<?= BASE_URL ?>/authors/view/<?= $user->get('username') ?>')"> Author's Page </button>
				<a href="<?= BASE_URL ?>/courses/view/<?= $course->get('id') ?>"><?= $course->get('coursename'); ?>&nbsp;&nbsp;&nbsp;Author: <?= $user->get('username') ?></a>
				<p><?= $course->get('coursedescription'); ?></p>
			</div>
		
		<?php endwhile; ?>
		
	</div>
	
</body>

</html>