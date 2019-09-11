<?php
/**
 * Created by PhpStorm.
 * User: Maryam Khan
 * Date: 4/12/2019
 * Time: 1:08 PM
 * Filename: template_access_denied.php
 *
 * Gets a JSON-encoded object that contains the following functionality:
 *  1. JavaScript: none
 *  2. HTML: creates an access denied message
 *  3. CSS: defines the styling properties of the HTML
 */

require_once('LoadableContent.php');
session_start();

$js = <<<JS
JS;

$html = <<<HTML
<div class="container">
    <h2 class="text-center">Template Editor</h2>
    <div class="row">
        <div id="no_access" class="col-12">ACCESS DENIED: You are either not logged in, or you do not have the authority to access this page.
        </div>
    </div>
</div>
HTML;

$css = <<<CSS
.container {
    margin-top: 10px;
}
#no_access {
    height: 45vh;
     background-color: #FFFACD;
    border-radius: 15px;
    border: 1px solid #6c757d;
    padding: auto;
    margin: 10px;
    text-align: center;
    display: flex;
    flex-wrap:wrap;
    align-items: center;
    align-content:center;
    justify-content: center;

}
CSS;

$obj = new LoadableContent($js, $html, $css);
$obj->load();