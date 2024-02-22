<?php 

include __DIR__ . "/config.php";

    include __DIR__ . "/../bl/messaggioBL.inc.php"; // Correct the path

    // Set Content-Type header just once
    header('Content-Type: application/json;charset=UTF-8');

    // Process the incoming POST data
    $requestData = json_decode(file_get_contents('php://input'), true);

    $searchText = "mario";

    $utenteBL = new MessaggioBL($conn);

    $result = $utenteBL->SendMessage("ciao sono simone",2,1);

    echo $result;


?>