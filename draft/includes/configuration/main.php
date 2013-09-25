<?php
/**
 *	ICT Championships 2014
 *	WebDesign
 *
 *	Main configuration file
 */

session_start();

/*
 * Associative array containing the pages list
 * The key is the page identifier
 * The value is displayed in the title of the page
 */
$pageList = array(
	'home' => 'Home page',
	'thread_list' => 'Thread list',
	'thread_detail' => 'Thread detail',
	'about' => 'About us'
);

// Get current page
$currentPage = (isset($_GET['page'])) ? $_GET['page'] : 'home';
$currentPage = (array_key_exists($currentPage, $pageList)) ? $currentPage : 'home';

// Define pages
define("PATH_SOURCE", "./includes/sources/");
define("PATH_MODEL", "./includes/models/");
define("PATH_VIEW", "./includes/views/");
define("PATH_CONFIG", "./includes/configuration/");

require_once(PATH_CONFIG.'functions.php');
require_once(PATH_CONFIG.'database.php');
require_once(PATH_CONFIG.'candidate.php');

require_once(PATH_MODEL.'model.php');
require_once(PATH_MODEL.'thread.php');
require_once(PATH_MODEL.'tag.php');
require_once(PATH_MODEL.'comment.php');

