<?php
require_once __DIR__ . "/../inc/utilities.inc.php";

global $WSURI;

$wsRemotePath =  $WSURI . "/ws/user/usertry.php";

$filtri = array(
    "user" => array(
        "Email" => "ciao",
        "Token" => "caio"
    )
);


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["f"])) {
        $function = $_GET["f"];



        switch ($function) {
            case "search":

                $response = WsRequest($wsRemotePath, $filtri);
                echo json_encode(['error' => $response]);
                break;
        }
    }
}

/* // Make the request
$response = WsRequest($wsRemotePath, $filtri);

// Check for errors
if ($response === false) {
    // Handle cURL error or other issues
    echo "Error occurred while making the request.";
} else {
    // Debugging: Echo out the response content
    echo "Response content: " . $response;

    // Decode the JSON response
    $libro = json_decode($response, true);

    // Check if decoding was successful
    if ($libro === null) {
        // Handle JSON decoding error
        echo "Error decoding JSON response.";
    } else {
        // Process the response as needed
        var_dump($libro);
    }
}
 */

