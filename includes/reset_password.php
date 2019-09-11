<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/30/2019
 * Time: 2:37 PM
 */
session_start();

if(isset($_POST['password-reset-submit'])) {


    $password = $_POST['pwd'];
    $password_repeat = $_POST['pwd-repeat'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    /**
     * Requires email to meet email format requirements
     * Requires password to contain 1 upper case,
     * 1 lower case, 1 number, passwords match
     * and a minimum length of 8 characters
     */

    if (empty($password) || empty($password_repeat)) {
        header("Location: password_reset_content.php?error=emptyfields");
        exit();
    } else if ($password !== $password_repeat) {
        header("Location: password_reset_content.php?error=passwordcheck");
        exit();
    } else if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
        header("Location: password_reset_content.php?error=PasswordNotStrongEnough");
        exit();
    } else {
        require 'PantryDatabase.php';
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $db = new PantryDatabase();

          $userId=$_SESSION['user_id'];
        $db->reset_password($hashed_password , $userId);

        header('Location: password_reset_content.php?reset=successful');

    }

}
