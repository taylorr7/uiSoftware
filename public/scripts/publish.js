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
    const sendPost = (name, check, url) => {
        $.post(
            `${BASE_URL}/courses/publish`,
            {name, check},
            (data) => {
                if (data.status === 'published') {
                    $(`[name="${name}"]`).html("<span class='glyphicon glyphicon-eye-close'></span> Unpublish");
                } else if (data.status === 'unpublished') {
                    $(`[name="${name}"]`).html("<span class='glyphicon glyphicon-eye-open'></span> Publish");
                }
            },
            "json"
        );
    };

    /*
     * Checks the current published status of
     * each course when the page loads.
     */
    $('.publish').each(function() {
        const name = $(this).attr('name');
        sendPost(name, true);
    });

    /*
     * Adds the appropriate event to each
     * publish button on the page.
     */
    $('.publish').click(function() {
        const name = $(this).attr('name');
        sendPost(name, false);
    });
});
