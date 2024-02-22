<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include __DIR__ . "/config.php";

    include __DIR__ . "/../bl/utenteBL.inc.php"; // Correct the path

    // Set Content-Type header just once
    header('Content-Type: application/json;charset=UTF-8');

    // Process the incoming POST data
    $requestData = json_decode(file_get_contents('php://input'), true);


    $Message = $requestData['Message'];

    if (isset($_SESSION["id_conversation"]) && isset($_SESSION["id_user_message"])) {
        $userId = $_SESSION["id_user_message"];
        $conversation = $_SESSION["id_conversation"];

        $utenteBL = new UtenteBL($conn);

        $result = $utenteBL->MessageAConversation($userId, $conversation, $Message);

        echo $result;
    } else {
        echo json_encode(['error' => 'Failed to send the message']);
    }
}
