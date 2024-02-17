<?php

// Define an array with parameters for setting the webhook URL
$getQuery = array(
     "url" => APP_URI . "index.php?page=message_sender",
);

// Initialize a cURL session with the Telegram API for setting the webhook
$ch = curl_init("https://api.telegram.org/bot". TELEGRAM_TOKEN ."/setWebhook?" . http_build_query($getQuery));

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string instead of outputting it directly
curl_setopt($ch, CURLOPT_HEADER, false); // Exclude the HTTP header from the output

// Execute the cURL session to set the webhook
$resultQuery = curl_exec($ch);

// Close the cURL session
curl_close($ch);

// Optionally, you can process the resultQuery if needed
?>
