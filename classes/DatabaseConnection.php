<?php

/*
* DatabaseConnection class, which creates a connection to a mySQL database and has a method to run an SQL script.
*/

class DatabaseConnection {
    private $host;
    private $user;
    private $password;
    private $db;
    private $conn;

    function __construct() {
        // set up connection according to database config
        include(__DIR__ . '/../dbConfig.php');
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;

        $connection = mysqli_connect($this->host,$this->user,$this->password,$this->db);

        if(!$connection) {
            die("\nfailed to connect to the database\n");
        } else {
            $this->connection = $connection;
        }
    }

    // Gets the connection object
    public function getConnection() {
        return $this->connection;
    }

    // Runs an SQL script in the database. Used for initializing tables and for testing purposes.
    public function executeSQLScript($file) {
        $script = file_get_contents($file);
        
        if (mysqli_multi_query($this->connection, $script)) {
            echo "\nSQL script run successfully\n\n";
        } else {
            echo "\nSQL script failed to run: " . mysqli_error($this->connection);
        }        
    }
}

?>