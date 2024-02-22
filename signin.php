<?php
include __DIR__ . "/dmo/ClsUser.php";
include_once __DIR__ . "/inc/config.php";

session_start();


// Verifica se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Prendo i dati dal form
    if (isset($_POST["username"]) && isset($_POST["password"])) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        $hashedPassword = md5($password);


        $query = $conn->prepare("SELECT ID FROM utenti WHERE username = ? AND password = ? ");
        $query->bind_param("ss", $username, $hashedPassword);

        // ESEGUO 
        $query->execute();

        $result = $query->get_result();

        // controllo se c'è almeno una riga
        if ($result->num_rows > 0) {
            // prendo la prima riga
            $row = $result->fetch_assoc();

            $ID = $row["ID"];

            if (!isset($_SESSION["user_id"])) {
                //setto id e username utente su sessione
                $_SESSION["user_id"] = $ID;
                $_SESSION["user_username"] = $username;
            }


            setcookie('loggedin', $username, time() + 3600);

            // reindirizzo alla pagina con l'username che ha inserito
            header("Location: profile.php?user=" . urlencode($username));
            exit();

        } else {
            $errore = "Credenziali errate.";
        }
    } else {
        $errore = "Parametri mancanti.";
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_m_utenti.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>signin</title>
</head>

<body>


    <!-- se è presente un errore lo mostro -->


    <!-- FORM LOGIN -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <form action="signin.php" method="POST" onsubmit="return validateForm()"
                    class="border p-4 rounded shadow-lg">
                    <h1 class="text-center">Sign In</h1>
                    <?php if (isset($errore)): ?>
                        <p id="error-message">
                            <?php echo $errore; ?>
                        </p>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input id="username" type="text" name="username" class="form-control form-control-lg">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input id="password" type="password" name="password" class="form-control form-control-lg">
                    </div>
                    <div class="mb-3 form-check">
                        <label class="form-check-label" for="rememberMe">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            Remember me
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Accedi</button>
                    <div class="mt-3">
                        <label for="">New? <a href="signup.php">Sign up</a></label><br>
                        <label for="">Forgot password? <a href="recovery.php">Recover</a></label>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (username.trim() === "") {
                alert("Please enter a username.");
                return false;
            }

            if (password.trim() === "") {
                alert("Please enter a password.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>