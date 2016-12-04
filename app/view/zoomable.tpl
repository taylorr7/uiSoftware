<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/zoomable.css">

<form id="addCourseCommentForm">
    <label>Add comment: <input type="text" id="addCourseComment" name="comment" value=""></label>
    <input type="submit" name="add" value="Add">
</form>

<form id="editCourseCommentForm">
    <label>Edit comment: <input type="text" id="addCourseComment" name="comment" value=""></label>
    <input type="submit" name="edit" value="Edit">
    <input type="submit" name="delete" value="Delete">
</form>

<svg width="700" height="700"></svg>

<div id="comment-modal" class="modal fade" tabindex="-1" role="dialog">
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

<script src="https://d3js.org/d3.v4.min.js"></script>

<script>
    const DATA_URL = "<?= BASE_URL ?>/authors/breakdown-data/<?= $author->username ?>";
</script>
<script src="<?= BASE_URL ?>/public/scripts/zoomable.js"></script>
