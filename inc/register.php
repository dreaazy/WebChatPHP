<?php
// includo la classe
include(__DIR__ . '/../dmo/ClsUser.php');



//inizio la sessione
session_start();

// variabile di errore
$errore = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // PRENDO I DATI
    $nome = $_POST["name"];
    $cognome = $_POST["surname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    //richiedo configurazione con il database
    include_once(__DIR__ . "/config.php");

    // .......................... CONTROLLO unicità USERNAME

    $query = $conn->prepare("SELECT COUNT(ID) FROM utenti WHERE username = ?");
    $query->bind_param("s", $username);

    // ESEGUO 
    $query->execute();

    // prendo il risultato
    $result = $query->get_result();

    // raccolgo i dati
    $row = $result->fetch_assoc();

    // prendo il valore
    $count = $row['COUNT(ID)'];

    // Close the statement
    $query->close();

    //controllo per vedere se ci sono piu username uguali

    if ($count > 0) {
        $errore = "username già presente";
    } else {

        //non ci sono username uguali, creo il mio utente
        CreateUser($nome, $cognome, $email, $username, $password, $conn);
    }

    //chiudo la connessione
    $conn->close();
}

// funzione per inserire la registrazione di un utente
function CreateUser($nome, $cognome, $email, $username, $password, $conn)
{


    // CREO NUOVO UTENTE
    $user = new ClsUser($username, $email);

    $user->setFirstName($nome);
    $user->setLastName($cognome);

    //setto l'hash della password
    $hash = md5($password);

    /* INSERIMENTO NEL DATABASE */

    $stmt = $conn->prepare("INSERT INTO utenti (username, Nome, Cognome, Email, Password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss",  $user->getUsername(), $user->getFirstName() , $user->getLastName(), $user->getEmail(), $hash);

    // Execute the statement
    if ($stmt->execute()) {

        // Insert successful
        $insertedUserId = $conn->insert_id;

        //memorizzo l'ID
        $user->setID($insertedUserId);

        // SALVO L'ID E L'USERNAME DELL'UTENTE NELLA SESSIONE
        $_SESSION["user_id"] = $user->getID();
        $_SESSION["user_username"] = $user->getUsername();


        // Reindirizzo alla pagina principale con l'username
        header("Location: profile.php?user=" . urlencode($username));
    } else {
        // INSERIMENTO FALLITO, inserisco il messaggio nella variabile errore
        $errore = $stmt->error;
    }

    // chiudo lo statement 
    $stmt->close();

    
    exit();
}

?>


