<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/zoomable.css">

<div class="svg-container">
    <svg preserveAspectRatio="xMinYMin meet"></svg>
</div>

<div id="add-comment-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Comment</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control" type="text" id="course-comment" name="course-comment">
                </div>
            </div>
            <div class="modal-footer">
                <button id="sumbit-comment" type="button" class="btn btn-primary"  data-dismiss="modal">
                    <span class="glyphicon glyphicon-send"></span>
                    Post Comment
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="edit-comment-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Comment</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control" type="text" id="ed-comment" name="ed-comment">
                </div>
            </div>
            <div class="modal-footer">
                <button id="edit-comment" type="button" class="btn btn-primary"  data-dismiss="modal">
                    <span class="glyphicon glyphicon-pencil"></span>
                    Edit Comment
                </button>
                <button id="delete-comment" type="button" class="btn btn-primary"  data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>
                    Delete Comment
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://d3js.org/d3.v4.min.js"></script>

<script>
    const DATA_URL = "<?= BASE_URL ?>/authors/breakdown-data/<?= $author->username ?>";
</script>
<script src="<?= BASE_URL ?>/public/scripts/zoomable.js"></script>
