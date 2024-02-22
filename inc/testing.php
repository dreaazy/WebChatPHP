<?php




include __DIR__ . "/config.php";
include __DIR__ . "/../bl/utenteBL.inc.php"; // Correct the path
$utenteBL = new UtenteBL($conn);
$IDMittente = 12;
$IDDestinatario = 13;
$conversationId = 5;

// Join users to the newly created conversation
$resultJoin = json_decode($utenteBL->JoinAConversation($IDMittente, $conversationId), true);
$resultJoin2 = json_decode($utenteBL->JoinAConversation($IDDestinatario, $conversationId), true);

// Check if joining was successful
if (isset($resultJoin['success']) && isset($resultJoin2['success'])) {
    echo json_encode(['success' => "New conversation created with ID: $conversationId. Users joined successfully."]);
} else {
    echo json_encode(['error' => 'Failed to join users to the conversation.']);
}


/* $IDMittente = 6;
$IDDestinatario = 7;


$Tipologia = "S";

$utenteBL = new UtenteBL($conn);

// Check if conversation exists between users
$result = $utenteBL->CheckConversationExistenceBetweenUsers($IDMittente, $IDDestinatario);
$response = json_decode($result, true);

if ($response['exists']) {
    //then I take the existing one 
    $conversationId = $response['conversation_id'];

    echo json_encode(['success' => "Conversation exists with ID: $conversationId. Message sent successfully."]);
} else {
    // Conversation does not exist, create a new one
    $result = $utenteBL->CreateAConversation($Tipologia);

    // Decode the result to access the conversation ID
    $resultArray = json_decode($result, true);

    // Check if creation was successful and retrieve the conversation ID
    if (isset($resultArray['success'])) {
        $conversationId = $resultArray['conversation_id'];

        // Join users to the newly created conversation
        $resultJoin = $utenteBL->JoinAConversation($IDMittente, $conversationId);
        $resultJoin2 = $utenteBL->JoinAConversation($IDDestinatario, $conversationId);

        // Check if joining was successful
        if (isset($resultJoin['success']) && isset($resultJoin2['success'])) {
            echo json_encode(['success' => "New conversation created with ID: $conversationId. Users joined successfully."]);
        } else {
            echo json_encode(['error' => 'Failed to join users to the conversation.']);
        }
    } else {
        echo json_encode(['error' => 'Failed to create a new conversation.']);
    }
} */






?>