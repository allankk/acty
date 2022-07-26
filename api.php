<?php

header('Content-Type: application/json; charset=utf-8');
require_once(__DIR__ . '/classes/DatabaseConnection.php');

/*
* Check if the user is requesting a GET or a POST method and return the relevant responses.
*/ 

// If request is a GET, outputs all the relations of a given organization name.
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // initialize variables and assing them to user input
    $org_name = null;
    $page = null;

    if (isset($_GET['org_name'])) {
        $org_name = $_GET['org_name'];
    };
    
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    };

    if ($page == null) {
        $page = 0;
    }

    // if input exists, call the function to get the output for relations
    if ($org_name == null) {
        http_response_code(204);
    } else {
        require_once(__DIR__ . '/api/getRelations.php');
        http_response_code(200);
        echo (getRelations($org_name, $page));
    }
}

// If request is a POST, interprets the json and calls the function to add the organizations into the database.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = file_get_contents('php://input');
    $data = json_decode($data);
    
    require_once(__DIR__ . '/api/postOrganizations.php');
    postAllOrganizations($data);
}

?>