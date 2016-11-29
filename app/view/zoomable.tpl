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
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="<?= BASE_URL ?>/public/scripts/zoomable.js"></script>
<script src="<?= BASE_URL ?>/public/scripts/subscribe.js" type="text/javascript"></script>

<script>
	setJSON(<?= json_encode($courseData) ?>);
</script>
