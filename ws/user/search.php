<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //include
    include __DIR__ . "/../../inc/config.php";
    include __DIR__ . "/../../bl/utenteBL.inc.php";


    header('Content-Type: application/json;charset=UTF-8');

    // incoming post data
    $requestData = json_decode(file_get_contents('php://input'), true);

    if (isset($_GET["for"])) {

        //searching for:
        $for = $_GET["for"];

        //searching
        $searchText = $requestData['SearchText'];

        //user
        $utenteBL = new UtenteBL($conn);


        switch ($for) {
            case 'id':
                //search by id
                $result = $utenteBL->GetUserById($searchText);
                                
                break;
            case 'username':
                
                //search by username
                if (isset($_GET["exact"])) {
                    //true or false
                    $mode = ($_GET["exact"] === 'true') ? true : false;

                    $result = $utenteBL->GetUserByUsername($searchText, $mode);
                }
                break;
            case 'name':
                break;
            case 'surname':
                break;
            default:
                echo json_encode(['error' => 'Failed to get the user.']);
                break;
        }

        echo $result;
    } else {
    }
}
