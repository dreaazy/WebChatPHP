<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include __DIR__ . "/config.php";
    include __DIR__ . "/../bl/utenteBL.inc.php"; // Correct the path

    // Set Content-Type header just once
    header('Content-Type: application/json;charset=UTF-8');

    // Process the incoming POST data
    $requestData = json_decode(file_get_contents('php://input'), true);

    $IDMittente = $_SESSION["user_id"];
    $IDDestinatario = $requestData['IDDestinatario'];

    $Tipologia = "S"; //default

    $utenteBL = new UtenteBL($conn);

    // Check if conversation exists between users
    $result = $utenteBL->CheckConversationExistenceBetweenUsers($IDMittente, $IDDestinatario);
    $response = json_decode($result, true);

    if ($response['exists']) {
        //then I take the existing one 
        $conversationId = $response['conversation_id'];
        //this session is usefull to target the person whitch the user want to interact with.
        $_SESSION["id_user_message"] = $IDDestinatario;
        $_SESSION["id_conversation"] = $conversationId;

        echo json_encode(['success' => "Conversation exists with ID: $conversationId. Message sent successfully."]);
    } else {
        // Conversation does not exist, create a new one
        $result = $utenteBL->CreateAConversation($Tipologia);

        // Decode the result to access the conversation ID
        $resultArray = json_decode($result, true);

        // Check if creation was successful and retrieve the conversation ID
        if (isset($resultArray['success'])) {
            $conversationId = $resultArray['conversation_id'];

            $resultJoin = json_decode($utenteBL->JoinAConversation($IDMittente, $conversationId), true);
            $resultJoin2 = json_decode($utenteBL->JoinAConversation($IDDestinatario, $conversationId), true);

            // Check if joining was successful
            if (isset($resultJoin['success']) && isset($resultJoin2['success'])) {

                //this session is usefull to target the person whitch the user want to interact with.
                $_SESSION["id_user_message"] = $IDDestinatario;
                $_SESSION["id_conversation"] = $conversationId;

                echo json_encode(['success' => "New conversation created with ID: $conversationId. Session Started"]);
            } else {
                echo json_encode(['error' => 'Failed to join users to the conversation.']);
            }
        } else {
            echo json_encode(['error' => 'Failed to create a new conversation.']);
        }
    }
}





?>