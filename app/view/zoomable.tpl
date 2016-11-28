<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/styles/zoomable.css">

<form id="addCourseCommentForm">
  <label>Add comment: <input type="text" id="addCourseComment" name="comment" value=""></label>
  <input type="hidden" id="cid" name="cid" value="">
  <input type="submit" name="submit" value="Add">
</form>

<form id="subscribeToUserForm">
  <input type="hidden" id="aname" name="aname" value="<? $author ?>">
  <a class="btn btn-default subscribe" name="<?= $author->id ?>" role="button">
  </a>
</form>

<svg width="700" height="700"></svg>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="<?= BASE_URL ?>/public/scripts/zoomable.js"></script>
<script src="<?= BASE_URL ?>/public/scripts/subscribe.js" type="text/javascript"></script>

<?= json_encode($courseData) ?>
