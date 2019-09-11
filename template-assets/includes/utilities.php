<?php
/**
 * Created by PhpStorm.
 * User: Maryam Khan
 * Date: 4/8/2019
 * Time: 3:59 PM
 * Filename: utilities.php
 *
 * Gets the POST or GET value of an HTTP request
 */
/**
 * Function: get_post_value
 * Gets the GET value of an HTTP request
 * @param $key mixed The value passed in
 * @return string
 */
function get_post_value($key) {
    if(!isset($_POST) || !isset($_POST[$key])) {
        return '';
    } else {
        return $_POST[$key];
    }
}

/**
 * Function: get_get_value
 * Gets the GET value of an HTTP request
 * @param $key mixed The value to get
 * @return string
 */
function get_get_value($key) {
    if(!isset($_GET) || !isset($_GET[$key])) {
        return '';
    } else {
        return $_GET[$key];
    }
}