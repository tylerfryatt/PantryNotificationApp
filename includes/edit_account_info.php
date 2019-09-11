<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 6/2/2019
 * Time: 1:06 PM
 */

if(isset($_POST['edit-email-submit'] )) {

    $new_user_email = $_POST['email'];
    if (!filter_var($new_user_email, FILTER_VALIDATE_EMAIL) || empty($new_user_email)) {
        header('Location:account-settings.php?error=invalidEmail');
        exit();

    } else {
        session_start();
        require '../header.php';
        require 'PantryDatabase.php';


        $user_email = $_SESSION['email'];


        $db = new PantryDatabase();
        $user = $db->lookupUser($new_user_email);

        if ($user) {
            echo '<head><script>alert(\'Email Already Exists!\')</script></head>';
            header('Location:account-settings.php?error=edit-email');
            exit();
        } else if (!$user) {

            $db = new PantryDatabase();

            $db->changeEmail($new_user_email, $user_email);


            header('Location:account-settings.php?reset=emailchangesuccessful');

            $_SESSION['email'] = $new_user_email;

        }
    }
}  if(isset($_POST['edit-username-submit'] )) {

    $new_user_username = $_POST['username'];
    if ( empty($new_user_username)) {
        header('Location:account-settings.php?error=invalidUsername');
        exit();

    } else {
        session_start();
        require '../header.php';
        require 'PantryDatabase.php';


        $user_username = $_SESSION['user_uid'];


        $db = new PantryDatabase();
        $user = $db->lookupUser($new_user_username);

        if ($user) {
            echo '<head><script>alert(\'Email Already Exists!\')</script></head>';
            header('Location:account-settings.php?error=edit-username');
            exit();
        } else if (!$user) {

            $db = new PantryDatabase();

            $db->changeUsername($new_user_username, $user_username);


            header('Location:account-settings.php?reset=usernamechangesuccessful');

            $_SESSION['user_uid'] = $new_user_username;


        }
    }
}


