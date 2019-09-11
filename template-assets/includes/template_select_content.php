<?php
/**
 * Filename: template_select_content.php
 *
 * Gets a JSON-encoded object that contains the following functionality:
 *  1. JavaScript: loads the data of all the templates using get_all_templates.php;
 *                  creates option elements using the names of the templates;
 *                  populates the select list with those option elements;
 *                  creates click event for button #choose_template
 *  2. HTML: creates the select element with an option to create a new element (since that will not be in the database);
 *           creates button #choose_template for user to choose a template
 *  3. CSS: defines the styling properties of the HTML
 */
require_once('LoadableContent.php');
require_once('Template.php');
session_start();

$template_select_key = Template::TEMPLATE_SELECT_KEY;
$template_id_key = Template::TEMPLATE_ID_KEY;
$template_name_key = Template::TEMPLATE_NAME_KEY;
$template_body_key = Template::TEMPLATE_BODY_KEY;

$js = <<<JS
/**
* Function loadTemplateNames()
* Gets all the template names and populates the select list with option elements based on the names
*/
function loadTemplateNames() {
    // removes all existing options in the select list besides the first one (because the first one is for template
    //  creation)
    $("#{$template_select_key} option[value!='-1']").remove();
    // load data from get_all_templates.php
    $.get("template-assets/actions/get_all_templates.php", function(data) {
        var templates = data;
        var template_select = document.getElementById('{$template_select_key}');
        
        // loop through the templates' data array
        for (var i = 0; i < templates.length; i++) {
            var template_name = templates[i]['{$template_name_key}'];
            
            // creates option element to store the template name
            var template_option = document.createElement("option");
            
            // fills the option element's text with the template name
            $(template_option).text(template_name);
            // assigns the template option the id of "template_id"
            $(template_option).prop("id", '{$template_id_key}');
            // assigns the template option the value of the current array row's template id
            $(template_option).val(templates[i]['{$template_id_key}']);
            // adds the newly created template option to the array
            template_select.appendChild(template_option);
        }         
    });
}
    
// Loads template name & body when button #choose_template is clicked
$('#choose_template').click(function(){
    // calls loadTemplateName from template_name_content.php (doesn't cause an error because create_template_content.php
    //already loaded template_name_content.php)
    loadTemplateName();
    // calls loadTemplateBody from template_body_content.php (doesn't cause an error because create_template_content.php
    //already loaded template_body_content.php)
    loadTemplateBody();
});

JS;
$html = <<<HTML
<div class="input-group-prepend">
    <label class="input-group-text" for="template_options">Choose A Template</label>
</div>
<select class="custom-select" name="{$template_select_key}" id="{$template_select_key}">
       <option value="-1">Create a New Template</option>
</select>
<div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button" name="choose_template" id="choose_template">OK!</button>
</div>      
HTML;
$css = <<<CSS

CSS;

$obj = new LoadableContent($js, $html, $css);
$obj->load();
