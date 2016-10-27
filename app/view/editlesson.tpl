	<div id="title">
		<h2> Design a Lesson </h2>
	</div>
	
	<div id="navigation">
		<h3> Design Tools </h3>
		<button onclick="uploadQuiz()"> Add a Quiz </button>
		<button onclick="uploadLink()"> Add a Link </button>
		<button onclick="uploadImage()"> Add an Image </button>
	</div>
	
	<div id="content">
	
		<h3 class="courseCreator"> 
			<form id="lessonCreator" action="<?= BASE_URL ?>/lessons/edit/process/" method="POST">
				<label>Lesson Name: 
				<input type="text" name="lname" value="<?= $row['lessonname'] ?>"></label> <br>
				<label>Lesson Content: <br>
				<textarea name="content" class="courseContent" id="lessonContent"><?= $row['content'] ?></textarea></label> <br>
				<label><input name="opp" id="opp" hidden></label>
				<label><input name="id" value="<?= $row['id'] ?>" hidden></label>
				<label><input name="uid" value="<?= $_SESSION['id'] ?>" hidden></label>
				<input name="save" onclick="saveLesson('<?= $row['id'] ?>')" type="button" value="Save Lesson">
				<input name="delete" onclick="deleteLesson()" type="button" value="Delete Lesson">
			</form>
		</h3>
		
	</div>
	
</body>

</html>