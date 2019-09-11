<?php
/**
 * Creates a JSON-encoded object with JavaScript, HTML, and CSS properties
 */

class LoadableContent {
    public $js = "";
    public $html = "";
    public $css = "";

    /**
     * LoadableContent constructor.
     * @param $js string The JavaScript content of the object
     * @param $html string The HTML content of the object
     * @param $css string The CSS content of the object
     */
    public function __construct($js, $html, $css) {
        $this->js = $js;
        $this->html = $html;
        $this->css = $css;
    }

    /**
     * Gives the JSON-encoded object from all the properties modified earlier
     */
    public function load() {
        header('Content-Type: application/json');
        echo json_encode($this);
    }
}