<div class="page-header">
	<h2>Design a Lesson</h2>
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
					What should this link say?: <input class="form-control" type="text" id="link-name" name="link-name">
					Where do you want the link to go?: <input class="form-control" type="text" id="link-url" name="link-url">
                </div>
            </div>
            <div class="modal-footer">
                <button id="submit-link" type="button" class="btn btn-primary"  data-dismiss="modal">
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
					What is the image url?: <input class="form-control" type="text" id="image-url" name="image-url">
                </div>
            </div>
            <div class="modal-footer">
                <button id="submit-image" type="button" class="btn btn-primary"  data-dismiss="modal">
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
		<button class="btn btn-default" id="uploadQuiz"> Add a Quiz </button>
		<button class="btn btn-default" data-toggle="modal" data-target="#add-link-modal"> Add a Link </button>
		<button class="btn btn-default" data-toggle="modal" data-target="#add-image-modal"> Add an Image </button>
	</aside>
</div>
