<?php
/**
 * Filename: common_requires.php
 *
 * Includes all the files that are needed for front-facing files
 * This file is so that in the future, when the list of files which need to be included must be altered, each
 *  front-facing file doesn't need to be updated manually.
 */
require_once("template-assets/includes/Template.php");
require_once("template-assets/includes/utilities.php");

session_start();
