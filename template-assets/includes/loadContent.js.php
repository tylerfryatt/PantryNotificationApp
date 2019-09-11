<?php
/**
 * Filename: loadContent.js.php
 *
 * Handles JavaScript objects containing JavaScript, CSS, and HTML properties
 */
header('Content-Type: text/javascript');
?>

var loadContent = (
    function () {
        var loaded = [];

        /**
         * Function addHtml
         * adds HTML content, optionally in a particular place
         * @param html string The HTML content to add
         * @param where string the place to add it to
         */
        function addHtml(html, where) {
            if (where) {
                $(where).append(html);
            } else {
                $('body').append(html);
            }
        }

        /**
         * Function addCss
         * Adds CSS content
         * @param css string The CSS content
         */
        function addCss(css) {
            $('<style>')
                .text(css)
                .appendTo('head');
        }

        /**
         * Function addJs
         * @param js string The JavaScript content to add
         * @param callback string The response from the JavaScript
         */
        function addJs(js, callback) {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'data:text/javascript;base64,' + btoa(js);
            script.addEventListener('load', callback);
            document.head.appendChild(script);
        }

        return function(path, callback, where) {
            if (loaded.indexOf(path) > -1) {
                callback();
            } else {
                loaded.push(path);
                $.get(path, function(data) {
                    if (data.html) {
                        addHtml(data.html, where);
                    }
                    if (data.css) {
                        addCss(data.css);
                    }
                    if (data.js) {
                        addJs(data.js, callback);
                    } else {
                        callback();
                    }
                });
            }
        }
    }
)();
