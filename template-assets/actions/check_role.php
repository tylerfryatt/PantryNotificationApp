<?php
/**
 * Filename: check_role.php
 *
 * Gets the role of a logged in user
 */
session_start();
if(!isset($_SESSION) || !isset($_SESSION['user_role'])) {
    return '';
}
echo json_encode(array('role' => $_SESSION['user_role']));