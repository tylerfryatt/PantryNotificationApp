<?php
/**
 * Filename: template_body_content.php
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
tinymce.init({
    selector: "textarea#template_body",
    menubar: false,
    width: 1000,
    paste_data_images: false,
    setup: function (editor) {
        editor.on('paste change undo redo', function () {
            setInterval(updateTags, 2000);
            editor.save();
        });
    }
});

/**
* Function: clearTemplateBody()
* Clears everything in div #template_body
*/
function clearTemplateBody() {
    tinymce.get('{$template_body_key}').setContent('');
    $('#{$template_body_key}').val('');
}

/**
* Function: loadTemplateBody
* Checks if user chose to create a new template instead of modify an existing one; if not,
*   it loads the template's body from the database based on user choice in the template select
*/
function loadTemplateBody() { 
    // clears previous template content, if any, before loading new body
    clearTemplateBody();
    // checks if user choice in template select list is -1, which is the option value that corresponds to the option
    //    to create a new template
    if ($('#{$template_select_key}').children("option:selected").val() == -1) {
        // clears all the tags displayed
        clearTags();
    } else {
        // posts template_select data to get_specific_template.php and gets data on the template specified
        $.post(
            'http://' + location.hostname + location.pathname.substr(0, location.pathname.lastIndexOf('/')) + '/template-assets/actions/get_specific_template.php',
            $('#{$template_select_key}').serialize(),
            function(data) {
                var loaded_template_body = data['{$template_body_key}'];
                
                // populates textarea #template_body with the template body from the database
                tinymce.get('{$template_body_key}').setContent(decodeURI(loaded_template_body));
                
                // sets value of #template_body area to whatever the tinyMCE editor has
                $('#{$template_body_key}').val(tinyMCE.activeEditor.getContent());
                
                // updates the tags displayed based on what was loaded
                updateTags();
            }
        )
    }
    
}

JS;
$html = <<<HTML
<div class="input-group-prepend">
<label class="input-group-text" for="{$template_body_key}">Template Body: </label>
</div>
<textarea class="form-control" id="{$template_body_key}" name="{$template_body_key}" aria-label="Template's contents" aria-describedby="basic-addon" maxlength="10">
</textarea>
    
HTML;
$css = <<<CSS
.focused {
    border-radius: 25px;
    border: 2px solid #0066cc;
}
CSS;

$obj = new LoadableContent($js, $html, $css);
$obj->load();
