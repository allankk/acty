<?php

require_once(__DIR__ . "/../classes/DatabaseConnection.php");
require_once(__DIR__ . "/../classes/Organization.php");

// Processes the object created from json and calls the necessary functions to start adding all organizations and relations to the database.
function postAllOrganizations($json) {
    
    checkIfTablesExist();

    // Calls the postDaughter function with the topmost organization and the parent as null (topmost org does not have a parent).
    if ($json->org_name) {
        postDaughter($json, null);
    } 
}

// Adds the organization to the database. If any daughters exist, runs the same function for them as well.
function postDaughter($org, $parent_name) {
    
    postOrganization($org->org_name, $parent_name);

    if (isset($org->daughters)) {
        foreach ($org->daughters as $daughter) {
            postDaughter($daughter, $org->org_name);
        }
    }
}

// Creates a new Organization instance, which adds the organization and the relations to the database.
function postOrganization($org_name, $parent_name) {
    $org = new Organization($org_name, $parent_name);
}

// Checks if the necessary tables exist in the database. If not, runs the script to create them.
function checkIfTablesExist() {
    $dbConnection = new DatabaseConnection();
    $conn = $dbConnection->getConnection();

    include(__DIR__ . '/../dbConfig.php');

    $queryCheckTables = "SELECT * FROM information_schema.tables WHERE TABLE_NAME = 'organizations' OR TABLE_NAME = 'relations'";
    $resultCheckTables = mysqli_query($conn, $queryCheckTables);

    if (mysqli_num_rows($resultCheckTables) != 2) {
        $createTableScript = (__DIR__ . '/../helpers/createTables.sql');
        $dbConnection->executeSQLScript($createTableScript);
    };
}
?>
