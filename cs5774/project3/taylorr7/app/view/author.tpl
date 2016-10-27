	<div id="title">
		<h2> <?= $user ?>'s Page </h2>
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
		<img id="profile" src="<?= BASE_URL ?>/public/media/default.jpg">
		<h3> <?= $user ?>'s Courses </h3>
		<br>
		
		<?php while($row = mysql_fetch_assoc($result)): ?>
			
			<div class="course">
				<button onclick="subscribe('<?= BASE_URL ?>/subscribe')"> Unsubscribe </button>
				<a href="<?= BASE_URL ?>/courses/view/<?= $row['id']; ?>"><?= $row['coursename']; ?></a>
				<p><?= $row['coursedescription']; ?></p>
			</div>
		
		<?php endwhile; ?>
		
	</div>

<script src="<?= BASE_URL ?>/public/scripts/gravatar.js" type="text/javascript"></script>
<script src="https://en.gravatar.com/<?= $hash ?>.json?callback=findProfile" type="text/javascript"></script>
	
</body>

</html>