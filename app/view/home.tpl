<?php
	$uid = $_SESSION['id'];
	$sql = "SELECT * FROM subscriptions WHERE userid = '$uid'";
	$result = mysql_query($sql);
?>

<div class="page-header">
	<h2> Welcome Back, <?= $_SESSION['namefirst'] ?>! </h2>
</div>


<h3> Courses You Are Taking </h3>

<ul class="list-group">
	<?php while($row = mysql_fetch_assoc($result)): ?>

		<?php
			$sub = new Subscription($row);
			$course = $sub->getCourse($sub->get('courseid'));
			$user = $sub->getUser($course->get('userid'));
		?>

		<li class="list-group-item">
			<h4>
				<a href="<?= BASE_URL ?>/courses/view/<?= $course->get('id') ?>">
					<?= $course->get('coursename'); ?>
				</a>
				<small>
					by
					<a href="<?= BASE_URL ?>/authors/view/<?= $user->get('username') ?>">
						<?= $user->get('username') ?>
					</a>
				</small>
			</h4>
			<p><?= $course->get('coursedescription'); ?></p>
		</li>

	<?php endwhile; ?>
</ul>
