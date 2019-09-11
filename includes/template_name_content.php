<?php
/**
 * Filename: template_name_content.php
 *
 * Gets a JSON-encoded object that contains the following functionality:
 *  1. JavaScript: none
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
$('#{$template_name_key}').on("focus", function(){
    $('#{$template_name_key}').removeClass("focused");
});
/**
* Function: clearTemplateName()
* Clears everything in div #template_name
*/
function clearTemplateName() {
    $('#{$template_name_key}').val('');
    $('#{$template_name_key}').html('');
}

/**
* Function: loadTemplateName
* Checks if user chose to create a new template instead of modify an existing one; if not,
*   it loads the template's name from the database based on user choice in the template select
*/
function loadTemplateName() { 
    // clears previous template content, if any, before loading new name
    clearTemplateName();
    // checks if user choice in template select list is -1, which is the option value that corresponds to the option
    //    to create a new template
    if ($('#{$template_select_key}').children("option:selected").val() == -1) {
        // focuses the page on the #template_name textbox
        $('#{$template_name_key}').addClass("focused");
        // clears all the tags displayed
    } else {
        // posts template_select data to get_specific_template.php and gets data on the template specified
        $.post(
            'http://' + location.hostname + location.pathname.substr(0, location.pathname.lastIndexOf('/')) + '/includes/actions/get_specific_template.php',
            $('#{$template_select_key}').serialize(),
            function(data) {
                var loaded_template_name = data['{$template_name_key}'];
                var template_name = document.getElementById('{$template_name_key}');
                
                // populates textarea #template_name with the template name from the database
                $(template_name).val(loaded_template_name);
            }
        )
    }
    
}
JS;
$html = <<<HTML
<div class="input-group-prepend">
    <label class="input-group-text" for="{$template_name_key}">Template Name</label>
</div>
<textarea class="form-control" rows="1" name="{$template_name_key}" id="{$template_name_key}" placeholder="Template name... (40 characters maximum)" aria-label="Template's name" aria-describedby="basic-addon" maxlength="40"></textarea>
        
HTML;
$css = <<<CSS
.focused {
    border-radius: 25px;
    border: 2px solid #0066cc;
}
CSS;

$obj = new LoadableContent($js, $html, $css);
$obj->load();
