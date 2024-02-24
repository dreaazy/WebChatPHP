<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include __DIR__ . "/config.php";

    include __DIR__ . "/../bl/utenteBL.inc.php";

    // Set Content-Type header just once
    header('Content-Type: application/json;charset=UTF-8');

    if(isset($_SESSION["user_id"]))
    {
        $utenteBL = new UtenteBL($conn);

        $result = $utenteBL->GetUsersOfOpenChats($_SESSION["user_id"]);

        echo $result;
    }
    else
    {
        echo json_encode(['error' => "Error preparing statement"]);
    }
}
