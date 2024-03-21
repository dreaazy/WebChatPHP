<?php
// Report all PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Nome della pagina di login
$LoginPage = "login.php";

// Nome della pagina da caricare se utente autenticato
$DashboardPage = "libri.php";

// Nome della pagina dove effettuare la registrazione se non necessario mettere uguale a pagina di login
$RegistrationPage = "login.php";

// Registra automaticamente utente su DB
$UserAutoRegister = true;

// Indirizzo del webservices
$WSURI = "https://" . $_SERVER["HTTP_HOST"] . "/WebchatPHP"; // LOCALE
/* $WSURI = "http://biblio.sviluppo.host/ws"; */ // REMOTO

function UserIsLogged()
{
    return (isset($_SESSION['username']) && !empty($_SESSION['username']));
}

function RedirectTo($page)
{
    if (!empty($page)) header('Location:' . $page);
    exit();
}

function WsRequest($wsRemotePath, $filtri)
{
    $payload = json_encode($filtri); // Convert data to JSON format

    $ch = curl_init(); // Initialize cURL session
    if ($ch === false) {
        // Handle cURL initialization error
        return "Error initializing cURL.";
    }

    curl_setopt($ch, CURLOPT_URL, $wsRemotePath); // Set the URL
    curl_setopt($ch, CURLOPT_POST, 1); // Set HTTP method to POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); // Set the POST data
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Set a timeout (in seconds)

    // Disable SSL certificate verification (not recommended for production)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if ($response === false) {
        // Return cURL error message
        return "cURL error: " . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    // Return the response
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

function Sanitize($valore, $conn = null, $rimuovitag = false)
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
