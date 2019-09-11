<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/28/2019
 * Time: 3:35 PM
 */


if(isset($_GET['token']) && isset($_GET['email'])) {
    require 'PantryDatabase.php';
    $userToken = $_GET['token'];
    $email = $_GET['email'];


    $db = new PantryDatabase();

    $verify = $db->confirmToken($userToken, $email);


    if($verify) {


session_start();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['user_id'] = $verify['user_id'];
        $_SESSION['user_uid'] = $verify['username'];
        $_SESSION['user_role'] = $verify['role_id'];

    header('Location: password_reset_content.php');
exit();



    }else {
        echo 'something went wrong :/';
    }

}
