<?php

 
require_once('../PantryDatabase.php');

if(isset($_POST["from_date"], $_POST["to_date"]))
{
    $from_date = $_POST["from_date"];
    $to_date = $_POST["to_date"];
}

$db = new PantryDatabase();
echo json_encode($db->getLog($from_date, $to_date));

?>