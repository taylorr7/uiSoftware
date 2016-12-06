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
	$("#submit-link").click(() => {
		const name = $("#link-name").val();
		if (!name) exit();
		const url = $("#link-url").val();
		if (!url) exit();
		$('#lessonContent').get(0).value += `\n~LINK:name-${name}:url-${url}:~\n`;
	});

	/*
	* Function to add a new image to a lesson.
	*/
	$("#submit-image").click(() => {
		const url = $("#image-url").val();
		if (!url) exit();
		$('#lessonContent').get(0).value += `\n~IMAGE:url-${url}:~\n`;
	});

	/*
	* Function to add a new lesson to a course.
	*/
	$("#submit-lesson").click(() => {
		const name = $("#selected-lesson").val();
		if (!name) exit();
		$('[name = ccontent]').get(0).value += `\n~LESSON:name-${name}:~\n`;
	})

	/*
	 * Function to open the add lesson modal and populate
	 * its options.
	 */
	$("#addLesson").click(function() {
		const lessons = JSON.parse(document.getElementById("addLesson").value);
		let options = "<select id=\"selected-lesson\" class=\"form-control\">";
		for(let i = 0; i < lessons.length; i++) {
			options += "<option value=\"" + lessons[i] + "\">" + lessons[i] + "</option>";
		}
		options += "</select>";
		$("#select-lesson").html(options);
	});

	/*
	* Function to confirm course deletion.
	*/
	$(".delete-course").click(function() {
		const result = confirm("Are you sure you want to delete this course?");
		if (result) {
			window.location = `${BASE_URL}/courses/delete/${$(this).attr("data-cid")}`;
		}
	});

	/*
	* Function to confirm lesson deletion.
	*/
	$(".delete-lesson").click(function() {
		const result = confirm("Are you sure you want to delete this lesson?");
		if (result) {
			window.location = `${BASE_URL}/lessons/delete/${$(this).attr("data-lid")}`;
		}
	});
});
