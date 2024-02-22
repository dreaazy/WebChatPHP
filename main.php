<?php

session_start();
// Verifica se è presente il parametro username e deve avere il cookie loggato

// Verifica se è presente il parametro username
if (isset($_GET["username"])) {

    //prendo l'username dall'url
    $username = $_GET["username"];

    //se la sessione è settata
    if (isset($_SESSION["user_id"]) && isset($_SESSION["user_username"])) {

        if($username == $_SESSION["user_username"])
        {
            if (isset($_COOKIE["loggedin"]) && $_COOKIE["loggedin"] === $username) {
                $newuser = false;
            } else {
                //setto i cookie
                setcookie('loggedin', $username, time() + 3600);
                $newuser = true;
            }

            //prendo l'id per mostrarlo
            $user_id = $_SESSION["user_id"];
        }
        else
        {
            RedirectToSignin();
        }
        

        
    } else {
        RedirectToSignin();
    }
} else {
    RedirectToSignin();
}

//funzione che riporta al signin
function RedirectToSignin()
{
    header("Location: signin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>

    <style>
        #home_container
        {
            display: flex;
            flex-direction: column;
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="home_container">
        <!-- controllo se l'username è nuovo messaggio benvenuto altrimenti benvenuto ancora -->
        <?php if ($newuser) : ?>
            <h1>Welcome <?php echo htmlspecialchars($username); ?>!</h1>
        <?php else : ?>
            <h1>Welcome back <?php echo htmlspecialchars($username); ?>!</h1>
        <?php endif; ?>

        <h1>il tuo ID è <?php echo $user_id ?> </h1>
    </div>


    <a href="signin.php">back to signin</a>

</body>

</html>