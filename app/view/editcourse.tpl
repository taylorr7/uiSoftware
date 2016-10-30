<div class="page-header">
	<h2>Design a Course</h2>
</div>

<?php
	$uid = $_SESSION['id'];
	$sql = "SELECT lessonname FROM lessons WHERE userid = '$uid'";
	$result = mysql_query($sql);
	$lessonList = array();
	$i = 0;
	while ($lessons = mysql_fetch_array($result)) {
		$lessonList[$i] = $lessons[0];
		$i++;
	}
?>

<div class="row">
	<div class="col-sm-8 col-xs-12">
		<form id="courseCreator" action="<?= BASE_URL ?>/courses/edit/process/<?= $row['id'] ?>" method="POST">
			<div class="form-group">
				<label for="cname">Course Name</label>
				<input type="text" name="cname" value="<?= $row['coursename'] ?>" class="form-control" placeholder="Course Name" required autofocus>
			</div>
			<div class="form-group">
				<label for="cdescription">Course Description</label>
				<textarea name="cdescription" value="<?= $row['coursedescription'] ?>" class="form-control" placeholder="Course Description" required></textarea>
			</div>
			<div class="form-group">
				<label for="ccontent">Course Content</label>
				<textarea name="ccontent" value="<?= $row['coursecontent'] ?>" class="form-control" placeholder="Course Content" required></textarea>
			</div>
		</form>

		<button form="courseCreator" type="submit" name="save" class="btn btn-primary">Save Lesson</button>
	</div>

	<aside class="col-sm-4 col-xs-12">
		<h5>Design Tools</h5>

		<button id="addLesson" class="btn btn-default" value="(<?= htmlspecialchars(json_encode($lessonList)) ?>)">
			Add an Existing Lesson
		</button>

	</aside>
</div>
