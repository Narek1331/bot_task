<?php

// Including the required MessageModel.php file
require_once $baseDir . '/model/MessageModel.php';

class BotController {

    private $message_model;

    // Constructor initializing the MessageModel object
    public function __construct(){
        $this->message_model = new MessageModel();
    }

    /**
     * Function to check the status of the Telegram bot.
     * 
     * @return bool Returns true if the status is successfully retrieved, otherwise false.
     */
    private function getStatus(){
        $url = "https://api.telegram.org/bot" . TELEGRAM_TOKEN . "/getMe";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if($data && isset($data['ok'])){
            return true;
        }
        
        return false;
    }

    /**
     * Retrieves the status of the bot and includes a view to display it.
    */
    public function status() {
        $status = $this->getStatus();
        $messages = $this->message_model->getAllMessages();
        include 'view/bot_status.php';
    }

    // Function to handle sending a message to a Telegram user by their ID
    public function messageToTelegramUser(){

        $message_id = $_GET["message_id"];

        if(!$message_id){
            header("Location: /");
            die();
        }

        $message = $this->message_model->getMessageById($message_id);

        include 'view/message_to_telegram_user.php';
    }
    
    // Function to store and send a message to a Telegram user
    public function messageToTelegramUserStore(){
        $message = $_POST["message"];
        $from_id = $_POST["chat_id"];
        $username = $_POST["username"];
        

        if(!$message || !$from_id){
            echo "message has required"; 
        }
        
        $msg = "Send To $username - $message";

        $this->sendMessageToTelegramUser($from_id,$message);
       
    }

    // Function to send a message to a Telegram user by their Telegram ID
    function sendMessageToTelegramUser($from_id, $message) {
        // Telegram API URL
        $api_url = "https://api.telegram.org/bot" . TELEGRAM_TOKEN . "/sendMessage";
        
        // Data to be sent to the API
        $data = [
            'chat_id' => $from_id,
            'text' => $message
        ];
        
        // Initialize cURL session
        $ch = curl_init();
        
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Execute the cURL session
        $response = curl_exec($ch);
        
        // Check for errors
        if ($response === false) {
            $error_message = curl_error($ch);
            // Handle error
            echo "Error: $error_message";
        } else {
            // Message sent successfully
            echo "Message sent to Telegram user with ID $from_id";
        }

        // Close cURL session
        curl_close($ch);
        
        header("Location: /");
        die();

    }

    // Function to handle incoming messages from users
    public function sendMessage() {

        $update = file_get_contents('php://input');

        $update = json_decode($update, true);

        $username = $update['message']['from']['username'];
        $text = $update['message']['text'];
        $chat_id = $update['message']['chat']['id'];
        $from_id = $update['message']['from']['id'];

        $resMessage = "This is bot";

        $answer = $this->message_model->getDataByQuestionName($text);
        
        if($answer && isset($answer['answer'])){
            $resMessage = $answer['answer'];
        }
        
        $this->message_model->store($username, $from_id, $chat_id, $text);
        $msg_data = $this->message_model->getLatestData();
        
        $this->sendSocketMessage([
            'username'=>$username, 
            'from_id'=>$from_id, 
            'chat_id'=>$chat_id, 
            'text'=>$text,
            'id'=>$msg_data['id']
        ]);

        
        $this->responseMessage($chat_id,$resMessage);
    }

    // Function to send a response message to a Telegram user
    function responseMessage($chat_id, $message){
        $url = "https://api.telegram.org/bot" . TELEGRAM_TOKEN . "/sendMessage?chat_id=" . $chat_id . "&text=" . urlencode($message);
        file_get_contents($url);
    }

    function sendSocketMessage(array $data){
        $options = array(
            'cluster' => PUSHER_CLUSTER,
            'useTLS' => true
        );
        
        // Initialize Pusher instance
        $pusher = new Pusher\Pusher(
            PUSHER_KEY,
            PUSHER_SECRET,
            PUSHER_APP_ID,
            $options
        );
        
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
?>
