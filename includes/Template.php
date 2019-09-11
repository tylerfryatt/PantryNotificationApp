<?php
/**
 * Contains the Template class with all of the methods relevant to a Template object
 */

require_once("PantryDatabase.php");

/**
 * Class Template
 */
class Template {
    const TEMPLATE_SELECT_KEY = 'template_select';
    const TEMPLATE_ID_KEY = 'template_id';
    const TEMPLATE_NAME_KEY = 'template_name';
    const TEMPLATE_BODY_KEY = 'template_body';

    const STATUS_ERROR = 'error';
    const STATUS_SUCCESS = 'success';

    const E_NO_TEMPLATE_NAME = '<div id="result_message">Please enter a template name, then try again.</div>';
    const E_NO_TEMPLATE_BODY = '<div id="result_message">Please enter a template body, then try again.</div>';
    const E_TEMPLATE_ALREADY_EXISTS = '<div id="result_message">A template with this name already exists. Please try again using a different name.</div>';
    const ADD_TEMPLATE_SUCCESS = '<div id="result_message">Thank you! Your template has been added. 
                                        Refresh the page and click on the \'Choose a Template\' list to see if your new template\'s there.</div>';
    const UPDATE_TEMPLATE_SUCCESS = '<div id="result_message">Thank you! This template has been updated.</div>';

    private static function get_status_object($status, $message) {
        $obj = new StdClass();

        $obj->status = $status;
        $obj->message = $message;
        return $obj;
    }

    /**
     * Gets all the templates and their data
     * @return array The templates' data
     */
    public static function getAllTemplates() {
        $db = new PantryDatabase();
        $templates_data = $db->getAllTemplates();
        return $templates_data;
    }

    /**
     * Gets a specific template and its data
     * @return array The template's data
     */
    public function getSpecificTemplate($template_id) {
        $db = new PantryDatabase();
        $template_data = $db->getSpecificTemplate($template_id);
        return $template_data;
    }

    /**
     * Creates a new template
     * @return object A message of success or error depending on input
     */
    public function createNewTemplate($template_name, $template_body) {
        if (empty($template_name)) {
            return self::get_status_object(self::STATUS_ERROR, self::E_NO_TEMPLATE_NAME);
        }
        if (empty($template_body)) {
            return self::get_status_object(self::STATUS_ERROR, self::E_NO_TEMPLATE_BODY);
        }
        $db = new PantryDatabase();

        // checks if another template already exists with this name
        $existing_template = $db->lookupTemplateName($template_name);
        if ($existing_template) {
            return self::get_status_object(self::STATUS_ERROR, self::E_TEMPLATE_ALREADY_EXISTS);
        }
        $db->createNewTemplate($template_name, $template_body);
        return self::get_status_object(self::STATUS_SUCCESS, self::ADD_TEMPLATE_SUCCESS);
    }
    /**
     * updates a template
     * @return object A message of success or error depending on input
     */
    public function updateTemplate($template_id, $template_name, $template_body) {
        if (empty($template_name)) {
            return self::get_status_object(self::STATUS_ERROR, self::E_NO_TEMPLATE_NAME);
        }
        if (empty($template_body)) {
            return self::get_status_object(self::STATUS_ERROR, self::E_NO_TEMPLATE_BODY);
        }
        $db = new PantryDatabase();
        $db->updateTemplate($template_id, $template_name, $template_body);
        return self::get_status_object(self::STATUS_SUCCESS, self::UPDATE_TEMPLATE_SUCCESS);
    }
    
    /**
     * updates a template
     * @return object A message of success or error depending on input
     */
    public function deleteTemplate($template_id) {
        $db = new PantryDatabase();
        $db->deleteTemplate($template_id);
    }
}