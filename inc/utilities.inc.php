<?php

// Indirizzo del webservices
$WSURI = "https://" . $_SERVER["HTTP_HOST"]."/webchat/ws"; // LOCALE
/* $WSURI = "http://biblio.sviluppo.host/ws"; */ // REMOTO

function UserIsLogged() {
    return (isset($_SESSION['username']) && !empty($_SESSION['username']));
}

function RedirectTo($page) {
    if (!empty($page)) header('Location:'.$page);
    exit();
}

function WsRequest($wsRemotePath, $filtri){
    $payload = json_encode($filtri); // Se singolo
    //echo "<pre>url: ".$wsRemotePath." - richiesta: ".var_export($payload, true)."</pre>"; // debug
    
    $ch = curl_init(); // Se da errore qui il servizio CURL è spento -> PHP > Edit selected configuration file > togliere il ; dalla riga con extension=curl (SU UNISERVERZ NON VA LOSTESSO)
    curl_setopt($ch, CURLOPT_URL, $wsRemotePath);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$payload);   // post data
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    //var_dump($response);
    
    return $response;
}

// Primo parametro: file json
// Secondo parametro: oggetto da valorizzare
function JsonParser($data, $class)
{
    //Non testato su array
    //https://stackoverflow.com/questions/5397758/json-decode-to-custom-class
    foreach ($data as $key => $value) $class->{$key} = $value;

    return $class; 
}

function Sanitize($valore, $conn=null, $rimuovitag=false)
{
	// strip_tags: rimuove i tag HTML e PHP dall’input passato
	if ($rimuovitag)
		$valore = strip_tags($valore);
	
	// htmlspecialchars: converte i caratteri speciali di HTML ad es.: "<" in "& lt;" 
	$valore = htmlspecialchars($valore);
	
	// real_escape_string: crea stringa SQL valida codificata con escape tenendo conto del set di caratteri della connessione
	if ($conn)
		$valore = $conn->real_escape_string($valore);

    return $valore;
}

?>