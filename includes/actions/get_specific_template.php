<?php
/**
 * Gets a specific template and gives its data as a JSON-encoded object
 */
session_start();

require_once('../Template.php');
require_once("../utilities.php");

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Credentials: true');

// creates new instance of Template class
$template = new Template();
// calls getSpecificTemplate to get the template's data
$template_data = $template->getSpecificTemplate(
                        get_post_value(Template::TEMPLATE_SELECT_KEY)
);
echo json_encode($template_data);