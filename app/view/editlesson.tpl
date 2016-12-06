<div class="page-header">
	<h2>Design a Lesson</h2>
</div>

<div id="add-quiz-modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add a Quiz</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<form id="quiz-answers">
						Enter the quiz question: <input class="form-control" type="text" id="quiz-name" name="quiz-name" required>
						<input type="radio" name="answers" value="answer-1" checked="checked"> Enter a possible answer:
						<input class="form-control" type="text" id="quiz-answer-1" name="quiz-answer-1" required>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button id="add-quiz-question" type="button" class="btn btn-primary">
					<span class="glyphicon glyphicon-plus"></span>
					Add Possible Answer
				</button>
				<button id="submit-quiz" type="button" class="btn btn-primary">
					<span class="glyphicon glyphicon-ok"></span>
					Add Quiz
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="add-link-modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add a Link</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<form id="link-info">
						Enter the link name: <input class="form-control" type="text" id="link-name" name="link-name" required>
						Enter the link URL: <input class="form-control" type="text" id="link-url" name="link-url" required>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button id="submit-link" type="button" class="btn btn-primary">
					<span class="glyphicon glyphicon-ok"></span>
					Add Link
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="add-image-modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add an Image</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<form id="image-info">
						Enter the image URL: <input class="form-control" type="text" id="image-url" name="image-url" required>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button id="submit-image" type="button" class="btn btn-primary">
					<span class="glyphicon glyphicon-ok"></span>
					Add Image
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
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
		<button class="btn btn-default" data-toggle="modal" data-target="#add-quiz-modal" id="uploadQuiz"> Add a Quiz </button>
		<button class="btn btn-default" data-toggle="modal" data-target="#add-link-modal"> Add a Link </button>
		<button class="btn btn-default" data-toggle="modal" data-target="#add-image-modal"> Add an Image </button>
	</aside>
</div>

<script src="<?= BASE_URL ?>/public/scripts/jquery.validate.min.js"></script>
