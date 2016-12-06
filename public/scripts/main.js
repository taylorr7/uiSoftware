/*
* Steven Roberts
* Hannah Roth
* Taylor Rydahl
*/

$(document).ready(() => {

	/*
	* Function to add a new quiz to a lesson.
	*/
	$("#submit-quiz").click(() => {
		if ($("#quiz-answers").valid()) {
			const name = $("#quiz-name").val();
			const correct = $("input[name=answers]:checked").val();
			let answerText = "";
			for (let i = 1; i <= $("#quiz-answers").attr('answers'); i++) {
				let currentAnswer = "answer-" + i;
				let currentForm = "#quiz-answer-" + i;
				if (currentAnswer === correct) {
					answerText += "correctAnswer-" + $(currentForm).val() +":";
				} else {
					answerText += "answer-" + $(currentForm).val() + ":";
				}
			}
			$('#lessonContent').get(0).value += `~QUIZ:name-${name}:${answerText}~\n`;
			$("#add-quiz-modal").modal('hide');
		}
	});

	/*
	* Function to open the add quiz modal and set number of
	* answers.
	*/
	$("#uploadQuiz").click(() => {
		$("#quiz-answers").attr('answers', 1);
	});

	/*
	* Function to add a new possible answer to the quiz modal.
	*/
	$("#add-quiz-question").click(() => {
		let numAnswers = parseInt($("#quiz-answers").attr('answers')) + 1;
		$("#quiz-answers").attr('answers', numAnswers);
		let newOption = "<input type=\"radio\" name=\"answers\" value=\"answer-" + numAnswers +"\">";
		newOption += " Enter a possible answer:<input class=\"form-control\" type=\"text\" id=\"quiz-answer-" + numAnswers + "\" name=\"quiz-answer-" + numAnswers + "\" required>";
		$("#quiz-answers").append(newOption);
	});

	/*
	* Function to add a new link to a lesson.
	*/
	$("#submit-link").click(() => {
		if ($("#link-info").valid()) {
			const name = $("#link-name").val();
			const url = $("#link-url").val();
			$('#lessonContent').get(0).value += `~LINK:name-${name}:url-${url}:~\n`;
			$("#add-link-modal").modal('hide');
		}
	});

	/*
	* Function to add a new image to a lesson.
	*/
	$("#submit-image").click(() => {
		if ($("#image-info").valid()) {
			const url = $("#image-url").val();
			$('#lessonContent').get(0).value += `~IMAGE:url-${url}:~\n`;
			$("#add-image-modal").modal('hide');
		}
	});

	/*
	* Function to add a new lesson to a course.
	*/
	$("#submit-lesson").click(() => {
		const name = $("#selected-lesson").val();
		if (!name) exit();
		$('[name = ccontent]').get(0).value += `~LESSON:name-${name}:~\n`;
	})

	/*
	* Function to open the add lesson modal and populate
	* its options.
	*/
	$("#addLesson").click(function() {
		const lessons = JSON.parse(document.getElementById("addLesson").value);
		let options = "<select id=\"selected-lesson\" class=\"form-control\">";
		for (let i = 0; i < lessons.length; i++) {
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
