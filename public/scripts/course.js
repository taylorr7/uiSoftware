$(document).ready(() => {
    sendGet("home");
});

$(document).on('click', '.lesson', function() {
    var name = $(this).attr('name');
    sendGet(name);
});

const sendGet = (lid) => {
    $.getJSON(`${window.location.href}/load`, {lid})
        .done((data) => {
            parseCourse(data.toc);
			if(data.content === null) {
				parseLesson("Lesson Not Found.");
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
	var courseContent = "<li><a name='home' class='lesson'> Home Page </a></li>";
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
