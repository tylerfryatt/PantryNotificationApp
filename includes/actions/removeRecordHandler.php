<?php 

require_once('../PantryDatabase.php');

$db = new PantryDatabase();

$record_id = $_POST['record_id'];


if($record_id > 0){

  $db->deleteLogRecord($record_id);
  
}

?>