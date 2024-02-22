<?php

include_once __DIR__ . "/inc/register.php";

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_m_utenti.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>signup</title>
</head>

<body>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                

                <!-- FORM REGISTRAZIONE -->

                <form action="signup.php" method="POST" onsubmit="return validateForm()"
                    class="border p-4 rounded shadow-lg">
                    <h1 class="text-center">Sign Up</h1>
                    <!-- Display error message if any -->
                    <?php if (!empty($errore)): ?>
                        <p id="error-message">
                            <?php echo $errore; ?>
                        </p>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input id="name" type="text" name="name" class="form-control form-control-lg">
                    </div>

                    <div class="mb-3">
                        <label for="surname" class="form-label">Cognome:</label>
                        <input id="surname" type="text" name="surname" class="form-control form-control-lg">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input id="email" type="email" name="email" class="form-control form-control-lg">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input id="username" type="text" name="username" class="form-control form-control-lg">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input id="password" type="password" name="password" class="form-control form-control-lg">
                    </div>

                    <div class="mb-3">
                        <label for="">Hai già un account? <a href="signin.php">Sign in</a></label>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrati</button>
                </form>


            </div>
        </div>
    </div>


    <script>
        /* funzione che viene chiamata quando premo il button submit, e controlla tutti i vari campi */
        function validateForm() {
            var name = document.getElementById("name").value;
            var surname = document.getElementById("surname").value;
            var email = document.getElementById("email").value;
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (name.trim() === "") {
                alert("Inserisci il tuo nome.");
                return false;
            }

            if (surname.trim() === "") {
                alert("Inserisci il tuo cognome.");
                return false;
            }

            if (email.trim() === "") {
                alert("Inserisci la tua email");
                return false;
            }

            if (username.trim() === "") {
                alert("Inserisci il tuo username.");
                return false;
            }

            if (password.trim() === "") {
                alert("Inserisci la tua password");
                return false;
            }

            //altrimenti ritorna vero
            return true;
        }
    </script>
</body>

</html>