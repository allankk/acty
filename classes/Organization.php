<?php

/*
* Organization class, which adds the organization and its parent to the relevant tables in the database.
*/

require_once('DatabaseConnection.php');

class Organization {
    private $org_name;
    private $parent_name;
    private $conn;

    function __construct($org_name, $parent_name) {
        $this->org_name = $org_name;
        $this->parent_name = $parent_name;

        // create a database connection
        $conn = new DatabaseConnection();
        $conn = $conn->getConnection();
        $this->conn = $conn;

        // save the organization and relation to the db
        $this->saveOrganization($conn);

        if ($parent_name) {
            $this->saveRelation($conn);
        }
    }

    // check if organization already exists. If not, insert to db.
    private function saveOrganization($conn) {
        $queryCheckOrganization = $conn->prepare("SELECT org_name FROM organizations WHERE org_name = ?");
        $queryCheckOrganization->bind_param('s', $this->org_name);
        $queryCheckOrganization->execute();        

        
        if (mysqli_num_rows($queryCheckOrganization->get_result()) == 0) {
            $querySaveOrganization = $conn->prepare("INSERT INTO organizations (org_name) VALUES (?)");
            $querySaveOrganization->bind_param('s', $this->org_name);
            $querySaveOrganization->execute();
        }
    }

    // check if relation already exists. If not, insert to db.
    private function saveRelation($conn) {
        $queryCheckRelation = $conn->prepare("SELECT child_name, parent_name FROM relations WHERE child_name = ? AND parent_name = ?");
        $queryCheckRelation->bind_param('ss', $this->org_name, $this->parent_name);
        $queryCheckRelation->execute();

        if (mysqli_num_rows($queryCheckRelation->get_result()) == 0) {
            $querySaveRelation = $conn->prepare("INSERT INTO relations (child_name, parent_name) VALUES (?, ?)");
            $querySaveRelation->bind_param('ss', $this->org_name, $this->parent_name);
            $querySaveRelation->execute();
        }
    }
}

?>