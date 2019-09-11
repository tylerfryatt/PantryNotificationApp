<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/30/2019
 * Time: 1:04 PM
 */



session_start();
include 'sublog_head_content.php';


if(isset($_GET['error'])) {

    if ($_GET['error'] == "emptyfields") {

        echo '    <head><script>alert(\'Error: All fields must be filled out!\')</script></head>';

    }  else if ($_GET['error'] == "passwordcheck") {

        echo '    <head><script>alert(\' Error: Passwords do not match!\')</script></head>';

    } else if ($_GET['error'] == "PasswordNotStrongEnough") {

        echo '    <head><script>alert(\'Error: Password is too weak!\')</script></head>';

    }

} else if(isset($_GET['reset'])) {
    if ($_GET['reset'] == "successful") {

        echo '    <head><script>if (window.confirm(\'Your password has been successfully reset. Would you like to return to the login page?\')) 
{
                                        window.location.href=\'../index.php\';
}
                                    </script></head>';


    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="loginstyles.css.php">

    <title>Document</title>
</head>
<body  onload="$('#signupbox').show()">
<main>

    <div id="signupbox" style="display:none; margin:0 auto; margin-top:100px; width: 35%;"  class="container center_div">
        <div class="shadow-lg" >

            <div class="bg-primary">
                <div style="float:right; font-size: 85%; position: relative; margin-top: 32px;">
                </div>

                <h3 style="margin-bottom: 0">Create new password</h3>

            </div>

            <form action="reset_password.php" method="post" id="signupform" class="form-horizontal" style="margin:3em; margin-top:2em; margin-right:2em;" role="form">




                <div class="form-group" style="white-space: nowrap; float:none;">
                    <label for="password"  style="margin-bottom: 15px;font-size: larger; font-weight: bold" class="col-md-3 control-label">New Password:</label>
                    <div class="col-md-9" style="float:none; ">
                        <input type="password" class="form-control"  name="pwd" placeholder="Password" >
                    </div>
                </div>

                <div class="form-group" style="white-space: nowrap; float:none;">
                    <label for="pwd-repeat"  class="col-md-3 control-label"  style="margin-bottom: 15px;font-size: larger"  >Confirm Password:</label>
                    <div class="col-md-9" style=" float:none;">
                        <input  type="password" class="form-control" name="pwd-repeat" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="mx-auto" style="width: 200px;">

                    <button type="submit" id="btn-signup"   name="password-reset-submit" class="btn btn-primary" style=" width:100px;margin:1.5em; margin-left:2.5em; background-color: #0275d8">Submit</button>
                </div>
                <div style="border-top: 1px solid#888; padding-top:20px; padding-bottom: 20px; font-size:85%">
                    Already have an account?
                    <a  href="../index.php" name="signuplink"  onClick="$('#signupbox').hide(); $('#loginbox').show()">
                        Sign In
                    </a>
                </div>






            </form>



        </div>
    </div>








</main>
</body>
</html>