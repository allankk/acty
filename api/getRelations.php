<?php

require_once(__DIR__ . "/../classes/DatabaseConnection.php");

// Outputs (in json format) all the relations (parent, daughter, sister) of a given organization.
function getRelations($org_name, $page) {

    $conn = new DatabaseConnection();
    $conn = $conn->getConnection();

    // calculate the offset for every page, required for pagination.
    include(__DIR__ . "/../dbConfig.php");
    $offset = $page * $limit;

    /* Queries to find relations. DB has 2 columns: parent_name and child_name.
    parents: all parent names where the child_name = org_name
    daughters: all child names where the parent_name = org_name
    sisters: all child names from rows which share the parent_name with org_name (excluding the org name itself)
    */
    $queryGetRelations = $conn->prepare("SELECT 'parent' AS relationship_type, parent_name AS org_name FROM relations WHERE child_name = ?
        UNION
        SELECT 'daughter' AS relationship_type, child_name AS org_name FROM relations WHERE parent_name = ?
        UNION
        SELECT DISTINCT 'sister' AS relationship_type, child_name AS org_name FROM relations WHERE parent_name IN (SELECT parent_name FROM relations WHERE child_name=?) AND child_name <> ?
        ORDER BY org_name
        LIMIT $limit OFFSET $offset
    ");

    $queryGetRelations->bind_param('ssss', $org_name, $org_name, $org_name, $org_name);
    $queryGetRelations->execute();
    
    // push every row of results into an array. Return the array in json format.
    $resultRelationsArray = array();
    $resultRelations = $queryGetRelations->get_result();

    if (mysqli_num_rows($resultRelations) > 0) {
        while ($row = mysqli_fetch_assoc($resultRelations)) {
            $resultRelationsArray[] = $row;
        }
    } else {
        echo "No organization found. Please double-check the searched name.";
    }
    
    return(json_encode($resultRelationsArray));
}

?>

