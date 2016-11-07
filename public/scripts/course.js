/*
* Steven Roberts
* Hannah Roth
* Taylor Rydahl
*/

/*
* Loads the home page of the
* course when the page loads.
*/
$(document).ready(() => {
    sendGet("home");
});

/*
* Adds the appropriate events to the
* table of contents to load the appropriate
* lesson information when clicked.
*/
$(document).on('click', '.lesson', function() {
    const name = $(this).attr('name');
    sendGet(name);
});

/*
* Sends a GET Ajax request to load course
* information (table of contents) and 
* lesson information (lesson content)
* from the database.
*/
const sendGet = (lid) => {
    $.getJSON(`${window.location.href}/load`, {lid})
        .done((data) => {
            parseCourse(data.toc);
			if(data.content === null) {
				parseLesson("Lesson Not Found.");
			} else if(data.content === "Comments") {
				parseComment(data.comments);
			} else {
				parseLesson(data.content);
			}
        });
};


/*
* Function used to read a string of course information
* and add it to the page in the form of a table of
* contents.
*/
const parseCourse = function(courseString, currentLesson = null) {
	let courseContent = "<li><a name='home' class='lesson'> Home Page </a></li>";
	const courseArr = courseString.split('~');
	for(let i = 0; i < courseArr.length; i++) {
		if(courseArr[i].startsWith("CHAPTER:")) {
			if(i > 1 && courseArr[i-2].startsWith("LESSON:")) {
				courseContent += "</ul></li>";
			}
			const nameStart = courseArr[i].search('name-');
			const nameEnd = courseArr[i].search(':$');
			const chapterName = courseArr[i].substr(nameStart+5, nameEnd-nameStart-5);
			courseContent += "<li>" + chapterName + "<ul class=\"notActive\">";
		} else if(courseArr[i].startsWith("LESSON:")) {
			const nameStart = courseArr[i].search('name-');
			const nameEnd = courseArr[i].search(':$');
			const lessonName = courseArr[i].substr(nameStart+5, nameEnd-nameStart-5);
			courseContent += "<li><a name='" + lessonName + "' class='lesson'>" + lessonName + "</a></li>";
		}
	}
	courseContent += "</ul>";
	courseContent += "<li><a name='comment' class='lesson'> Course Comments </a></li>";
	document.getElementById('navigation').innerHTML = courseContent;
}

/*
* Function used to read a string of lesson information
* and add it to the page in the form of a lesson.
*/
const parseLesson = function(lessonString) {
	let lessonContent = "";
	const lessonArr = lessonString.split('~');
	for(let i = 0; i < lessonArr.length; i++) {
		if(lessonArr[i].startsWith("QUIZ:")) {
			const quizArr = lessonArr[i].split(':');
			const quizName = quizArr[1].substr(5);
			lessonContent += "<form method='post'><label>" + quizName + "</label><br>";
			for(let j = 2; j < quizArr.length - 1; j++) {
				if(quizArr[j].startsWith("correctAnswer-")) {
					const quizAnswer = quizArr[j].substr(14);
					lessonContent += "<input type=\"radio\" name=\"answer\" value=\"correct\">" + quizAnswer + "<br>";
				} else {
					const quizAnswer = quizArr[j].substr(7);
					lessonContent += "<input type=\"radio\" name=\"answer\" value=\"incorrect" + j + "\">" + quizAnswer + "<br>";
				}
			}
			lessonContent += "<button onclick=\"validateQuestion()\"> Check Answer! </button>";
			lessonContent += "</form><br>";
		} else if (lessonArr[i].startsWith("LINK:")) {
			const nameStart = lessonArr[i].search('name-');
			const nameEnd = lessonArr[i].search(':url');
			const linkStart = lessonArr[i].search('url-');
			const linkEnd = lessonArr[i].search(':$');
			const linkName = lessonArr[i].substr(nameStart+5, nameEnd-nameStart-5);
			const linkUrl = lessonArr[i].substr(linkStart+4, linkEnd-linkStart-4);
			lessonContent += "<a href=\"" + linkUrl + "\">" + linkName + "</a><br>";
		} else if (lessonArr[i].startsWith("IMAGE:")) {
			const nameStart = lessonArr[i].search('url-');
			const nameEnd = lessonArr[i].search(':$');
			const imgUrl = lessonArr[i].substr(nameStart+4, nameEnd-nameStart-4);
			lessonContent += "<img src=\"" + imgUrl + "\"><br>";
		} else {
			lessonContent += "<p>" + lessonArr[i] + "</p><br>";
		}
	}
	document.getElementById('content').innerHTML = lessonContent;
}

const parseComment = function(commentArray) {
	let commentContent = "";
	if(commentArray === null) {
		commentContent = "No Comments Found!";
	} else {
		for(let i = 0; i < commentArray.length; i++)
		{
			commentContent += "<div>" + commentArray[i].commenterName + " Commented : " + commentArray[i].content + "<br>" + commentArray[i].timestamp + "</div><br>";
		}
	}
	commentContent += "<br><textarea rows=5 cols=75></textarea>";
	document.getElementById('content').innerHTML = commentContent;
}

/*
* Function used to check if a question posted on a lesson
* is correct.
*/
const validateQuestion = () => {
	const userAnswer = $('input[name="answer"]:checked').val();
	if(userAnswer === "correct") {
		alert("Correct!");
	} else {
		alert("Incorrect");
	}
}
