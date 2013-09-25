<?php
/**
 *	ICT Championships 2014
 *	WebDesign
 *
 *	Database access
 */

$databaseConfig['host'] = "localhost";
$databaseConfig['user'] = "root";
$databaseConfig['password'] = "";
$databaseConfig['name'] = "ict_championships";

// Check database connexion
try {
	$database = new PDO('mysql:dbname='.$databaseConfig['name'].';host='.$databaseConfig['host'], $databaseConfig['user'], $databaseConfig['password']);
	$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
	require_once(PATH_VIEW.'database_access.php');
	exit;
}

// Check if tables are imported
if ($database->query('SHOW TABLES')->rowCount() < 2) {
	require_once(PATH_VIEW.'database_import.php');
	exit;
}
