$(document).ready(function(){
  var url = window.location.href;
	
  $.post(
  		url + '/publish/', 
		{ 'name' : name, 'check' : 'true' }, 
		function(data) { 
			if(data.status == 'published') { 
				$('#publish').html("<span class='glyphicon glyphicon-edit'></span> Unpublish"); 
			} else if(data.status == 'unpublished') { 
				$('#publish').html("<span class='glyphicon glyphicon-edit'></span> Publish"); 
			}}, 
		"json"
  );
	
  $('#publish').click(function(){
	var name = $(this).attr('name');
	$.post(
		url + '/publish/', 
		{ 'name' : name, 'check' : 'false' }, 
		function(data) { 
			if(data.status == 'published') { 
				$('#publish').html("<span class='glyphicon glyphicon-edit'></span> Unpublish"); 
			} else if(data.status == 'unpublished') { 
				$('#publish').html("<span class='glyphicon glyphicon-edit'></span> Publish"); 
			}}, 
		"json"
	); 
  });
});