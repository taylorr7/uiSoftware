/*
* Steven Roberts
* Hannah Roth
* Taylor Rydahl
*/

/*
* Function to pull the user's profile picture from
* their Gravatar profile json object.
*/
const findProfile = (profile) => {
	const gravitarSrc = profile.entry[0].photos[0].value;

	$(document).ready(() => {
		$('.profile').attr('src', gravitarSrc);
	});
};
