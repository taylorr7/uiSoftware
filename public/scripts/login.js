/*
* Steven Roberts
* Hannah Roth
* Taylor Rydahl
*/

/*
* Function to validate the user login.
*/
const validateForm = () => {
	const {pass, vpass} = document.forms.account;

	if (pass.value !== vpass.value) {
		alert('The passwords do not match');
        return false;
	}
  return true;
};
