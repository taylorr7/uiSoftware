	<?php
		$uid = $_SESSION['id'];
		$sql = "SELECT * FROM users WHERE id = '$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$email = $row['email'];
		$hash = md5(strtolower(trim($email)));
	?>

	<div id="title">
		<h2> Account Information </h2>
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

		<div id="accountInfo">
			<h3> Account Information </h3>
			<img id="profile" class="profile" src="<?= BASE_URL ?>/public/media/default.jpg">
				<form id="update" action="<?= BASE_URL ?>/accountInfo/process" onsubmit="return validateForm()" method="POST">
					<label>Username: <input type="text" value="<?= $row['username'] ?>" name="user"></label> <br>
					<label>Password <input type="password" name="pass"></label> <br>
					<label>Confirm Password <input type="password" name="passV"></label> <br>
					<label>First Name: <input type="text" value="<?= $row['namefirst'] ?>" name="fname"></label> <br>
					<label>Last Name: <input type="text" value="<?= $row['namelast'] ?>" name="lname"></label> <br>
					<label>Email: <input type="text" value="<?= $row['email'] ?>" name="email"></label> <br>
					<label><input value="<?= $row['id'] ?>" name="id" hidden></label>
					<input type="submit" name="submit" value="Update Information">
				</form>
		</div>

	</div>


<script src="<?= BASE_URL ?>/public/scripts/gravatar.js" type="text/javascript"></script>
<script src="https://en.gravatar.com/<?= $hash ?>.json?callback=findProfile" type="text/javascript"></script>

</body>

</html>
