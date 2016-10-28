	<div id="title">
		<h2> Design a Course </h2>
	</div>

	<?php
		$uid = $_SESSION['id'];
		$sql = "SELECT lessonname FROM lessons WHERE userid = '$uid'";
		$result = mysql_query($sql);
		$lessonList = array();
		$i = 0;
		while($lessons = mysql_fetch_array($result)) {
			$lessonList[$i] = $lessons[0];
			$i++;
		}
	?>

	<div id="navigation">
		<h3> Design Tools </h3>
		<button id="addChapter"> Add a New Chapter </button>
		<button onclick="addLesson(<?= htmlspecialchars(json_encode($lessonList)) ?>)"> Add an Existing Lesson </button>
	</div>

	<div id="content">
		<h3 class="courseCreator">
			<form id="courseCreator" action="<?= BASE_URL ?>/courses/edit/process/<?= $row['id'] ?>" method="POST">
				<label>Course Name: <br>
				<input type="text" name="cname" value="<?= $row['coursename'] ?>"></label> <br><br>
				<label>Course Description: <br>
				<textarea name="cdescription" class="courseDescription"><?= $row['coursedescription'] ?></textarea></label> <br><br>
				<label>Course Content: <br>
				<textarea name="ccontent" class="courseContent" id="courseContent"><?= $row['coursecontent'] ?></textarea></label> <br>
				<label><input name="opp" id="opp" hidden></label>
				<input type="submit" name="save" value="Save Lesson">
				<input type="submit" name="delete" value="Delete Lesson">
			</form>
		</h3>
	</div>

</body>

</html>
