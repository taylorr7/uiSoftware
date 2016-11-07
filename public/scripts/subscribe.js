/*
 * Steven Roberts
 * Hannah Roth
 * Taylor Rydahl
 */

$(document).ready(() => {
    /*
     * Sends a POST Ajax request to check if
     * the author has been subscribed to and, if
     * a button was clicked, to update the
     * appropriate information in the database.
     */
    const sendPost = (name, check) => {
        $.post(
            `${BASE_URL}/authors/subscribe`,
            {name, check},
            (data) => {
                if (data.status === 'subscribed') {
                    $(`[name="${name}"]`).html("<span class='glyphicon glyphicon-remove'></span> Unsubscribe");
                } else if (data.status === 'unsubscribed') {
                    $(`[name="${name}"]`).html("<span class='glyphicon glyphicon-ok'></span> Subscribe");
                }
            },
            "json"
        );
    };

    /*
     * Checks the current subscribed status of
     * the author when the page loads.
     */
    $('.subscribe').each(function() {
        const name = $(this).attr('name');
        sendPost(name, true);
    });

    /*
     * Adds the appropriate event to the
     * subscribe button on the page.
     */
    $('.subscribe').click(function() {
        const name = $(this).attr('name');
        sendPost(name, false);
    });
});
