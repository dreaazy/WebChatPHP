<?php

session_start();

include __DIR__ . "/class/ClsUser.php";
include_once __DIR__ . "/inc/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    if (isset($_POST["email"]))
    {
        //prendo l'email
        $email = $_POST["email"];

        //controllo email
        $query = $mysqli->prepare("SELECT ID FROM st10425_users WHERE email = ?");
        $query->bind_param("s", $email);

        //ESEGUO 
        $query->execute();

        $result = $query->get_result();

        $row = $result->fetch_assoc();
        $idUser = $row["ID"];

        //SE L'EMAIL ESISTE NEL DATABASE
        if($result->num_rows > 0)
        {
            $code = "";

            //genero codice
            for ($i=0; $i<6; $i++) {
                $d=rand(1,30)%2;
                $tmp = $d ? chr(rand(65,90)) : chr(rand(48,57));

                $code .= $tmp;
            }

            //Invio email
            $result = mail($email, 'reimposta la tua password', 'per reimpostare la tua password clicca sul seguente link: ');
            

            // Set session timeout for recovery code to 5 minutes
            $recovery_code_timeout = 5 * 60; // 5 minutes in seconds

            if ($result != true) {
                $error = "Impossibile inviare l'email, riprova più tardi.";
            } else {

                // update the recovery code in the database

                $query = $mysqli->prepare("UPDATE st10425_users SET RecoveryCode = ? WHERE ID = ?");
                $query->bind_param("ss", $code, $idUser);
                //ESEGUO 
                $query->execute();

                $result = "Email inviata, controlla la tua casella di posta";

                $_SESSION["recovery_code"] = $code;
                $_SESSION["recovery_code_expires"] = time() + $recovery_code_timeout;
            }

        }
        else
        {
            $error = "nessuna email esistente";
        }

        
        

        
    }
    

    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>recovery password</title>
    <style>
        form input{
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div id="container_signin">
    
    <form action="recovery.php" method="POST">

    <?php if(isset($error)) :?>
        <p><?php echo $error ?></p>
    <?php endif ?>    
        <h2>recover your password</h2>
        <label for="email">insert your email</label>
        <input type="email" name="email" id="email" required>
        <input type="submit" value="submit">
        <?php if(isset($result)) :?>
        <p><?php echo $result ?></p>
        <?php endif ?> 
        <label for="">back to signin <a href="signin.php">Sign in</a></label>
    </form>
    
</div>
    

</body>
</html>