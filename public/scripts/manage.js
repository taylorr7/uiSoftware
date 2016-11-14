/*
 * Steven Roberts
 * Hannah Roth
 * Taylor Rydahl
 */

$(document).ready(() => {

    /*
     * Sends a POST Ajax request to check if
     * the course has been published and, if
     * a button was clicked, to update the
     * appropriate information in the database.
     */
    const sendPost = (type,value,info) => {
        $.post(
            `${BASE_URL}/manage/update`,
            {type, value, info},
            (data) => {
                if (data.status === 'success') {
					alert("Operation Successful!");
                    location.reload();
                } else if (data.status === 'failure') {
					alert("Error");
                }
            },
            "json"
        );
    };

    /*
     * Adds the appropriate event to each
     * manage button on the page.
     */
    $('.manage').click(function() {
		const name = $(this).attr('name');
		let type = null;
		let value = null;
		let info = null;
		if(name.startsWith("Update")) {
			type = "Update";
			value = name.substr(7);
			info = [$('input[name="'+value+'fName"]').val(), $('input[name="'+value+'lName"]').val(), $('input[name="'+value+'email"]').val()];
		} else if(name.startsWith("Delete")) {
			type = "Delete";
			value = name.substr(7);
		} else if(name.startsWith("Promote")) {
			type = "Promote";
			value = name.substr(8);
		} else if(name.startsWith("Reset")) {
			type = "Reset";
			value = name.substr(6);
		}
        sendPost(type,value,info);
    });
});
