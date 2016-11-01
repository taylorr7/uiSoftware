/*
* Steven Roberts
* Hannah Roth
* Taylor Rydahl
*/

$(document).ready(function(){
  const fullUrl = window.location.href;
  const endIndex = fullUrl.search("courses");
  const url = fullUrl.substr(0, endIndex+7);
  
  /*
  * Checks the current published status of
  * each course when the page loads.
  */
	$('.publish').each(function(){	
		const name = $(this).attr('name');
		sendPost(name, "true", url);
	});

  /*
  * Adds the appropriate event to each
  * publish button on the page.
  */
  $('.publish').click(function(){
	const name = $(this).attr('name');
	sendPost(name, "false", url);
  });
});

/*
* Sends a POST Ajax request to check if
* the course has been published and, if
* a button was clicked, to update the 
* appropriate information in the database.
*/
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