/*
* Taylor Rydahl
*/

/*
* Function to setup the search bar in the header.
* The text in the search bar is set to "Search" by
* default and is cleared when the user clicks it.
*/
$(document).ready(function() {

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
	$("#uploadLink").click(function() {
		var appendText = "";
		var name = prompt("What should this link say?");
		var url = prompt("Where do you want this link to go?");
		appendText = "\n~LINK:name-"+name+":url-"+url+":~\n";
		document.getElementById('lessonContent').value += appendText;
	});

	/*
	* Function to add a new image to a lesson.
	*/
	$("#uploadImage").click(function() {
		var appendText = "";
		var url = prompt("What is the image url?");
		appendText = "\n~IMAGE:url-"+url+":~\n";
		document.getElementById('lessonContent').value += appendText;
	});


	/*
	* Function to add a new lesson to a course.
	*/
	$("#addLesson").click(function() {
		var lessons = document.getElementById("addLesson").value
		var appendText = "";
		var promptText = "Enter the number of the lesson you would like to add:\n";
		for (i = 0; i < lessons.length; i++) {
			promptText += "\n" + i + ": " + lessons[i];
		}
		var response = prompt(promptText);
		if (parseInt(response) < lessons.length) {
			appendText += "\n~LESSON:name-"+lessons[parseInt(response)]+":~";
		} else {
			appendText += "\n~LESSON:name-null:~";
		}
		document.getElementById('courseContent').value += appendText;
	});
});
