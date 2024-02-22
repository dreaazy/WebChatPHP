<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {


    include __DIR__ . "/config.php";

    include __DIR__ . "/../bl/utenteBL.inc.php"; // Correct the path

    // Set Content-Type header just once
    header('Content-Type: application/json;charset=UTF-8');

    // Process the incoming POST data
    $requestData = json_decode(file_get_contents('php://input'), true);


    $userId = $requestData['UserId'];
    $attribute = $requestData['Attribute'];
    $value = $requestData['value'];
    


    $utenteBL = new UtenteBL($conn);

    $result = $utenteBL->updateUserAttribute($userId, $attribute, $value); // Correct method invocation

    echo $result;



}




?>