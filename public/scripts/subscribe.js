/*
* Steven Roberts
* Hannah Roth
* Taylor Rydahl
*/

$(document).ready(function(){
  const fullUrl = window.location.href;
  const endIndex = fullUrl.search("authors");
  const url = fullUrl.substr(0, endIndex+7);
  
  /*
  * Checks the current subscribed status of
  * the author when the page loads.
  */
	$('.subscribe').each(function(){	
		const name = $(this).attr('name');
		sendPost(name, "true", url);
	});

  /*
  * Adds the appropriate event to the
  * subscribe button on the page.
  */
  $('.subscribe').click(function(){
	const name = $(this).attr('name');
	sendPost(name, "false", url);
  });
});

/*
* Sends a POST Ajax request to check if
* the author has been subscribed to and, if
* a button was clicked, to update the 
* appropriate information in the database.
*/
const sendPost = function(name, check, url) {
	$.post(
		url + '/subscribe/', 
		{ 'name' : name, 'check' : check }, 
		function(data) {
			if(data.status == 'subscribed') { 
				$('[name = "'+name+'"]').html("<span class='glyphicon glyphicon-edit'></span> Unsubscribe"); 
			} else if(data.status == 'unsubscribed') { 
				$('[name = "'+name+'"]').html("<span class='glyphicon glyphicon-edit'></span> Subscribe"); 
			}}, 
		"json"
	); 
}