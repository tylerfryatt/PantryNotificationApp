<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/22/2019
 * Time: 9:52 AM
 */



/*
 delete.in.php
 Deletes the logged in users account data from both the USER and USER_ROLE tables
*/

// connect to the database


session_start();
require '../header.php';
require 'PantryDatabase.php';


$user_sessID = $_SESSION['user_id'];

$db = new PantryDatabase();

 $db->DeleteUser($user_sessID);
 
 header('Location: ../index.php');



