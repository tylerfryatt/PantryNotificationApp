<?php
/**
 * Filename: create_new_template.php
 *
 * Creates a new template and returns a message of success or error depending on whether template was successfully
 *  created.
 */
require_once('../Template.php');
require_once("../utilities.php");
session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Credentials: true');

// creates new instance of Template class
$template = new Template();
// calls createNewTemplate to get the template's data
$template_creation_result = $template->createNewTemplate(
    get_post_value(Template::TEMPLATE_NAME_KEY),
    get_post_value(Template::TEMPLATE_BODY_KEY)
);
echo json_encode($template_creation_result);