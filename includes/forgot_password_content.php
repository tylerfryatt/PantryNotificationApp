<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/24/2019
 * Time: 10:37 AM
 */


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include ('sublog_head_content.php');
    include_once('notifications.php');?>
    <link rel="stylesheet" type="text/css" href="loginstyles.css.php">
    <script></script>
    <title>Document</title>
</head>
<body>
<main>
    <div id="passwordbox" style="max-width: 500px" class="container center_div">
        <div class="shadow-lg">

            <div class="bg-primary">

                <div style="float:right; font-size: 85%; margin-top: 32px;">
                    <a href="../index.php" id="signlink2" style="color: white;  cursor: pointer; ">Return to login</a></div>
                <h4>Reset Password</h4>
            </div>

            <form id="password-form" class="form-horizontal" role="form" style="margin-top:4em; " action="reset_request.inc.php" method="post">

                <div class="form-group" >
                    <label for="mail" style="white-space: nowrap; margin-left: 20px" class="col-md-2 control-label">Email:</label>
                    <div class="col-md-8">
                        <input type="text" size="20" style="white-space: nowrap; " class="form-control" name="mail" placeholder="Email Address">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="forgot-password" style=" margin: 1.5em; margin-left: 13em;  background-color: #0275d8;">Send Email</button>
                <div style="border-top: 1px solid#888; padding-top:20px; padding-bottom: 20px; font-size:85%">
                    <div style="margin-left: 10px">
                        A recovery link will be sent you your email..
                    </div>
                </div>







            </form>



        </div>
    </div>
</main>
</body>
</html>
