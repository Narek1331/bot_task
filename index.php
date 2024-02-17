<?php

require __DIR__ . '/vendor/autoload.php';

// Define the base directory
$baseDir = __DIR__;

// Include environment variables
require_once 'env.php';

// Include webhook setting script
require_once $baseDir . '/config/setWebhook.php';

// Include controllers
require_once $baseDir . '/controller/BotController.php';
require_once $baseDir . '/controller/AnswerQuestionController.php';

// Router
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'bot_status';
}

// Instantiate controllers
$botController = new BotController();
$answerController = new AnswerQuestionController();

// Dispatch
switch($page) {
    case 'bot_status':
        // Display bot status
        $botController->status();
        break;
    case 'message_to_telegram_user':
        // Send message to Telegram user
        $botController->messageToTelegramUser();
        break;
    case 'message_to_telegram_user_store':
        // Store message to Telegram user
        $botController->messageToTelegramUserStore();
        break;
    case 'message_sender':
        // Send message
        $botController->sendMessage();
        break;
    case 'answer':
        // Display answer index
        $answerController->index();
        break;
    case 'answer_store':
        // Store answer
        $answerController->store();
        break;
    case 'answer_delete':
        // Delete answer
        $answerController->destroy();
        break;
    case 'answer_update':
        // Update answer question
        $answerController->updateQuestion();
        break;
    default:
        // Display 404 error for unknown page
        echo "404 Page Not Found";
}

?>
