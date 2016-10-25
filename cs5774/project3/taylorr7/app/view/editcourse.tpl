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
		<button onclick="addChapter()"> Add a New Chapter </button>
		<button onclick="addLesson(<?= htmlspecialchars(json_encode($lessonList)) ?>)"> Add an Existing Lesson </button>
	</div>
	
	<div id="content">
		<h3 class="courseCreator"> 
			<form id="courseCreator" action="<?= BASE_URL ?>/courses/edit/process" method="POST">
				<label>Course Name: 
				<input type="text" name="cname" value="<?= $row['coursename'] ?>"></label> <br>
				<label>Course Description: <br>
				<textarea name="cdescription" class="courseDescription"><?= $row['coursedescription'] ?></textarea></label> <br>
				<label>Course Content: <br>
				<textarea name="ccontent" class="courseContent" id="courseContent"><?= $row['coursecontent'] ?></textarea></label> <br>
				<label><input name="opp" id="opp" hidden></label>
				<label><input name="id" value="<?= $row['id'] ?>" hidden></label>
				<label><input name="uid" value="<?= $_SESSION['id'] ?>" hidden></label>
				<input name="save" onclick="saveCourse('<?= $row['id'] ?>')" type="button" value="Save Lesson">
				<input name="delete" onclick="deleteCourse()" type="button" value="Delete Lesson">
			</form>
		</h3>
	</div>
	
</body>

</html>