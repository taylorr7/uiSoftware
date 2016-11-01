const validateForm = () => {
	const {pass, vpass} = document.forms.register;

	if (pass.value !== vpass.value) {
		alert('The passwords do not match');
        return false;
	}
    return true;
};
