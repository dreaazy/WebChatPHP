<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    include __DIR__ . "/config.php";

    include __DIR__ . "/../bl/utenteBL.inc.php"; // Correct the path

    // Set Content-Type header just once
    header('Content-Type: application/json;charset=UTF-8');

    // Process the incoming POST data
    $requestData = json_decode(file_get_contents('php://input'), true);

    if (isset($_GET["t"])) {
        $type = $_GET["t"];

        if ($type = "exact") {
            // Perform some operations based on the incoming data
            $searchText = $requestData['SearchText'];

            $utenteBL = new UtenteBL($conn);

            $result = $utenteBL->GetUserByUsername($searchText, true); // Correct method invocation

            echo $result;
        }
    } else {
        // Perform some operations based on the incoming data
        $searchText = $requestData['SearchText'];

        $utenteBL = new UtenteBL($conn);

        $result = $utenteBL->GetUserByUsername($searchText, false); // Correct method invocation

        echo $result;
    }
}
