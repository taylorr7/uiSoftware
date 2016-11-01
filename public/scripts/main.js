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
		const numQuestions = parseInt(prompt("How many possible answers do you want there to be?"));
		const answers = [];
		for (let i = 0; i < numQuestions; i++) {
			answers.push(prompt("What is a possible answer?"));
		}
		const correct = parseInt(prompt("Which number answer was the correct one?"));
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
		const url = prompt("Where do you want this link to go?");
		$('#lessonContent').get(0).value += `\n~LINK:name-${name}:url-${url}:~\n`;
	});

	/*
	* Function to add a new image to a lesson.
	*/
	$("#uploadImage").click(() => {
		const url = prompt("What is the image url?");
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
		} else {
			appendText += "\n~LESSON:name-null:~";
		}
		$('[name = ccontent]').get(0).value += appendText;
	});
});
