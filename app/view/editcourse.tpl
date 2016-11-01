<div class="page-header">
	<h2>Design a Course</h2>
</div>

<div class="row">
	<div class="col-sm-8 col-xs-12">
		<form id="courseCreator" action="<?= BASE_URL ?>/courses/edit/process/<?= $course->id ?>" method="POST">
			<div class="form-group">
				<label for="cname">Course Name</label>
				<input type="text" name="cname" value="<?= $course->coursename ?>" class="form-control" placeholder="Course Name" required autofocus>
			</div>
			<div class="form-group">
				<label for="cdescription">Course Description</label>
				<textarea name="cdescription" rows="5" class="form-control" placeholder="Course Description" required><?= $course->coursedescription ?></textarea>
			</div>
			<div class="form-group">
				<label for="ccontent">Course Content</label>
				<textarea name="ccontent" rows="10" class="form-control" placeholder="Course Content" required><?= $course->coursecontent ?></textarea>
			</div>
		</form>

		<button form="courseCreator" type="submit" name="save" class="btn btn-primary">Save Lesson</button>
	</div>

	<aside class="col-sm-4 col-xs-12">
		<h5>Design Tools</h5>

		<button id="addLesson" class="btn btn-default" value="<?= htmlspecialchars(json_encode($lessonList)) ?>">
			Add an Existing Lesson
		</button>

	</aside>
</div>
