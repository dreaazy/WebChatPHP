<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect or do any other actions after destroying the session
header("Location: ../signin.php");
exit();
?>
