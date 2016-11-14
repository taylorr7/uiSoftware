/*
* Steven Roberts
* Hannah Roth
* Taylor Rydahl
*/

$(document).ready(() => {

	/*
	* Function to add a new quiz to a lesson.
	*/
	$("#uploadQuiz").click(() => {
		const name = prompt("What do you want the question to be?");
		if (!name) exit();
		const numQuestions = parseInt(prompt("How many possible answers do you want there to be?"));
		if (!numQuestions) exit();
		const answers = [];
		for (let i = 0; i < numQuestions; i++) {
			const answer = prompt("What is a possible answer?");
			if (!answer) exit();
			answers.push(answer);
		}
		if (!answers) exit();
		const correct = parseInt(prompt("Which number answer was the correct one?"));
		if (!correct) exit();
		const answerText = answers.reduce((prev, cur, curIdx) => {
			const answerType = curIdx == correct - 1 ? "correctAnswer" : "answer";
			return `${prev}${answerType}-${cur}:`;
		}, '');
		$('#lessonContent').get(0).value += `\n~QUIZ:name-${name}:${answerText}~\n`;
	});

	/*
	* Function to add a new link to a lesson.
	*/
	$("#uploadLink").click(() => {
		const name = prompt("What should this link say?");
		if (!name) exit();
		const url = prompt("Where do you want this link to go?");
		if (!url) exit();
		$('#lessonContent').get(0).value += `\n~LINK:name-${name}:url-${url}:~\n`;
	});

	/*
	* Function to add a new image to a lesson.
	*/
	$("#uploadImage").click(() => {
		const url = prompt("What is the image url?");
		if (!url) exit();
		$('#lessonContent').get(0).value += `\n~IMAGE:url-${url}:~\n`;
	});


	/*
	* Function to add a new lesson to a course.
	*/
	$("#addLesson").click(function() {
		const lessons = JSON.parse(document.getElementById("addLesson").value);
		let appendText = "";
		let promptText = "Enter the number of the lesson you would like to add:\n";
		for (let i = 0; i < lessons.length; i++) {
			promptText += "\n" + i + ": " + lessons[i];
		}
		var response = prompt(promptText);
		if (parseInt(response) < lessons.length) {
			appendText += "\n~LESSON:name-"+lessons[parseInt(response)]+":~";
		}
		$('[name = ccontent]').get(0).value += appendText;
	});

	/*
	* Function to confirm course deletion.
	*/
	$(".delete-course").click(function() {
		var result = confirm("Are you sure you want to delete this course?");
		if (result) {
			window.location = BASE_URL + "/courses/delete/" + $(this).attr("data-cid");
		}
	});

	/*
	* Function to confirm lesson deletion.
	*/
	$(".delete-lesson").click(function() {
		var result = confirm("Are you sure you want to delete this lesson?");
		if (result) {
			window.location = BASE_URL + "/lessons/delete/" + $(this).attr("data-lid");
		}
	});

	/*
	* Function to confirm user deletion.
	*/
	$(".delete-account").click(function() {
		var result = confirm("Are you sure you want to delete your account?");
		if (result) {
			window.location = BASE_URL + "/account/delete/" + $(this).attr("data-aid");
		}
	});
});
