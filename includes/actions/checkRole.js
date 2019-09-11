/*



Name: getLog.js

JS file handling onLoad and onClick events of the main page.

 */

/*
Checking the role of the logged-in user
 */
function checkRole() {
    $.get('../includes/actions/check_role.php', function(data) {
        var role = '';
        if(data == null || data === '') {
            role = 'not logged in';
        } else {
            var role = JSON.parse(data).role;
        }
        if(role == '2') {
            getLog(); // displays log
        } else {
            window.location.href = 'log_access_denied.php'; // redirects to the access-denied page
        }
    });
}