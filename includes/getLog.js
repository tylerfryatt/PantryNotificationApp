/*


Name: getLog.js

JS file handling onLoad and onClick events of the main page.

 */

var from_date;
var to_date;

/*

Sending dates to get_log.php and setting up returned contend

 */
function getLog() {

    from_date = $('#from_date').val();
    to_date = $('#to_date').val();

    if (from_date != '' && to_date != '') {
        $.ajax({

            url: "./includes/get_log.php",
            method: "POST",
            data: {from_date: from_date, to_date: to_date},
            success: function (data) {
                $('#log_content').html(data);

            }
        });

    } else {

        alert("Please specify \"From\" and \"To\" dates!");

    }
}

