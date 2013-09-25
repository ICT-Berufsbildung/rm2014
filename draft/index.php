<?php
/**
 *	ICT Championships 2014
 *	WebDesign
 *
 *	Website Index
 */

try {
	require_once('./includes/configuration/main.php');
    // test
	require(PATH_VIEW.'design.php');
}
catch (PDOException $e) {
	require_once(PATH_VIEW.'database_error.php');
}
