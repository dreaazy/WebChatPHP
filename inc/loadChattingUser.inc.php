<?php

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include __DIR__ . "/config.php";
    include __DIR__ . "/../bl/utenteBL.inc.php";

    // Set Content-Type header just once
    header('Content-Type: application/json;charset=UTF-8');

    // Process the incoming POST data
    $requestData = json_decode(file_get_contents('php://input'), true);

    if (isset($_SESSION["id_user_message"])) {
        
        $utenteBL = new UtenteBL($conn);
        $result = json_decode($utenteBL->GetUserById($_SESSION["id_user_message"]), true); // Ensure true to get associative array

        if (isset($result['success'])) {
            // Encode the result back to JSON before echoing
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'Failed to get the user.']);
        }
    } else {
        echo json_encode(['error' => 'No user to chat with.']);
    }
}
