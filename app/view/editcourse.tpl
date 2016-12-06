<div class="page-header">
	<h2>Design a Course</h2>
</div>

<div id="add-lesson-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a Lesson</h4>
            </div>
            <div class="modal-body">
                <div class="form-group" id="select-lesson">
                </div>
            </div>
            <div class="modal-footer">
                <button id="submit-lesson" type="button" class="btn btn-primary"  data-dismiss="modal">
                    <span class="glyphicon glyphicon-ok"></span>
                    Add Lesson
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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

			<button type="submit" name="save" class="btn btn-primary">Save Course</button>
		</form>
	</div>

	<aside class="col-sm-4 col-xs-12">
		<h5>Design Tools</h5>

		<button id="addLesson" class="btn btn-default" data-toggle="modal" data-target="#add-lesson-modal" value="<?= htmlspecialchars(json_encode($lessonList)) ?>">
			Add an Existing Lesson
		</button>

	</aside>
</div>
