$(document).ready(function(){
  var url = window.location.href;
  var endIndex = url.search("courses");
  url = url.substr(0, endIndex+7);
  
	$('.publish').each(function(){	
		var name = $(this).attr('name');
		sendPost(name, "true", url);
	});

  $('.publish').click(function(){
	var name = $(this).attr('name');
	sendPost(name, "false", url);
  });
});

const sendPost = function(name, check, url) {
	$.post(
		url + '/publish/', 
		{ 'name' : name, 'check' : check }, 
		function(data) { 
			if(data.status == 'published') { 
				$('[name = "'+name+'"]').html("<span class='glyphicon glyphicon-edit'></span> Unpublish"); 
			} else if(data.status == 'unpublished') { 
				$('[name = "'+name+'"]').html("<span class='glyphicon glyphicon-edit'></span> Publish"); 
			}}, 
		"json"
	); 
}