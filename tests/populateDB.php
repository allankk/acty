<?php

/*
* Runs a script to populate the database.
*/

require_once(__DIR__ . '/../classes/DatabaseConnection.php');

// create a new database connection
$dbConnection = new databaseConnection();
$sqlFileToRun = (__DIR__ . '/../tests/populateDB.sql');

$dbConnection->executeSQLScript($sqlFileToRun);

?>