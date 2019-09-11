<?php
/**
 * Created by PhpStorm.
 * User: Maryam Khan
 * Date: 4/13/2019
 * Time: 7:53 PM
 * Filename: get_specific_template.php
 *
 * Gets a specific template and gives its data as a JSON-encoded object
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
$template_data = $template->getSpecificTemplate(
                        get_post_value(Template::TEMPLATE_SELECT_KEY)
);
echo json_encode($template_data);