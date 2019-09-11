<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/12/2019
 * Time: 12:26 PM
 */


session_start();
session_unset();
session_destroy();

// Redirect to the login page:
header('Location: ../index.php');
exit();
