<?php
/**
 * Signup error messages
 */
include('index.php');

echo '<header><script> $(\'#loginbox\').hide(); $(\'#signupbox\').show()</script></header>'
?>
<header>

    <script>$('#loginbox').hide(); $('#signupbox').show()</script>
    <div class="wrapper-main">
        <section class="section-default">
            <div id="logNotif">

            </div>

            <?php
                if (isset($_GET['signup-error'])) {
                    echo '<head><script>$(\'#loginbox\').hide(); $(\'#signupbox\').show()</script></head>';
                if ( $_GET[ 'signup-error' ] == "emptyfields" ) {
                    echo '    <head><script>alert(\'Error: All fields must be filled out!\')</script></head>';
                }
                if ($_GET['signup-error'] == "invaliduidmail") {
                    echo '    <head><script>alert(\'Error: Invalid Username and e-mail!\')</script></head>';
                } else if ($_GET['signup-error'] == "invaliduid") {
                    echo '    <head><script>alert(\'Error: Invalid Username!\')</script></head>';
                } else if ($_GET['signup-error'] == "invalidmail") {
                    echo '    <head><script>alert(\'Error: Invalid E-mail!\')</script></head>';
                } else if ($_GET['signup-error'] == "passwordcheck") {
                    echo '    <head><script>alert(\' Error: Passwords do not match!\')</script></head>';
                } else if ($_GET['signup-error'] == "usertaken") {
                    echo '    <head><script>alert(\'Error: Email or Username already exists!\')</script></head>';
                } else if ($_GET['signup-error'] == "PasswordNotStrongEnough") {
                    echo '    <head><script>alert(\'Error: Password is too weak!\')</script></head>';
                } else if ($_GET['signup-error'] == "sqlerror") {
                    echo '    <head><script>alert(\'Error: Something went wrong database error!\')</script></head>';
                }
            }
            ?>
        </section>
    </div>
</header>