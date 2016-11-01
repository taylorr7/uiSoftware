<div class="page-header">
	<h2>Design a Lesson</h2>
</div>

<div class="row">
	<div class="col-sm-8 col-xs-12">
		<form id="lessonCreator" action="<?= BASE_URL ?>/lessons/edit/process/<?= $lesson->id ?>" method="POST">
			<div class="form-group">
				<label for="lname">Lesson Name</label>
				<input type="text" name="lname" value="<?= $lesson->lessonname ?>" class="form-control" placeholder="Lesson Name" required autofocus>
			</div>
			<div class="form-group">
				<label for="content">Lesson Content</label>
				<textarea name="content" class="form-control" rows="10" id="lessonContent" required><?= $lesson->content ?></textarea>
			</div>

			<button type="submit" name="save" class="btn btn-primary">Save Lesson</button>
		</form>
	</div>

	<aside id="navigation" class="col-sm-4 col-xs-12">
		<h5>Design Tools</h5>
		<button class="btn btn-default" id="uploadQuiz"> Add a Quiz </button>
		<button class="btn btn-default" id="uploadLink"> Add a Link </button>
		<button class="btn btn-default" id="uploadImage"> Add an Image </button>
	</aside>
</div>
