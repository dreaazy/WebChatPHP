<?php

// DEBUG: Utili in fase di debug, da rimuovere nel deploy
ini_set('display_errors', '1');				// Imposta il valore a 1 della direttiva display_errors e display_startup_errors che serve per mostrare o meno gli errori all'utente.
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);						// Funzione nativa che viene utilizzata per mostrare gli errori.

// HEADER PHP: Sfrutto la funzione header() di PHP per specificare gli header HTTP della risposta
header("Access-Control-Allow-Origin: *");					// Rende accessibile questa pagina a qualsiasi dominio 
header("Content-Type: application/json; charset=UTF-8");	// Indica che il formato del corpo della richiesta/risposta è JSON codificato in UTF-8
header("Access-Control-Allow-Methods: POST"); 				// Non è necessario specificare il metodo GET perchè se non indicato viene preso di default
header("Access-Control-Max-Age: 3600");						// Per indicare per quanto tempo, in secondi, i risultati di una richiesta di possono essere memorizzati nella cache
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // Per indicare quali intestazioni HTTP possono essere utilizzate durante la richiesta

// FUNZIONI NECESSARIE
include __DIR__ . "/../../inc/config.php";
include __DIR__ . "/../../bl/utenteBL.inc.php";

require_once("../../inc/utilities.inc.php");				// Funzione Sanitize x limitare il sqlinjection
	

$jsonreq = file_get_contents("php://input");				// Prelevo il json dal body del pacchetto ricevuto
$json = json_decode($jsonreq);								// Deserializzo il json. In alternativa si potrebbe utilizzare $oggetto = JsonParser($temp->object,$libro);
/* $data = $json->object; */


$rspMsg = array(
    "user" => array(
        "Email" => "dajedaje",
        "Token" => "caio"
    )
);

// INVIO RISPOSTA
echo json_encode($rspMsg); 									// in alternativa echo json_encode(array("message" => "Testo del messaggio"));
										// chiusura e rilascio risorse
?>
