<?php
/**
 * Filename: delete_template.php
 * Deletes a template and returns a result message
 */
require_once('../includes/Template.php');
require_once("../includes/utilities.php");
session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Credentials: true');


// creates new instance of Template class
$template = new Template();
// calls getSpecificTemplate to get the template's data
$delete_template_result = $template->deleteTemplate(
    get_post_value(Template::TEMPLATE_SELECT_KEY)
);
echo json_encode($delete_template_result);