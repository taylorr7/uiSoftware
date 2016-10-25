	<div id="title">
		<h2> <?= $cname ?> </h2>
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
		<h3> This feature is not yet implemented. </h3>
	</div>
	
</body>

</html>