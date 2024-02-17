<?php

// Include the necessary database configuration
require_once $baseDir . '/config/database.php';

// Define a class for handling message-related database operations
class MessageModel {

    // Private property to hold the database connection
    private $database;

    // Constructor to initialize the database connection
    public function __construct(){
        // Create a new instance of the Database class
        $this->database = new Database();
        // Connect to the database
        $this->database->connect();
    }

    // Method to store a new message in the database
    public function store($username, $from_id, $chat_id, $text){
        try {
            // Get the PDO instance from the database connection
            $pdo = $this->database->getPdo();
            // Prepare the SQL statement for insertion
            $statement = $pdo->prepare("INSERT INTO messages (username, from_id, chat_id, text) VALUES (:username, :from_id, :chat_id, :text)");
            // Bind values to the parameters in the prepared statement
            $statement->bindValue(':username', $username);
            $statement->bindValue(':from_id', $from_id, PDO::PARAM_INT); 
            $statement->bindValue(':chat_id', $chat_id, PDO::PARAM_INT); 
            $statement->bindValue(':text', $text);
            // Execute the prepared statement
            $statement->execute();
            // Return true indicating successful insertion
            return true;
        } catch (PDOException $e) {
            // If an exception occurs (e.g., database error), return false
            return false;
        }
    }

    // Method to retrieve all messages from the database
    public function getAllMessages() {
        try {
            // Get the PDO instance from the database connection
            $pdo = $this->database->getPdo();
            // Prepare the SQL statement to select all messages
            $statement = $pdo->prepare("SELECT * FROM messages");
            // Execute the prepared statement
            $statement->execute();
            // Fetch all messages as an associative array
            $messages = $statement->fetchAll(PDO::FETCH_ASSOC);
            // Return the messages
            return $messages;
        } catch (PDOException $e) {
            // If an exception occurs (e.g., database error), return an empty array
            return [];
        }
    }

    // Method to retrieve a message by its ID
    public function getMessageById($id) {
        try {
            // Get the PDO instance from the database connection
            $pdo = $this->database->getPdo();
            // Prepare the SQL statement to select a message by its ID
            $statement = $pdo->prepare("SELECT * FROM messages WHERE id = :id");
            // Bind the ID parameter
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            // Execute the prepared statement
            $statement->execute();
            // Fetch the message as an associative array
            $message = $statement->fetch(PDO::FETCH_ASSOC);
            // Return the message
            return $message;
        } catch (PDOException $e) {
            // If an exception occurs (e.g., database error), return null
            return null;
        }
    }

    // Method to retrieve data by question name
    public function getDataByQuestionName($questionName){
        try {
            // Get the PDO instance from the database connection
            $pdo = $this->database->getPdo();
            // Prepare the SQL statement for selecting data based on question name
            $statement = $pdo->prepare("SELECT * FROM answer_questions WHERE question = :question_name");
            // Bind the value to the parameter in the prepared statement
            $statement->bindValue(':question_name', $questionName);
            // Execute the prepared statement
            $statement->execute();
            // Fetch the result as an associative array
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            // Return the result
            return $result;
        } catch (PDOException $e) {
            // If an exception occurs (e.g., database error), return false or handle the error as needed
            return false;
        }
    }

    public function getLatestData() {
        try {
            // Get the PDO instance from the database connection
            $pdo = $this->database->getPdo();
            
            // Prepare SQL statement to select the latest record
            $statement = $pdo->query("SELECT * FROM messages ORDER BY id DESC LIMIT 1");
            
            // Fetch the latest data
            $latestData = $statement->fetch(PDO::FETCH_ASSOC);
            
            // Return the latest data
            return $latestData;
        } catch (PDOException $e) {
            // If an exception occurs (e.g., database error), return false or handle the error as appropriate for your application
            return false;
        }
    }
}

?>
