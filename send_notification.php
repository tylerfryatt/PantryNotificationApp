<?php
session_start();
require_once('includes/PantryDatabase.php');
require_once('includes/Template.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send Notifications</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        window.onload = function() {
            var url = 'http://' + location.hostname + location.pathname.substr(0, location.pathname.lastIndexOf('/')) + '/includes/actions/check_role.php';
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", url, true); // requests data from check_role.php, which will tell what the session's role value is

            // Send the proper header information along with the request
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Handles response from GET request for session's role value
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let role = '';
                    if (xhttp.response == null || xhttp.response === '') {
                        role = 'not logged in';
                    } else {
                        role = JSON.parse(xhttp.response).role;
                    }

                    // checks if role value is appropriate to access this page
                    if (role == '2') {
                        loadSenderFunc(); // loads the sender's functionality
                    } else {
                        window.location.href = 'send_notification_access_denied.php'; // redirects to the access-denied page
                    }
                }
            };
            xhttp.send();   // submits GET request

            let loadSenderFunc = function() {
                tinymce.init({
                    selector: "textarea#message-area",
                    menubar: false,
                    width: 1000,
                    paste_data_images: false,
                    setup: function (editor) {
                        editor.on('paste change undo redo', function () {
                            checkTagsFunc(); // checks for tags
                            editor.save(); // saves the content to textarea#message-area
                        });
                    }
                });

                let messageArea = document.getElementById('message-area');
                let templateSelect = document.getElementById('template-select');
                let submitButton = document.getElementById('submit-button');

                let getTemplatesFunc = function () {
                    templateSelect.onchange = function () {
                        let url = 'http://' + location.hostname + location.pathname.substr(0, location.pathname.lastIndexOf('/')) + '/includes/actions/get_specific_template.php';
                        let params = '<?php echo Template::TEMPLATE_SELECT_KEY?>=' + templateSelect.value;
                        let xhttp = new XMLHttpRequest();
                        xhttp.open("POST", url, true);

                        // Send the proper header information along with the request
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                        // Handles response from POST request
                        xhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                let message = JSON.parse(xhttp.response);
                                tinymce.get('message-area').setContent(decodeURI(message['template_body']));
                                // sets value of #message-area textarea to whatever the RTE's content is, so that
                                //  the input can be captured and POSTed later ons
                                messageArea.value = tinyMCE.activeEditor.getContent();
                                checkTagsFunc();    // checks newly loaded body for tags
                            }
                        };
                        xhttp.send(params);
                    };
                };

                let checkTagsFunc = function () {
                    let tagPattern = new RegExp(/\[(.*?)\]/g);
                    if (tagPattern.test(messageArea.value)) { // tests message-area textbox for any tags
                        submitButton.disabled = true;
                    } else {
                        submitButton.disabled = false;
                    }
                };
                getTemplatesFunc();
            }
        }
    </script>
</head>
<body>
<?php include 'includes/navbar_content.php'; ?>

<div class="container" style="margin-top:10px;">
    <h2 class="text-center">Notification Sender</h2>
    <div class="row" style="padding: 10px; text-align: center">
        <p style="font-style: italic">Note: If you're using a template, please sure that all tags (words or phrases surrounded by square brackets) are replaced before pressing the Send Button. Thanks!</p>
    </div>
    <form action="includes/actions/send_notification.php" method="post">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="template-select">Template:</label>
        </div>
        <select id="template-select" class="custom-select" name="template">
            <option selected value="none">No Template</option>
            <?php
            $templates = PantryDatabase::getAllTemplates();
            foreach ($templates as $i => $item) {
                echo '<option value="' . $templates[$i]['template_id'] . '">' . $templates[$i]['template_name'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="message-area">Message:</label>
        </div>
        <textarea id="message-area" name="message-area" rows="3" class="form-control" aria-label="Message text"></textarea>
    </div>
    <div class="row">
        <div class="input-group mb-3 col">
            <input id="submit-button" class="btn btn-primary btn-lg btn-block" type="submit" value="Send">
        </div>
    </div>
</form>
</div>

<!-- Bootstrap and dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>