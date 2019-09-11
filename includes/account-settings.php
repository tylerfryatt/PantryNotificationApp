<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 6/2/2019
 * Time: 10:18 AM
 */

session_start();
include 'sublog_head_content.php';
include 'common_dash_headcont.php';
include_once 'notifications.php';
include '../header.php';

require 'PantryDatabase.php';
if($_SESSION['role'] === 'manager') {
    $user_role = 'manager_dashboard_content.php';
} else if ($_SESSION['role'] === 'subscriber') {
    $user_role = 'student_dashboard_content.php';
}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Docu</title>

    <script></script>
</head>
<body onload="$('#editUsername').hide();$('#editEmail').hide();">
<header>
    <div class="loggedin">
        <nav class="navtop">
            <div>
                <h1>PCC Pantry</h1>
                <a href="<?php echo $user_role?>"><i class="fas fa-home"></i>Home</a>
                <?php if($_SESSION['role'] === 'manager') {
                    echo '      <a href="../template_editor.php"><i class="far fa-file"></i>Template Editor</a>
            <a href="../log_viewer.php"><i class="fas fa-folder"></i>Log Viewer</a>';
                } ?>
                <a href="account-settings.php"><i class="fas fa-cog"></i>Settings</a>
                <a href="logout.inc.php"><i class="fas fa-sign-out-alt"></i>Logout</a>

            </div>
        </nav>
    </div>
</header>
<main>


    <div id="homecontent">
        <div class="content" >
            <h2 style="font-weight: bolder">Account Settings</h2>


            <p id="username">Username: &nbsp;<?php  $db = new PantryDatabase();$newdata=$db->lookupUser($_SESSION['email']);

                $_SESSION['user_uid'] = $newdata['username']; echo $_SESSION['user_uid'];?>  <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" style="float:right">edit</button> </p>

            <p id="email" style="border-top: 1px solid #AAA;">Email address: <?php  $db = new PantryDatabase();$newdata=$db->lookupUser($_SESSION['user_uid']);

                $_SESSION['email'] = $newdata['email']; echo $_SESSION['email'];?> 	&nbsp; <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" style="float:right">edit</button></p>


            <p style="border-top: 1px solid #AAA;">Account Type: <?php echo $_SESSION['role'] ?>  <button type="button" id="deleteButton" style="float:right" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                    Delete Account
                </button></p>

        <p style="border-top: 1px solid #AAA; margin-top: 2em;">Account Security <a href="password_reset_content.php" id="changePasswordButton" class="btn btn-primary">Change Password</a></p>






        </div>

        <form id="deleteAccount" action="delete.inc.php" method="POST"><!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <input type="hidden" name="id"/>
                        </div>
                        <div class="modal-body">
                            are you sure you want to delete your account?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="delete-submit" class="btn btn-primary">Yes, I'm sure</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form id="changeEmail" action="edit_account_info.php" method="POST"><!-- Modal -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Email</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="modal-body">
                            <div class="col-md-9">
                                <label for="newEmail" class="col-form-label">New Email:</label>
                                <input name="email" type="text" class="form-control" id="newEmail">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="edit-email-submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        <form id="changeUid" action="edit_account_info.php" method="POST"><!-- Modal -->
            <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Username</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="modal-body">
                            <div class="col-md-9">
                                <label for="newUsername" class="col-form-label">New Username:</label>
                                <input name="username" type="text" class="form-control" id="newUsername">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="edit-username-submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>


    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>





</html>



