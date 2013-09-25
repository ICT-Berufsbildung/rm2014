<?php
/**
 *	ICT Championships 2014
 *	WebDesign
 *
 *	Website Index
 */

 
 // Text to remove
 
try {require_once('./includes/configuration/main.php');

	require(PATH_VIEW.'design.php');
	
}
catch (PDOException $e) {
	require_once(PATH_VIEW.'database_error.php');
}
