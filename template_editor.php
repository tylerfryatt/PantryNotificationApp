<?php
/**
 * The front-facing, template-editor page
 */
header('Access-Control-Allow-Origin: http://localhost');
// includes all the files that need to be included
require_once("includes/common_requires.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PCC Food Pantry</title>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script src="includes/loadContent.js.php"></script>
    <script src="includes/jquery-ui/external/jquery/jquery.js"></script>
    <script src="includes/jquery-ui/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/jquery-ui/jquery-ui.css" />

    <script>
        $.get('includes/actions/check_role.php', function(data) {
            console.log(data);
            var role = '';
            if(data == null || data === '') {
                role = 'not logged in';
            } else {
                var role = JSON.parse(data).role;
            }
            if(role == "2") {
                // loads content from create_template_content.php
                loadContent(
                    "includes/create_template_content.php",
                    function() {},
                    // assigns the HTML generated from create_template_content.php to div #template_area
                    '#template_area'
                );
            } else {
                // loads content from create_template_content.php
                loadContent(
                    "includes/template_access_denied.php",
                    function() {},
                    // assigns the HTML generated from create_template_content.php to div #template_area
                    '#template_area'
                );
            }
        });
    </script>
</head>
<body>
<?php include_once 'includes/navbar_content.php'; ?>
<div id="template_area"></div>
</body>
</html>