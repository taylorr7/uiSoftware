var link;

function findProfile(profile) {
	link = profile.entry[0].photos[0].value;
}

$(document).ready(function() {
	if(link != null) {
		document.getElementById('profile').src = link + "?s=90&d=mm&r=pg";
	}
	document.getElementById('profile').width = 90;
	document.getElementById('profile').height = 90;
	document.getElementById('profile').alt = "Profile Picture";
});