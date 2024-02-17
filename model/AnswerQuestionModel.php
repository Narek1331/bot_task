<?php

// Include the necessary database configuration
require_once $baseDir . '/config/database.php';

class AnswerQuestionModel{

    // Private property to hold the database connection
    private $database;

    // Constructor to initialize the database connection
    public function __construct(){
        // Create a new instance of the Database class
        $this->database = new Database();
        // Connect to the database
        $this->database->connect();
    }

    // Method to retrieve all answer questions from the database
    public function getAll() {
        try {
            // Get the PDO instance from the database connection
            $pdo = $this->database->getPdo();
            // Prepare the SQL statement to select all answer_questions
            $statement = $pdo->prepare("SELECT * FROM answer_questions");
            // Execute the prepared statement
            $statement->execute();
            // Fetch all answer_questions as an associative array
            $datas = $statement->fetchAll(PDO::FETCH_ASSOC);
            // Return the answer_questions
            return $datas;
        } catch (PDOException $e) {
            // If an exception occurs (e.g., database error), return an empty array
            return [];
        }
    }

    // Method to store a new answer question in the database
    public function store($answer, $question){
        try {
            // Get the PDO instance from the database connection
            $pdo = $this->database->getPdo();
            // Prepare the SQL statement for insertion
            $statement = $pdo->prepare("INSERT INTO answer_questions (answer, question) VALUES (:answer, :question)");
            // Bind values to the parameters in the prepared statement
            $statement->bindValue(':answer', $answer);
            $statement->bindValue(':question', $question);
            // Execute the prepared statement
            $statement->execute();
            // Return true indicating successful insertion
            return true;
        } catch (PDOException $e) {
            // If an exception occurs (e.g., database error), return false
            return false;
        }
    }

    // Method to delete an answer question from the database by its ID
    public function delete($id){
        try {
            // Get the PDO instance from the database connection
            $pdo = $this->database->getPdo();
            // Prepare the SQL statement for deletion
            $statement = $pdo->prepare("DELETE FROM answer_questions WHERE id = :id");
            // Bind the value to the parameter in the prepared statement
            $statement->bindValue(':id', $id);
            // Execute the prepared statement
            $statement->execute();
            // Return true indicating successful deletion
            return true;
        } catch (PDOException $e) {
            // If an exception occurs (e.g., database error), return false
            return false;
        }
    }

    // Method to update the question of an answer question in the database
    public function updateQuestion($id, $newQuestion){
        try {
            // Get the PDO instance from the database connection
            $pdo = $this->database->getPdo();
            // Prepare the SQL statement for updating the question
            $statement = $pdo->prepare("UPDATE answer_questions SET question = :question WHERE id = :id");
            // Bind values to the parameters in the prepared statement
            $statement->bindValue(':id', $id);
            $statement->bindValue(':question', $newQuestion);
            // Execute the prepared statement
            $statement->execute();
            // Return true indicating successful update
            return true;
        } catch (PDOException $e) {
            // If an exception occurs (e.g., database error), return false
            return false;
        }
    }

    // Method to get data (answer and question) based on question name
    public function getDataByQuestionName($questionName){
        try {
            // Get the PDO instance from the database connection
            $pdo = $this->database->getPdo();
            // Prepare the SQL statement for selecting data based on question name
            $statement = $pdo->prepare("SELECT * FROM answer_questions WHERE question_name = :question_name");
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
            $statement = $pdo->query("SELECT * FROM answer_questions ORDER BY id DESC LIMIT 1");
            
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
