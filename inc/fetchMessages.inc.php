<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include __DIR__ . "/config.php";
    include __DIR__ . "/../bl/messaggioBL.inc.php";

    header('Content-Type: application/json;charset=UTF-8');

    // Initialize $IDConversation
    $IDConversation = null;

    if (isset($_SESSION["id_conversation"])) {
        $IDConversation = $_SESSION["id_conversation"]; //session "id_conversation" created in joinConversation.inc.php
    } else {
        // Handle the case when $_SESSION["id_conversation"] is not set
        echo json_encode(['error' => 'id_conversation session variable is not set']);
        exit(); // Terminate script execution
    }

    // Create a new instance of MessaggioBL
    $MessaggioBL = new MessaggioBL($conn);

    // Fetch messages by conversation ID
    $result = $MessaggioBL->GetMessagesByConversationID($IDConversation);

    if ($result === false) {
        // Handle the case when fetching messages fails
        echo json_encode(['error' => 'Failed to fetch messages']);
        exit(); // Terminate script execution
    }

    // Decode the JSON result to an array
    $resultArray = json_decode($result, true);

    // Check if $_SESSION["user_id"] is set and add it to the result array
    if (isset($_SESSION["user_id"])) {
        $resultArray['IDSender'] = $_SESSION["user_id"];
    } else {
        // Handle the case when $_SESSION["user_id"] is not set
        echo json_encode(['error' => 'user_id session variable is not set']);
        exit(); // Terminate script execution
    }

    // Encode the modified array back to JSON
    $jsonArray = json_encode($resultArray);

    // Output the JSON
    echo $jsonArray;
}


/* 

OLD FETCH

<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include __DIR__ . "/config.php";
    include __DIR__ . "/../bl/messaggioBL.inc.php";

    header('Content-Type: application/json;charset=UTF-8');

    $requestData = json_decode(file_get_contents('php://input'), true);



    $MessaggioBL = new MessaggioBL($conn);

    if (isset($_SESSION["id_conversation"])) {
        $IDConversation = $_SESSION["id_conversation"]; //session "id_conversation" created in joinConversation.inc.php
    }


    $result = $MessaggioBL->GetMessagesByConversationID($IDConversation);

    // Assuming $result is already a JSON string
    // Convert the JSON string to an array
    $resultArray = json_decode($result, true);

    // Add the attribute just once to the first element of the array
    if (!empty($resultArray) && is_array($resultArray)) {
        if (isset($_SESSION["user_id"])) {
            $resultArray['IDSender'] = $_SESSION["user_id"];
        } else {
            echo json_encode(['error' => 'Failed to fetch messages']);
        }
    }

    // Convert the modified array back to JSON
    $jsonArray = json_encode($resultArray);

    // Output the JSON
    echo $jsonArray;
} */