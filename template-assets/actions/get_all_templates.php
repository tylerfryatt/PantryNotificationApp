<?php
/**
 * Filename: get_all_templates.php
 *
 * Gets all the templates and gives their data as a JSON-encoded object
 */
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost');

require_once('../includes/Template.php');

$templates = Template::getAllTemplates();
echo json_encode($templates);