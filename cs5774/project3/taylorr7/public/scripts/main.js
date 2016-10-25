/*
* Taylor Rydahl
*/

/*
* Function to setup the search bar in the header.
* The text in the search bar is set to "Search" by
* default and is cleared when the user clicks it.
*/
$(document).ready(function(){
	$('input[name="mainSearch"]').val("Search");

	$('input[name="mainSearch"]').click(function(){
		$('input[name="mainSearch"]').val("");
	});
});

/*
* Function to collapse lists of lists.
* Used in the navigation bar on the course page. 
*/
$(document).on('click', '.collapse li a', function() {
	$(this).parent().children('ul').toggle();
});

/*
* Function to bring up the help menu.
* Right now just displays an alert to the user.
*/
help = function() {
	alert("Help");
}

/*
* Function to send the user to a given page.
* Used to turn buttons into a navigation tool.
*/
sendToPage = function(destination) {
	destinationString = destination;
	location.href = destinationString;
}

/*
* Function used to validate the input sent
* by the user when registering for the site.
*/
validateForm = function() {
	uname = document.forms["register"]["user"].value;
	pass = document.forms["register"]["pass"].value;
	vpass = document.forms["register"]["passV"].value;
	fname = document.forms["register"]["fname"].value;
	lname = document.forms["register"]["lname"].value;
	email = document.forms["register"]["email"].value;
	if(uname == null || uname == "") {
		document.forms["register"]["user"].style.backgroundColor = "#ffad99";
		alert("You must enter a valid username.");
		return false;
	}
	if(pass == null || vpass == null || pass == "" || vpass == "") {
		document.forms["register"]["pass"].style.backgroundColor = "#ffad99";
		document.forms["register"]["passV"].style.backgroundColor = "#ffad99";
		alert("You must enter a valid password.");
		return false;
	}
	if(pass != vpass) {
		document.forms["register"]["pass"].style.backgroundColor = "#ffad99";
		document.forms["register"]["passV"].style.backgroundColor = "#ffad99";
		alert("Passwords do not match.");
		return false;
	}
	if(fname == null || fname == "") {
		document.forms["register"]["fname"].style.backgroundColor = "#ffad99";
		alert("You must enter a valid first name.");
		return false;
	}
	if(lname == null || lname == "") {
		document.forms["register"]["lname"].style.backgroundColor = "#ffad99";
		alert("You must enter a valid last name.");
		return false;
	}
	if(email == null || email == "" || !email.includes("@")) {
		document.forms["register"]["email"].style.backgroundColor = "#ffad99";
		alert("You must enter a valid email.");
		return false;
	}
	return true;
}

/*
* Function to allow the user to subscribe to a course.
*/
subscribe = function(buttonObject) {
	if(buttonObject.innerText == "Subscribe") {
		alert("You are now subscribed to this course!");
		buttonObject.innerText = "Unsubscribe";
	} else {
		alert("You are no longer subscribed to this course!");
		buttonObject.innerText = "Subscribe";
	}
}

/*
* Function to allow the user to publish a course.
*/
publish = function(buttonObject) {
	if(buttonObject.innerText == "Publish") {
		alert("This course has been published!");
		buttonObject.innerText = "Unpublish";
	} else {
		alert("This course has been unpublished!");
		buttonObject.innerText = "Publish";
	}
}

/*
* Function to reset the search form.
*/
resetForm = function() {
	$('input[type=checkbox]').each(function() { this.checked = false; }); 
}

/*
* Function to add a new chapter to a course.
*/
addChapter = function() {
	var appendText = "";
	var name = prompt("What is the name of this chapter?");
	appendText = "\n~CHAPTER:name-"+name+":~\n";
	document.getElementById('courseContent').value += appendText;
}

/*
* Function to add a new lesson to a course.
*/
addLesson = function(lessons) {
	var appendText = "";
	var promptText = "Enter the number of the lesson you would like to add:\n";
	for(i = 0; i < lessons.length; i++) {
		promptText += "\n" + i + ": " + lessons[i];
	}
	var response = prompt(promptText);
	if(parseInt(response) < lessons.length) {
		appendText += "\n~LESSON:name-"+lessons[parseInt(response)]+":~";
	} else {
		appendText += "\n~LESSON:name-null:~";
	}
	document.getElementById('courseContent').value += appendText;
}

/*
* Function to save a course a user has created.
*/
saveCourse = function(id) {
	if(id === null || id === '') {
		document.getElementById('opp').value = "New";
	} else {
		document.getElementById('opp').value = "Save";
	}
	answer = confirm("Are you sure?");
	if(answer) {
		document.getElementById('courseCreator').submit();
	}
}

/*
* Function to delete a course a user has created.
*/
deleteCourse = function() {
	document.getElementById('opp').value = "Delete";
	answer = confirm("Are you sure?");
	if(answer) {
		document.getElementById('courseCreator').submit();
	}
}

/*
* Function to add a new quiz to a lesson.
*/
uploadQuiz = function() {
	var appendText = "";
	var name = prompt("What do you want the question to be?");
	var response = prompt("How many possible answers do you want there to be?");
	var answers = [];
	for(i = 0; i < parseInt(response); i++)
	{
		answers[i] = prompt("What is the first possible answer?");
	}
	correct = prompt("Which number answer was the correct one?");
	appendText += "\n~QUIZ:name-"+name+":";
	for(i = 0; i < parseInt(response); i++)
	{
		if(i == parseInt(correct) - 1) {
			appendText += "correctAnswer-"+answers[i]+":";
		} else {
			appendText += "answer-"+answers[i]+":";
		}
	}
	appendText += "~\n";
	document.getElementById('lessonContent').value += appendText;
}

/*
* Function to add a new link to a lesson.
*/
uploadLink = function() {
	var appendText = "";
	var name = prompt("What should this link say?");
	var url = prompt("Where do you want this link to go?");
	appendText = "\n~LINK:name-"+name+":url-"+url+":~\n";
	document.getElementById('lessonContent').value += appendText;
}

/*
* Function to add a new image to a lesson.
*/
uploadImage = function() {
	var appendText = "";
	var url = prompt("What is the image url?");
	appendText = "\n~IMAGE:url-"+url+":~\n";
	document.getElementById('lessonContent').value += appendText;
}

/*
* Function to save a lesson a user has created.
*/
saveLesson = function(id) {
	if(id === null || id === '') {
		document.getElementById('opp').value = "New";
	} else {
		document.getElementById('opp').value = "Save";
	}
	answer = confirm("Are you sure?");
	if(answer) {
		document.getElementById('lessonCreator').submit();
	}
}

/*
* Function to delete a lesson a user has created.
*/
deleteLesson = function() {
	document.getElementById('opp').value = "Delete";
	answer = confirm("Are you sure?");
	if(answer) {
		document.getElementById('lessonCreator').submit();
	}
}