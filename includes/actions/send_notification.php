<?php
session_start();
require_once ('../Sender.php');

$sender = new Sender();
$sender->sendNotification($_POST['message-area']);