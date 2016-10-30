var url = window.location.href;
var idEnd = url.search(/(\d)+$/g);
var cid = url.substr(idEnd)

$(document).ready(function(){
  sendGet(cid,"home", url);
});

$(document).on('click', '.lesson', function() {
  var name = $(this).attr('name');
  sendGet(cid, name, url);
});

const sendGet = function(courseid, lessonid, url) {
  $.get(
		url + '/load',
		{ 'courseid' : courseid, 'lessonid' : lessonid},
		function(data) {
			parseCourse(data.toc);
			if(data.content == "null") {
				parseLesson("Lesson Not Found.");
			} else {
				parseLesson(data.content);
			}
		},
		"json"
	);
}