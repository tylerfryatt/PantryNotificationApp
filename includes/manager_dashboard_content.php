<?php
/**
 * Created by PhpStorm.
 * User: Maryam Khan
 * Date: 4/12/2019
 * Time: 1:08 PM
 * Filename: student_dashboard_content.php
 *
 *
 */


session_start();
require '../header.php';


?>

<!doctype html>
<html lang="en">
<head>

 
<?php include 'sublog_head_content.php' ?>
    <link rel="stylesheet" type="text/css" href="student_dash_styles.css.php">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">



</head>
<body >
<header>
    <div class="loggedin">
        <nav class="navtop">
            <div>
                <h1>PCC Pantry</h1>

              <a href="manager_dashboard_content.php"><i class="fas fa-home"></i>Home</a>

            <a href="../template_editor.php"><i class="far fa-file"></i>Template Editor</a>
             <a href="../send_notification.php"><i class="far fa-file"></i>Notfication Sender</a>
            <a href="../log_viewer.php"><i class="fas fa-folder"></i>Log Viewer</a>
                <a href="account-settings.php" onclick=" $('#account_settings').removeClass('hide'); $('#homecontent').hide();"><i class="fas fa-cog"></i>Settings</a>
            <a href="logout.inc.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>

        </nav>
    </div>
</header>
        <main>


            <div id="homecontent">
                <div class="content">
                    <h2>Home Page</h2>
                    <p>Welcome back,  <?php echo $_SESSION['name']?>!</p>
                </div>



                <div class="container">
                    <h2 class="text-center">Hello there!</h2>
                    <div class="row">
                        <div id="student_dashboard" class="col-12">Check your <a href="https://authenticate.pcc.edu/authenticationendpoint/login.do?RelayState=https%3A%2F%2Fwww.google.com%2Fa%2Fpcc.edu%2FServiceLogin%3Fservice%3Dmail%26passive%3Dtrue%26rm%3Dfalse%26continue%3Dhttps%253A%252F%252Fmail.google.com%252Fmail%252F%26ss%3D1%26ltmpl%3Ddefault%26ltmplcache%3D2%26emr%3D1%26osid%3D1&commonAuthCallerPath=%2Fsamlsso&forceAuth=false&passiveAuth=false&tenantDomain=carbon.super&sessionDataKey=3fe62461-d593-4a7f-ab21-706ade67a140&relyingParty=google.com%2Fa%2Fpcc.edu&type=samlsso&sp=Google&isSaaSApp=false&authenticators=BasicAuthenticator:LOCAL"> PCC email </a>
                            for any updates!
                        </div>
                    </div>
                </div>
            </div>
        </main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>


</html>
