<?php
/**
 * Gets the $_SESSION variable of the role of a logged in user
 */
session_start();
if(!isset($_SESSION) || !isset($_SESSION['user_role'])) {
    return '';
}
echo json_encode(array('role' => $_SESSION['user_role']));