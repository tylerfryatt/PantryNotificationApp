<?php
if(!isset($_SESSION) || !isset($_SESSION['user_role'])) {
    header('Location:index.php');
}