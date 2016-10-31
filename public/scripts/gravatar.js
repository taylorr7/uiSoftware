const findProfile = (profile) => {
	const gravitarSrc = profile.entry[0].photos[0].value;

	$(document).ready(() => {
		$('.profile').attr('src', gravitarSrc);
	});
};
