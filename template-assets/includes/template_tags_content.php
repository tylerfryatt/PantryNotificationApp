<?php
/**
 * Filename: template_tags_content.php
 *
 * Gets a JSON-encoded object that contains the following functionality:
 *  1. JavaScript: sets event for input of #template_body textbox, to update tags' display every 2 seconds;
 *                  searches through user input in #template_body textbox for a pattern that matches tag input
 *                  displays all the matches under #template_tags div (as long as they aren't empty)
 *  2. HTML: creates a section to display tags that have been added so far
 *  3. CSS: defines the styling properties of the HTML
 */
require_once('LoadableContent.php');
require_once('Template.php');
session_start();

$template_body_key = Template::TEMPLATE_BODY_KEY;

$js = <<<JS
$("#template_body").on("input", function(){
    // when user types in textbox, call function updateTags() every 5 seconds
    setInterval(updateTags, 2000);
});
/**
* Function: clearTags()
* Clears all the tags displayed
*/
function clearTags() {
    $("#template_tags").html('');
}

/**
* Function: updateTags()
* Shows all the tags added, under the "Tags You've Added So Far" section
*/
function updateTags() {
    var template_body = $('#template_body').val();
    // checks for unique values
    function onlyUnique(value, index, self) { 
        return self.indexOf(value) === index;
    }
    // checks for empty tags
    function checkEmpty(tag) {
        return /^([\s\S])*$/.test(tag);
    }
    var all_tags = [];
	var full_tags = [];
    
    // populates the all_tags array with matches of the pattern <something> in textarea #template_body
    var tagRegex = /\[(.*?)\]/g;
    var match;
    while ((match = tagRegex.exec(template_body)) != null)
    {
        all_tags.push(match[1]);
        full_tags = all_tags.filter(Boolean).filter(checkEmpty).filter(onlyUnique);
    }
    // clears all the tags displayed previously
    clearTags();
    
    // loop through the tags array and show the tags, if there are any
    if (full_tags == null || full_tags.length === 0) {
        // shows the message that there are no tags added yet
        $('.no-tag').removeClass('hide-tag');
        // checks again for any new tags in 2000 milliseconds
        setTimeout(updateTags, 2000);
    } else {
        // replaces the current array with another one that has null, empty, and duplicate values removed
        for (var i = 0; i < full_tags.length; i++) {
            var tag_content = full_tags[i];
            // hides the message that there are no tags added yet
            $('.no-tag').addClass('hide-tag');
            // creates span element to show the tag
            var tag = document.createElement("span");
            // adds CSS class "tag" to the newly created span element
            $(tag).addClass("tag");
            
            // fills the span element's text with the tag content
            $(tag).text(tag_content);
            
            // adds the newly created span element to the div #template_tags
            $("#template_tags").append(tag);  
            setTimeout(updateTags, 2000);
        }
    }
}
JS;
$html = <<<HTML
<div class="input-group-prepend">
    <label class="input-group-text" for="tags_added">Tags You've Added So Far:</label>
</div>
<div class="input-group-append overflow-auto" id="template_tags">
    
</div>
<span class="no-tag">None yet! Click the "Need Help?" button for help on adding tags and more.</span>
HTML;
$css = <<<CSS
#template_tags {
    width: 100%;
    margin-top: 10px;
}
.tag {
    background-color: #6c757d;
    color: #fff;
    text-align: center;
    border-radius: 25px;
    border: 1px solid #6c757d;
    padding: 5px;
    width: 100%;
    margin: auto auto auto 10px;
}
.no-tag {
    background-color: #fff;
    color: #6c757d;
    text-align: center;
    border-radius: 25px;
    border: 1px solid #6c757d;
    padding: 5px;
    width: 100%;
    margin: auto auto auto 10px;
}
.hide-tag {
    display: none;
}
CSS;

$obj = new LoadableContent($js, $html, $css);
$obj->load();
