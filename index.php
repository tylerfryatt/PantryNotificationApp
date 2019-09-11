<?php
include_once 'includes/notifications.php';
?>
<!doctype html>
<html lang="en">
<head>
    <?php include ('includes/sublog_head_content.php'); ?>
    <link rel="stylesheet" type="text/css" href="includes/loginstyles.css.php">
    <title>Document</title>
</head>
<body>
<main>
    <div id="blah">
        <div id="loginbox" style="max-width: 500px"  class="container center_div">
            <div class="shadow-lg">
                <div class="bg-primary">
                    <div style="float:right; font-size: 85%;  margin-top: 32px;">
                        <a href="includes/forgot_password_content.php" id="signlink2" style="color: white;  cursor: pointer; ">Forgot your password?</a>
                    </div>
                    <h4>Sign In</h4>
                </div>

                <form id="loginform" class="form-horizontal" role="form" style="margin:3em;" action="includes/login.inc.php" method="post">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="text" class="form-control" name="mailuid" placeholder="Username/Email">                        </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="pwd" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="login-submit" style=" margin-bottom:1em; background-color: #0275d8;">Submit</button>
                    <div style="border-top: 1px solid#888; padding-top:20px; padding-bottom: 20px; font-size:85%" >
                        Dont have an account?
                        <a href="#" onclick="$('#loginbox').hide(); $('#signupbox').show()" name="signuplink">
                            Sign Up Here
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div id="signupbox" style="display:none; max-width: 500px"  class="container center_div">
            <div class="shadow-lg" >
                <div class="bg-primary">
                    <div style="float:right; font-size: 85%; margin-top: 32px;">
                        <a id="signlink2" style="color: white;  cursor: pointer; " onClick="$('#signupbox').hide(); $('#loginbox').show()">Back</a>
                    </div>
                    <h4>Sign Up</h4>
                </div>
                <form action="includes/signup.inc.php" method="post" id="signupform" class="form-horizontal" style=" max-width=500px; margin:2em" role="form">
                    <div class="form-group">
                        <label for="name" style="white-space: nowrap; margin-right: 20px; margin-left: 20px" class="col-md-2 control-label">Student:</label>
                        <div class="col-md-7">
                            <input type="text"  class="form-control" name="name" placeholder="Full Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mail" style="white-space: nowrap; margin-right: 20px;   margin-left: 20px;"  class="col-md-2 control-label">Email:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="mail" placeholder="Email Address">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" style="white-space: nowrap; margin-right: 20px;  margin-left: 20px" " class="col-md-2 control-label">Username:</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="uid" placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" style="white-space: nowrap; margin-right: 20px;  margin-left: 20px" " class="col-md-2 control-label">Password:</label>
                        <div class="col-md-7">
                            <input type="password" class="form-control" name="pwd" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group" style="white-space: nowrap">
                        <label for="pwd-repeat" style="white-space: nowrap; margin-right: 20px;  margin-left: 20px" " class="col-md-2 control-label"  >Confirm:</label>
                        <div class="col-md-7">
                            <input  type="password"  class="form-control" name="pwd-repeat" placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="mx-auto" >
                        <button type="submit" id="btn-signup"  name="signup-submit" class="btn btn-primary" style="margin:1.5em; margin-left:11.5em; background-color: #0275d8">Register</button>
                    </div>
                    <div style="border-top: 1px solid#888; padding-top:20px; padding-bottom: 20px; font-size:85%">
                        Already have an account?
                        <a  href="#" name="signuplink"  onClick="$('#signupbox').hide(); $('#loginbox').show()">
                            Sign In
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>