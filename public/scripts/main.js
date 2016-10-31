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
	$("#uploadQuiz").click(function() {
		var appendText = "";
		var name = prompt("What do you want the question to be?");
		var response = prompt("How many possible answers do you want there to be?");
		var answers = [];
		for (i = 0; i < parseInt(response); i++) {
			answers[i] = prompt("What is the first possible answer?");
		}
		correct = prompt("Which number answer was the correct one?");
		appendText += "\n~QUIZ:name-"+name+":";
		for (i = 0; i < parseInt(response); i++) {
			if (i == parseInt(correct) - 1) {
				appendText += "correctAnswer-"+answers[i]+":";
			} else {
				appendText += "answer-"+answers[i]+":";
			}
		}
		appendText += "~\n";
		document.getElementById('lessonContent').value += appendText;
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


/*
* Function used to validate the input sent
* by the user when registering for the site.
*/
const validateForm = () => {
	const errColor = "#ffad99";

	const {user, pass, passV, fname, lname, email} = document.forms.register;

	if(!user.value) {
		user.style.backgroundColor = errColor;
		alert("You must enter a valid username.");
		return false;
	}
	if(!pass.value || !passV.value) {
		pass.style.backgroundColor = errColor;
		passV.style.backgroundColor = errColor;
		alert("You must enter a valid password.");
		return false;
	}
	if(pass.value !== passV.value) {
		pass.style.backgroundColor = errColor;
		passV.style.backgroundColor = errColor;
		alert("Passwords do not match.");
		return false;
	}
	if(!fname.value) {
		fname.style.backgroundColor = errColor;
		alert("You must enter a valid first name.");
		return false;
	}
	if(!lname.value) {
		lname.style.backgroundColor = errColor;
		alert("You must enter a valid last name.");
		return false;
	}
	const emailRegex = /\S+@\S+\.\S+/;
	if(!emailRegex.test(email.value)) {
		email.style.backgroundColor = errColor;
		alert("You must enter a valid email.");
		return false;
	}
	return true;
}

/*
* Function used to read a string of course information
* and add it to the page in the form of a table of
* contents.
*/
const parseCourse = function(courseString, currentLesson = null) {
	var courseContent = "<h3> Table of Contents </h3><ul>";
	courseContent += "<li><a name='home' class='lesson'> Home Page </a></li>";
	var courseArr = courseString.split('~');
	for(var i = 0; i < courseArr.length; i++) {
		if(courseArr[i].startsWith("CHAPTER:")) {
			if(i > 1 && courseArr[i-2].startsWith("LESSON:")) {
				courseContent += "</ul></li>";
			}
			var nameStart = courseArr[i].search('name-');
			var nameEnd = courseArr[i].search(':$');
			var chapterName = courseArr[i].substr(nameStart+5, nameEnd-nameStart-5);
			courseContent += "<li><a>" + chapterName + "</a><ul class=\"notActive\">";
		} else if(courseArr[i].startsWith("LESSON:")) {
			var nameStart = courseArr[i].search('name-');
			var nameEnd = courseArr[i].search(':$');
			var lessonName = courseArr[i].substr(nameStart+5, nameEnd-nameStart-5);
			courseContent += "<li><a name='" + lessonName + "' class='lesson'>" + lessonName + "</a></li>";
		}
	}
	courseContent += "</ul>";
	document.getElementById('navigation').innerHTML = courseContent;
}

/*
* Function used to read a string of lesson information
* and add it to the page in the form of a lesson.
*/
const parseLesson = function(lessonString) {
	var lessonContent = "";
	var lessonArr = lessonString.split('~');
	for(var i = 0; i < lessonArr.length; i++) {
		if(lessonArr[i].startsWith("QUIZ:")) {
			var quizArr = lessonArr[i].split(':');
			var quizName = quizArr[1].substr(5);
			lessonContent += "<form method='post'><label>" + quizName + "</label><br>";
			for(var j = 2; j < quizArr.length - 1; j++) {
				if(quizArr[j].startsWith("correctAnswer-")) {
					var quizAnswer = quizArr[j].substr(14);
					lessonContent += "<input type=\"radio\" name=\"answer\" value=\"correct\">" + quizAnswer + "<br>";
				} else {
					var quizAnswer = quizArr[j].substr(7);
					lessonContent += "<input type=\"radio\" name=\"answer\" value=\"incorrect" + j + "\">" + quizAnswer + "<br>";
				}
			}
			lessonContent += "<button onclick=\"validateQuestion()\"> Check Answer! </button>";
			lessonContent += "</form><br>";
		} else if (lessonArr[i].startsWith("LINK:")) {
			var nameStart = lessonArr[i].search('name-');
			var nameEnd = lessonArr[i].search(':url');
			var linkStart = lessonArr[i].search('url-');
			var linkEnd = lessonArr[i].search(':$');
			var linkName = lessonArr[i].substr(nameStart+5, nameEnd-nameStart-5);
			var linkUrl = lessonArr[i].substr(linkStart+4, linkEnd-linkStart-4);
			lessonContent += "<a href=\"" + linkUrl + "\">" + linkName + "</a><br>";
		} else if (lessonArr[i].startsWith("IMAGE:")) {
			var nameStart = lessonArr[i].search('url-');
			var nameEnd = lessonArr[i].search(':$');
			var imgUrl = lessonArr[i].substr(nameStart+4, nameEnd-nameStart-4);
			lessonContent += "<img src=\"" + imgUrl + "\"><br>";
		} else {
			lessonContent += "<p>" + lessonArr[i] + "</p><br>";
		}
	}
	document.getElementById('content').innerHTML = lessonContent;
}

/*
* Function used to check if a question posted on a lesson
* is correct.
*/
const validateQuestion = function() {
	userAnswer = $('input[name="answer"]:checked').val();
	if(userAnswer == "correct") {
		alert("Correct!");
	} else {
		alert("Incorrect");
	}
}
