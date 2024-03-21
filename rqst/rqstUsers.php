<?php
// Un FILE per ogni entità per richiamare i metodi del WEBSERVICES

require_once __DIR__ . "/../inc/utilities.inc.php";

echo $WSURI;

function SearchUser($user, $libro)
{
    global $WSURI;
	$wsRemotePath =  $WSURI . "/libri/screate.php";

    $filtri = array(
        "user" => array(
            "Email" => $user->Email,
            "Token" => $user->Token
        ),
        "object" => array(
            "ID" => $libro->ID,
            "ISBN" => $libro->ISBN,
            "Autore" => $libro->Autore,
            "Titolo" => $libro->Titolo,
            "Prezzo" => $libro->Prezzo
        )
    );

    $response = WsRequest($wsRemotePath, $filtri);
    //var_dump($response); 

    $libro = json_decode($response, true); // O per XML: $response = new SimpleXMLElement($response);
    // var_dump ($libro);

    return $libro;
}


function CreateLibro($user, $libro)
{
    global $WSURI;
	$wsRemotePath =  $WSURI . "/libri/screate.php";

    $filtri = array(
        "user" => array(
            "Email" => $user->Email,
            "Token" => $user->Token
        ),
        "object" => array(
            "ID" => $libro->ID,
            "ISBN" => $libro->ISBN,
            "Autore" => $libro->Autore,
            "Titolo" => $libro->Titolo,
            "Prezzo" => $libro->Prezzo
        )
    );

    $response = WsRequest($wsRemotePath, $filtri);
    //var_dump($response); 

    $libro = json_decode($response, true); // O per XML: $response = new SimpleXMLElement($response);
    // var_dump ($libro);

    return $libro;
}

function ReadLibri($user, $ID = 0) 
{
    global $WSURI;
    $wsRemotePath =  $WSURI . "/libri/sread.php";
    if (is_numeric($ID) && $ID > 0)
        $wsRemotePath .= "?id=".$ID;

    $filtri = array(
        "user" => array(
            "Email" => $user->Email,
            "Token" => $user->Token
        )
    );

    $response = WsRequest($wsRemotePath, $filtri);
    //var_dump($response); 

    $libri = json_decode($response, true); // O per XML: $response = new SimpleXMLElement($response);
    //var_dump ($libri);

    return $libri;
}

function UpdateLibro($user, $libro) //$ID, $isbn, $autore, $titolo, $prezzo)
{
    global $WSURI;
	$wsRemotePath = $WSURI . "/libri/supdate.php";

    $filtri = array(
        "user" => array(
            "Email" => $user->Email,
            "Token" => $user->Token
        ),
        "object" => array(
            "ID" => $libro->ID,
            "ISBN" => $libro->ISBN,
            "Autore" => $libro->Autore,
            "Titolo" => $libro->Titolo,
            "Prezzo" => $libro->Prezzo
        )
    );

    $response = WsRequest($wsRemotePath, $filtri);
    //var_dump($response); 

    $libro = json_decode($response, true); // O per XML: $response = new SimpleXMLElement($response);
    // var_dump ($libro);

    return $libro;
}

function DeleteLibro($user, $ID)
{
    global $WSURI;
	$wsRemotePath = $WSURI . "/libri/sdelete.php?id=" . $ID;

    $filtri = array(
        "user" => array(
            "Email" => $user->Email,
            "Token" => $user->Token
        )
    );

    $response = WsRequest($wsRemotePath, $filtri);
    //var_dump($response); 

    $libro = json_decode($response, true); // O per XML: $response = new SimpleXMLElement($response);
    // var_dump ($libro);

    return $libro;
}

function SearchLibri($user, $isbn, $titolo, $ordinaper = "")
{
    global $WSURI;
	$wsRemotePath = $WSURI . "/libri/ssearch.php";

    $filtri = array(
        "user" => array(
            "Email" => $user->Email,
            "Token" => $user->Token
        ),
        "object" => array(
            "ISBN" => $isbn,
            "Titolo" => $titolo,
            "Ordinaper" => $ordinaper
        )
    ); // Case sensitive

    $response = WsRequest($wsRemotePath, $filtri);
    //var_dump($response); 

    $libri = json_decode($response, true); // O per XML: $response = new SimpleXMLElement($response);
    //var_dump ($libri);

    return $libri;
}
