<?php
/**
 * Filename: updates_template.php
 *
 * Updates a template and returns a result message
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
$template_update_result = $template->updateTemplate(
    get_post_value(Template::TEMPLATE_SELECT_KEY),
    get_post_value(Template::TEMPLATE_NAME_KEY),
    get_post_value(Template::TEMPLATE_BODY_KEY)
);
echo json_encode($template_update_result);