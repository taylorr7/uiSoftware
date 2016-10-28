	<div id="title">
		<h2> Design a Lesson </h2>
	</div>

	<div id="navigation">
		<h3> Design Tools </h3>
		<button id="uploadQuiz"> Add a Quiz </button>
		<button id="uploadLink"> Add a Link </button>
		<button id="uploadImage"> Add an Image </button>
	</div>

	<div id="content">

		<h3 class="courseCreator">
			<form id="lessonCreator" action="<?= BASE_URL ?>/lessons/edit/process/<?= $row['id'] ?>" method="POST">
				<label>Lesson Name: <br>
				<input type="text" name="lname" value="<?= $row['lessonname'] ?>"></label> <br><br>
				<label>Lesson Content: <br>
				<textarea name="content" class="courseContent" id="lessonContent"><?= $row['content'] ?></textarea></label> <br>
				<input name="save" type="submit" value="Save Lesson">
				<input name="delete" type="submit" value="Delete Lesson">
			</form>
		</h3>

	</div>

</body>

</html>
