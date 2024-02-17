<?php

// Define a class for managing the database connection
class Database {
    // Private properties to store database connection details
    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $pdo; // PDO instance

    // Method to establish a database connection
    public function connect() {
        try {
            // Construct the DSN (Data Source Name)
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            
            // Create a new PDO instance
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            
            // Set PDO attributes for error handling
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Return the PDO instance
            return $this->pdo;
        } catch (PDOException $e) {
            // If an exception occurs during connection, display error message
            echo "Connection failed: " . $e->getMessage();
            
            // Return null to indicate failure
            return null;
        }
    }

    // Method to disconnect from the database
    public function disconnect() {
        // Set PDO instance to null, closing the connection
        $this->pdo = null;
    }

    // Method to get the PDO instance
    public function getPdo() {
        // Return the PDO instance
        return $this->pdo;
    }
}

?>
