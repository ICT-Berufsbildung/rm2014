<?php

$dsn = 'mysql:dbname=rm2014;host=127.0.0.1';
$username = 'root';
$password = '';

$database = new PDO($dsn, $username, $password);

return $database;
